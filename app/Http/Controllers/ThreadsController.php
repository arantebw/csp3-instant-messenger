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
    	return view('dashboard.comment', compact('comment'));
    }
}
