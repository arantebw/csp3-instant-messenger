<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Channel;
use App\User;
use DB;
use App\DirectMessage;

class DirectMessagesController extends Controller
{
    public function chats($team, $user1, $user2) {
        $teams = Team::all();
        $channels = Channel::all();
        $users = User::all();
        $team = Team::where('name', $team)->get();
        $user1 = User::where('username', $user1)->get();
        $user2 = User::where('username', $user2)->get();

        return view(
            'members.chat',
            compact(
                'teams',
                'channels',
                'users',
                'team',
                'user1',
                'user2'
            )
        );
    }
}
