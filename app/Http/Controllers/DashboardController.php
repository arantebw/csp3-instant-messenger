<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMessage;
use App\Team;
use App\Channel;
use App\User;

class DashboardController extends Controller
{
    public function index() {
        // Retrieve's current team ID
        $team = Team::where('name', session('current_team'))->get();
        foreach ($team as $t) {
            $current_team_id = $t->id;
        }

        // Retrieve's current channel ID
        $channel = Channel::where('name', session('current_channel'))->get();
        foreach ($channel as $c) {
            $current_channel_id = $c->id;
        }

    	$messages = GroupMessage::where([
            ['team_id', $current_team_id],['channel_id', $current_channel_id]
        ])->get();

        $teams = Team::all();
        $channels = Channel::all();
        $users = User::all();

        return view(
            'dashboard.index',
            compact(
                'messages',
                'teams',
                'channels',
                'users'
            )
        );
    }
}
