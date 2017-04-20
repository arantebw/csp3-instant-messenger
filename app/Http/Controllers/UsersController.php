<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Team;
use DB;

class UsersController extends Controller
{
    public function chats($team, $user1, $user2) {
    	$team = Team::where('name', $team)->get();
    	$user1 = User::where('username', $user1)->get();
    	$user2 = User::where('username', $user2)->get();

    	return view('members.chat', compact('team', 'user1', 'user2'));
    }
}
