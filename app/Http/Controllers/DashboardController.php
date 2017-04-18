<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMessage;
use App\Team;

class DashboardController extends Controller
{
    public function index() {
    	$messages = GroupMessage::all();
        $teams = Team::all();

        return view('dashboard.index', compact('messages', 'teams'));
    }
}
