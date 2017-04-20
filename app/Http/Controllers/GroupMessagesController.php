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

    	// Create message
    	$new_message = new GroupMessage;
    	$new_message->body = request('message');
        $new_message->member_id = auth()->id();

    	// Save message
    	$new_message->save();

    	// Redirect
    	return back();
    }

    public function show(GroupMessage $message) {
        $teams = Team::all();
        $channels = Channel::all();
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
        $teams = Team::all();
        $channels = Channel::all();
        $users = User::all();

        return view(
            'dashboard.group-message.edit',
            compact(
                'message',
                'teams',
                'channels',
                'users'
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
