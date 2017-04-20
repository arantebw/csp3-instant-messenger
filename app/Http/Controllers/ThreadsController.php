<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMessage;
use App\Thread;
use App\Team;
use App\Channel;
use App\User;

class ThreadsController extends Controller
{
    public function store(GroupMessage $message) {
    	// Form validation
    	$this->validate(request(), [
    		'comment' => 'required|min:2'
    	]);

    	$message->add_comment(request('comment'));

    	// Redirection
    	return back();
    }

    public function show(Thread $comment) {
        $teams = Team::all();
        $channels = Channel::all();
        $users = User::where('id', $comment->member_id)->get();

    	return view(
            'dashboard.comment.show',
            compact(
                'comment',
                'teams',
                'channels',
                'users'
            )
        );
    }

    public function edit(Thread $comment) {
        $teams = Team::all();
        $channels = Channel::all();
        $users = User::where('id', $comment->member_id)->get();

        return view(
            'dashboard.comment.edit',
            compact(
                'comment',
                'teams',
                'channels',
                'users'
            )
        );
    }

    public function update(Thread $comment) {
        $teams = Team::all();
        $channels = Channel::all();
        $users = User::all();

        // Search comment from database
        $comment = Thread::find($comment->id);

        // Validate new data
        $this->validate(request(), [
            'body' => 'required|min:2'
        ]);

        // Save changes
        $comment->body = request('body');
        $comment->save();

        // Redirection
        return view(
            'dashboard.comment.show',
            compact(
                'comment',
                'teams',
                'channels',
                'users'
            )
        );
    }

    public function destroy(Thread $comment) {
        $comment = Thread::find($comment->id);
        $comment->delete();

        // TODO: This must redirect to parent group message
        return redirect('/dashboard/' . session('current_team') . '/' . session('current_channel'));
    }
}
