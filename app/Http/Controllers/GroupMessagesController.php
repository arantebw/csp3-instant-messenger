<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMessage;
use App\Team;
use App\Channel;
use App\User;
use App\Thread;
use App\TeamMember;
use App\ChannelMember;
use Auth;
use DB;

class GroupMessagesController extends Controller
{
    public function store() {
    	// Validation
    	$this->validate(request(), [
    		'message' => 'required'
    	]);

        $team = Team::where('name', session('current_team'))->get();
        foreach ($team as $t) {
            $team_id = $t->id;
        }

        $channel = Channel::where('name', session('current_channel'))->get();
        foreach ($channel as $c) {
            $channel_id = $c->id;
        }

    	// Create message
    	$new_message = new GroupMessage;
    	$new_message->body = request('message');
        $new_message->member_id = auth()->id();
        $new_message->team_id = $team_id;
        $new_message->channel_id = $channel_id;

    	// Save message
    	$new_message->save();

    	// Redirect
    	return back();
    }

    public function show(GroupMessage $message) {
        // Filters channel's list in sidebar
        $team = Team::where('name', session('current_team'))->get();
        foreach ($team as $t) {
            $current_team_id = $t->id;
            $current_member_id = $t->member_id;
        }

        $channel = Channel::where('name', session('current_channel'))->get();
        foreach ($channel as $c) {
            $current_channel_id = $c->id;
        }

        // Filter all teams user is member of
        $teams = Auth::user()->teams;

        // Filter all channels of user's teams
        $channels = Channel::where('team_id', $current_team_id)->get();
        $my_channels = ChannelMember::where('member_id', Auth::user()->id)->get();

        $users = User::all();
        $my_team_mates = TeamMember::where('team_id', $current_team_id)->get();

        $comments = Thread::all();

        return view(
            'dashboard.comments',
            compact(
                'message','teams','channels','users','comments','my_teams',
                'my_team_mates','my_channels'
            )
        );
    }

    public function edit(GroupMessage $message) {
        // Filters channel's list in sidebar
        $team = Team::where('name', session('current_team'))->get();
        foreach ($team as $t) {
            $current_team_id = $t->id;
            $current_member_id = $t->member_id;
        }

        $channel = Channel::where('name', session('current_channel'))->get();
        foreach ($channel as $c) {
            $current_channel_id = $c->id;
        }

        $channels = Channel::where('team_id', $current_team_id)->get();
        $my_channels = ChannelMember::where('member_id', Auth::user()->id)->get();

        $teams = Team::all();
        $my_teams = TeamMember::where('member_id', Auth::user()->id)->get();

        $users = User::all();
        $my_team_mates = TeamMember::where('team_id', $current_team_id)->get();

        $user = User::where('id', $message->member_id)->get();

        return view(
            'dashboard.group-message.edit',
            compact(
                'message','teams','channels','users','user','my_teams',
                'my_team_mates','my_channels'
            )
        );
    }

    public function update(GroupMessage $message) {
        // Retrieve session's current team
        if (session('current_team')) {
            // This is your current team
            $team = Team::where([
                ['name', session('current_team')]
            ])->first();
            $current_team_id = $team->id;
        }
        else {
            $team = Team::where('owner', Auth::user()->id)->first();
            $current_team_id = $team->id;
            // Sets current team of authenticated user
            session(['current_team' => $team->name]);
        }

        // Retrieve sessions's current channel
        if (session('current_channel')) {
            // This is your current channel
            $channel = Channel::where([
                ['name', session('current_channel')],
                ['team_id', $team->id]
            ])->first();
            $current_channel_id = $channel->id;
        }
        else {
            // Retrieve the default channel general
            $channel = Channel::where('member_id', Auth::user()->id)->first();
            $current_channel_id = $channel->id;
            // Sets current channel of authenticated user
            session(['current_channel' => $channel->name]);
            session(['current_channel_purpose' => $channel->purpose]);
        }

        $teams = Auth::user()->teams;

        // Filter all channels of user's teams
        $channels = Channel::where('team_id', $current_team_id)->get();
        $my_channels = ChannelMember::where('member_id', Auth::user()->id)->get();

        // Filter all of user team mates
        $users = DB::table('users')
            ->join('team_members', 'users.id', '=', 'team_members.member_id')
            ->where('team_id', '=', $current_team_id)
            ->select('users.*')
            ->get();

        // Validation
        $this->validate(request(), [
            'body' => 'required|min:2'
        ]);

        // Create message
        $message = GroupMessage::find($message->id);
        $message->body = request('body');

        // Save message
        $message->save();

        session()->flash('info', 'You modified this group message.');

        // Redirect
        return view(
            'dashboard.comments',
            compact(
                'message','teams','channels','users','my_teams','my_team_mates','my_channels'
            )
        );
    }

    public function destroy(GroupMessage $message) {
        // Searching group message
        $message = GroupMessage::find($message->id);

        // Deletion of group message
        $message->delete();

        session()->flash('info', 'You deleted a group message.');

        // Redirects to parent channel
        return redirect('/dashboard/' . session('current_team') . '/' . session('current_channel'));
    }
}
