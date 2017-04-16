<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMessage;

class DashboardController extends Controller
{
    public function index() {
    	$messages = GroupMessage::all();

        return view('dashboard.index', compact('messages'));
    }
}
