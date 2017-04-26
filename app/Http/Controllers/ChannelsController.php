<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use App\Team;
use App\User;
use App\GroupMessage;
use Auth;
use App\ChannelMember;
use DB;

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

        // Create channel to member relationship
        $new_channel_member = new ChannelMember;
        $new_channel_member->channel_id = $new_channel->id;
        $new_channel_member->member_id = Auth::user()->id;
        $new_channel_member->save();

        session()->flash('info', 'New #' . $new_channel->name . ' channel was created.');

    	return redirect('/dashboard/' . session('current_team') . '/' . session('current_channel'));
    }

    public function show(Channel $channel) {
        $user = User::where('id', $channel->member_id)->first();

        return view('channels.show', compact('channel', 'user'));
    }

    public function set(Channel $channel) {
        $current_team = Team::where('name', session('current_team'))->first();

        // Filter all teams user is member of
        $teams = Auth::user()->teams;

        // Filter all channels of session current team
        $channels = Channel::where('team_id', $current_team->id)->get();
        $my_channels = ChannelMember::where('member_id', Auth::user()->id)->get();

        // Filter all of user team mates
        $users = DB::table('users')
            ->join('team_members', 'users.id', '=', 'team_members.member_id')
            ->where('team_id', '=', $current_team->id)
            ->select('users.*')
            ->get();

        $current_channel = Channel::find($channel->id);
        // Reset session current channel to user request
        session(['current_channel' => $channel->name]);

        // Filter group messages of current team & channel
        $messages = GroupMessage::where([
            ['team_id', $current_team->id],['channel_id', $channel->id]
        ])
        ->get();

        session()->flash('info', 'Your current channel now is #' . $channel->name . '.');

        return view('dashboard.index',
            compact('teams','channels','users','current_channel','messages','my_channels')
        );
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
            $channel = Channel::find($channel->id);
            $deleted_channel = $channel->name;
            $channel->delete();
            session()->flash('info', 'You deleted #' . $deleted_channel . ' channel.');
        }
        else {
            session()->flash('danger', 'You cannot delete a channel that is your current channel.');
            return back();
        }

        return redirect('/dashboard');
    }
}
