<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMessage;
use App\Team;
use App\Channel;
use App\User;
use Auth;
use App\TeamMember;
use DB;

class DashboardController extends Controller
{
    public function index() {
        // Retrieve current team
        $team = Team::where('name', session('current_team'))->first();
        $current_team_id = $team->id;
        $current_member_id = $team->owner;

        // Retrieve current channel
        $channel = Channel::where('name', session('current_channel'))->first();
        $current_channel_id = $channel->id;

        // Filter group messages
        $messages = GroupMessage::where([
            ['team_id', $current_team_id],['channel_id', $current_channel_id]
        ])
        ->get();

        // Filter all teams user is member of
        $teams = DB::table('teams')
            ->join('team_members', 'teams.id', '=', 'team_members.team_id')
            ->where('member_id', '=', Auth::user()->id)
            ->select('teams.*')
            ->get();

        $team_members = [];
        foreach ($teams as $team) {
            array_push($team_members, count(TeamMember::where('team_id', $team->id)->get()));
        }

        // Filter all channels of user's teams
        $channels = Channel::where('team_id', $current_team_id)->get();

        // Filter all of user team mates
        $users = DB::table('users')
            ->join('team_members', 'users.id', '=', 'team_members.member_id')
            ->where('team_id', '=', $current_team_id)
            ->select('users.*')
            ->get();

        return view(
            'dashboard.index',
            compact(
                'messages','teams','channels','users','team_members'
            )
        );
    }
}
