<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Channel;
use App\User;
use App\GroupMessage;
use Auth;
use App\TeamMember;
use App\ChannelMember;

class TeamsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

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
        $new_team->owner = Auth::user()->id;
        $new_team->save();

        // Set current session's team
        session(['current_team' => $new_team->name]);

        // Create new relationship between member and team
        $new_team_member = new TeamMember;
        $new_team_member->team_id = $new_team->id;
        $new_team_member->member_id = Auth::user()->id;
        $new_team_member->save();

        // Creates the default channel general
        $new_channel = new Channel;
        $new_channel->name = "general";
        $new_channel->team_id = $new_team->id;
        $new_channel->member_id = Auth::user()->id;
        $new_channel->purpose = "A general-purpose channel. Everyone can view and join this channel.";
        $new_channel->save();

        $new_channel_member = new ChannelMember;
        $new_channel_member->channel_id = $new_channel->id;
        $new_channel_member->member_id = Auth::user()->id;
        $new_channel_member->save();

        // Set default channel general as current channel
        session(['current_channel' => $new_channel->name]);

        session()->flash('info', 'You created the new #' . $new_team->name . ' with default #general channel.');

        // Go to home page
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

        $channel = Channel::where('team_id', $team->id)->first();
        session(['current_channel' => $channel->name]);
        session(['current_channel_purpose' => $channel->purpose]);

        session(['current_team' => $team->name]);

        session()->flash('info', 'You set #' . $team->name . ' as your current team.');

        return redirect('/dashboard');
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
        // $team = Team::find($team->id);
        $current_team = Team::where('name', session('current_team'))->first();

        if ($current_team->id != $team->id) {
            $deleted_team_name = $team->name;
            $team->delete();
        }
        else {
            session()->flash('danger', 'You cannot delete a team that is your current team.');
            return back();
        }

        session()->flash('info', 'You deleted #' . $deleted_team_name . ' successfully.');
        return redirect('/dashboard');
    }
}
