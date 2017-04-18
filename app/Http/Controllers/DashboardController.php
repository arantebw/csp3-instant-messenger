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
    	$messages = GroupMessage::all();
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
