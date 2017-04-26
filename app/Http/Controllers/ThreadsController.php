<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMessage;
use App\Thread;
use App\Team;
use App\Channel;
use App\User;
use Auth;
use App\ChannelMember;
use DB;

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

        // Filter all teams user is member of
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

        // Filter all teams user is member of
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

        // Filter all teams user is member of
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

        session()->flash('info', 'You modified this reply.');

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
