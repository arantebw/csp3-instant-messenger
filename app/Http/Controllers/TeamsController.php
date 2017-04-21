<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Channel;
use App\User;
use App\GroupMessage;
use Auth;

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
        // $new_team->owner = session('owner');  // Defaults to 1; no owner yet
        $new_team->owner = Auth::user()->id;
        $new_team->save();

        // Set current session's team
        session(['current_team' => $new_team->name]);

        $new_channel = new Channel;
        $new_channel->name = "general";
        $new_channel->team_id = $new_team->id;
        $new_channel->member_id = Auth::user()->id;
        $new_channel->purpose = "A general-purpose channel. Everyone can view and join this channel.";
        $new_channel->save();

        // Create a default general channel
        session(['current_channel' => $new_channel->name]);

        return redirect('/dashboard');
    }

    public function show(Team $team) {
        $user = User::where('id', $team->owner)->get();

        return view('teams.show', compact('team', 'user'));
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

    public function edit(Team $team) {
        $user = User::all();
        return view('teams.edit', compact('team', 'user'));
    }

    public function update(Team $team) {
        $team = Team::find($team->id);

        $this->validate(request(), [
            'team_name' => 'required|min:2'
        ]);

        $team->name = request('team_name');
        $user = User::where('id', request('team_owner'))->get();
        foreach ($user as $u1) {
            $team->owner = $u1->id;
        }
        $team->save();

        return redirect('/teams/' . $team->id);
    }

    public function destroy(Team $team) {
        $team = Team::find($team->id);
        $team->delete();

        return redirect('/dashboard');
    }
}
