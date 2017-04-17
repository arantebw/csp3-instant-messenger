<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMessage;
use App\Thread;

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
    	return view('dashboard.comment.show', compact('comment'));
    }

    public function edit(Thread $comment) {
        return view('dashboard.comment.edit', compact('comment'));
    }

    public function update(Thread $comment) {
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
        return view('dashboard.comment.show', compact('comment'));
    }

    public function destroy(Thread $comment) {
        $comment = Thread::find($comment->id);
        $comment->delete();
        
        // Must redirect to parent group message
        return redirect('/dashboard');
    }
}
