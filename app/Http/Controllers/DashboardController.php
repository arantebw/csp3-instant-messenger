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
use App\ChannelMember;

class DashboardController extends Controller
{
    public function index() {
        // Retrieve's current team ID
        if (session('current_team')) {
            $team = Team::where('name', session('current_team'))->get();
            foreach ($team as $t) {
                $current_team_id = $t->id;
                $current_member_id = $t->owner;
            }
        } else {
            $team = Team::where('owner', Auth::user()->id)->first();

            $current_team_id = $team->id;
            $current_member_id = $team->owner;

            // Sets current team of authenticated user
            session(['current_team' => $team->name]);
        }

        // Retrieve's current channel ID
        if (session('current_channel')) {
            $channel = Channel::where('name', session('current_channel'))->get();
            foreach ($channel as $c) {
                $current_channel_id = $c->id;
            }
        } else {
            $channel = Channel::where('member_id', Auth::user()->id)->first();
            $current_channel_id = $channel->id;

            // Sets current channel of authenticated user
            session(['current_channel' => $channel->name]);
            session(['current_channel_purpose' => $channel->purpose]);
        }

        // Filter group messages
        $messages = GroupMessage::where([
            ['team_id', $current_team_id],['channel_id', $current_channel_id]
        ])
        ->get();

        // Filter all teams user is member of
        $teams = Auth::user()->teams;

        // Filter all channels of user's teams
        $channels = Channel::where('team_id', $current_team_id)->get();
        
        $current_channel = Channel::where('id', $current_channel_id)->first();

        // Filter all of user team mates
        $users = DB::table('users')
            ->join('team_members', 'users.id', '=', 'team_members.member_id')
            ->where('team_id', '=', $current_team_id)
            ->select('users.*')
            ->get();

        return view(
            'dashboard.index',
            compact(
                'messages','teams','channels','users','current_channel'
            )
        );
    }
}
