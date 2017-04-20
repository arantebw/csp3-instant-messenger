<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Channel;
use App\User;
use App\GroupMessage;

class TeamsController extends Controller
{
    public function create() {
        return view('teams.create');
    }

    public function store() {
        // Validate user input
        $this->validate(request(), [
            'team' => 'required|min:5'
        ]);

        $new_team = new Team;
        $new_team->name = request('team');
        $new_team->owner = session('owner');  // Defaults to 1; no owner yet
        $new_team->save();

        // Set current session's team
        session(['team' => $new_team->name]);

        return redirect('/dashboard');
    }

    public function show(Team $team) {
        return view('teams.show', compact('team'));
    }

    public function set(Team $team) {
        $teams = Team::all();
        $channels = Channel::all();
        $users = User::all();
        $messages = GroupMessage::all();

        // Set new current channel
        session(['current_team' => $team->name]);

        return redirect('/dashboard/' . session('current_team') . '/' . session('current_channel'));
    }
}
