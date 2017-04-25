<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMessage;
use App\Thread;
use App\Team;
use App\Channel;
use App\User;
use Auth;

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
        // Filters channel's list in sidebar
        $team = Team::where('name', session('current_team'))->get();
        foreach ($team as $t) {
            $current_team_id = $t->id;
            $current_member_id = $t->member_id;
        }
        // $channels = Channel::where('team_id', $current_team_id)->get();
        // $teams = Team::all();

        // Filter all teams user is member of
        $teams = Auth::user()->teams;

        // Filter all channels of user's teams
        $channels = Auth::user()->channels;
        $my_channels = ChannelMember::where('member_id', Auth::user()->id)->get();

        $users = User::all();
        $user = User::where('id', $comment->member_id)->get();

    	return view(
            'dashboard.comment.show',
            compact(
                'comment',
                'teams',
                'channels',
                'user',
                'users','my_channels'
            )
        );
    }

    public function edit(Thread $comment) {
        $teams = Team::all();
        $channels = Channel::all();
        $my_channels = ChannelMember::where('member_id', Auth::user()->id)->get();
        $users = User::all();
        $user = User::where('id', $comment->member_id)->get();

        return view(
            'dashboard.comment.edit',
            compact(
                'comment',
                'teams',
                'channels',
                'users',
                'user','my_channels'
            )
        );
    }

    public function update(Thread $comment) {
        $teams = Team::all();
        $channels = Channel::all();
        $my_channels = ChannelMember::where('member_id', Auth::user()->id)->get();
        $users = User::all();
        $user = User::where('id', $comment->member_id)->get();

        // Search comment from database
        $comment = Thread::find($comment->id);

        // Validate new data
        $this->validate(request(), [
            'body' => 'required|min:2'
        ]);

        // Save changes
        $comment->body = request('body');
        $comment->save();

        session()->flash('info', 'You modified this comment successfully.');

        // Redirection
        return view(
            'dashboard.comment.show',
            compact(
                'comment',
                'teams',
                'channels',
                'users',
                'user','my_channels'
            )
        );
    }

    public function destroy(Thread $comment) {
        $group_message = $comment->group_message_id;
        $comment = Thread::find($comment->id);
        $comment->delete();

        session()->flash('info', 'You deleted a comment from this group message.');

        return redirect('/message/' . $group_message);
    }
}
