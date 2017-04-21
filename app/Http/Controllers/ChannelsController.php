<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use App\Team;
use App\User;
use App\GroupMessage;
use Auth;

class ChannelsController extends Controller
{
    public function create() {
    	return view('channels.create');
    }

    public function store() {
    	// Validate user input
    	$this->validate(request(), [
    		'channel' => 'required|min:5',
            'purpose' => 'required|min:5'
    	]);

        $team = Team::where('name', session('current_team'))->get();
        foreach ($team as $t) {
            $current_team_id = $t->id;
        }

    	// Create new channel
    	$new_channel = new Channel;
    	$new_channel->name = request('channel');
    	$new_channel->purpose = request('purpose');
    	$new_channel->team_id = $current_team_id;
    	$new_channel->member_id = Auth::user()->id;
    	$new_channel->save();

    	return redirect('/dashboard/' . session('current_team') . '/' . session('current_channel'));
    }

    public function show(Channel $channel) {
        return view('channels.show', compact('channel'));
    }

    public function set(Channel $channel) {
        $teams = Team::all();
        $channels = Channel::all();
        $users = User::all();
        $messages = GroupMessage::all();

        // Set new current channel
        session(['current_channel' => $channel->name]);

        return redirect('/dashboard/' . session('current_team') . '/' . session('current_channel'));
    }
}
