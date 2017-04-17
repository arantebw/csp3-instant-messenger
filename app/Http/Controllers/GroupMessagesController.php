<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMessage;

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
    	// Save message
    	$new_message->save();

    	// Redirect
    	return back();
    }

    public function show(GroupMessage $message) {
        return view('dashboard.comments', compact('message'));
    }

    public function edit(GroupMessage $message) {
        return view('dashboard.group-message.edit', compact('message'));
    }

    public function update(GroupMessage $message) {
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
        return view('dashboard.comments', compact('message'));
    }
}
