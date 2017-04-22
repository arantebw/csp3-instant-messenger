<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMessage;
use App\Team;
use App\Channel;
use App\User;
use App\Thread;

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
        $channels = Channel::where('team_id', $current_team_id)->get();

        $teams = Team::all();

        $users = User::all();
        $comments = Thread::all();

        return view(
            'dashboard.comments',
            compact(
                'message',
                'teams',
                'channels',
                'users',
                'comments'
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
        $channels = Channel::where('team_id', $current_team_id)->get();

        $teams = Team::all();
        $users = User::all();

        $user = User::where('id', $message->member_id)->get();

        return view(
            'dashboard.group-message.edit',
            compact(
                'message',
                'teams',
                'channels',
                'users',
                'user'
            )
        );
    }

    public function update(GroupMessage $message) {
        $teams = Team::all();
        $channels = Channel::all();
        $users = User::all();

        // Validation
        $this->validate(request(), [
            'body' => 'required|min:2'
        ]);

        // Create message
        $message = GroupMessage::find($message->id);
        $message->body = request('body');

        // Save message
        $message->save();

        // Redirect
        return view(
            'dashboard.comments',
            compact(
                'message',
                'teams',
                'channels',
                'users'
            )
        );
    }

    public function destroy(GroupMessage $message) {
        // Searching group message
        $message = GroupMessage::find($message->id);

        // Deletion of group message
        $message->delete();

        // Redirects to parent channel
        return redirect('/dashboard/' . session('current_team') . '/' . session('current_channel'));
    }
}
