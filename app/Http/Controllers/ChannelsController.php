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

        session()->flash('info', 'New #' . $new_channel->name . ' channel was created.');

    	return redirect('/dashboard/' . session('current_team') . '/' . session('current_channel'));
    }

    public function show(Channel $channel) {
        $user = User::where('id', $channel->member_id)->first();

        return view('channels.show', compact('channel', 'user'));
    }

    public function set(Channel $channel) {
        $teams = Team::all();
        $channels = Channel::all();
        $users = User::all();
        $messages = GroupMessage::all();

        // Set new current channel
        session(['current_channel' => $channel->name]);
        session(['current_channel_purpose' => $channel->purpose]);
        
        session()->flash('info', 'You set #' . $channel->name . ' as your current channel.');

        return redirect('/dashboard/' . session('current_team') . '/' . session('current_channel'));
    }

    public function edit(Channel $channel) {
        $users = User::all();

        return view('channels.edit', compact('channel', 'users'));
    }

    public function update(Channel $channel) {
        // Validate user input
        $this->validate(request(), [
            'channel_name' => 'required|min:5',
            'channel_purpose' => 'required|min:5'
        ]);

        $channel->name = request('channel_name');
        $channel->purpose = request('channel_purpose');
        $channel->member_id = request('channel_owner');
        $channel->save();

        return redirect('/channels/' . $channel->id);
    }

    public function destroy(Channel $channel) {
        if (session('current_channel') != $channel->name) {
            $deleted_channel = $channel->name;
            $channel->delete();
            session()->flash('info', 'You deleted #' . $deleted_channel . ' channel.');
        }
        else {
            session()->flash('danger', 'You cannot delete a channel that is your active channel.');
            return back();
        }

        return redirect('/dashboard');
    }
}
