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
use App\Thread;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        // Retrieve session's current team
        if (session('current_team')) {
            // This is your current team
            $team = Team::where([
                ['name', session('current_team')]
            ])->first();
            $current_team_id = $team->id;
        }
        else {
            $team = Team::where('owner', Auth::user()->id)->first();
            $current_team_id = $team->id;
            // Sets current team of authenticated user
            session(['current_team' => $team->name]);
        }

        // Retrieve sessions's current channel
        if (session('current_channel')) {
            // This is your current channel
            $channel = Channel::where([
                ['name', session('current_channel')],
                ['team_id', $team->id]
            ])->first();
            $current_channel_id = $channel->id;
        }
        else {
            // Retrieve the default channel general
            $channel = Channel::where('member_id', Auth::user()->id)->first();
            $current_channel_id = $channel->id;
            // Sets current channel of authenticated user
            session(['current_channel' => $channel->name]);
            session(['current_channel_purpose' => $channel->purpose]);
        }

        // Filter group messages of current team & channel
        $messages = GroupMessage::where([
            ['team_id', $current_team_id],['channel_id', $current_channel_id]
        ])
        ->get();

        // Filter all teams user is member of
        $teams = Auth::user()->teams;

        // Filter all channels of user's teams
        $channels = Channel::where('team_id', $current_team_id)->get();
        $my_channels = ChannelMember::where('member_id', Auth::user()->id)->get();

        $current_channel = Channel::find($current_channel_id);

        // Filter all of user team mates
        $users = DB::table('users')
            ->join('team_members', 'users.id', '=', 'team_members.member_id')
            ->where('team_id', '=', $current_team_id)
            ->select('users.*')
            ->get();

        return view(
            'dashboard.index',
            compact(
                'messages','teams','channels','users','current_channel','my_channels'
            )
        );
    }
}
