<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ChannelMember;
use App\Team;
use App\Channel;

class ChannelMembersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('channel-members.index');
    }

    public function create() {
        // User input validaton
        $this->validate(request(), [
            'channel' => 'required|exists:channels,name|min:5'
        ]);

        $team = Team::where('name', session('current_team'))->first();

        $channel = Channel::where([
            ['team_id', $team->id],['name', request('channel')]
        ])->first();

        $filter = ChannelMember::where([
            ['channel_id',$channel->id],['member_id',Auth::user()->id]
        ])->first();

        if (count($filter) == 0) {
            $new_channel_member = new ChannelMember;
            $new_channel_member->channel_id = $channel->id;
            $new_channel_member->member_id = Auth::user()->id;
            $new_channel_member->save();
        }
        else {
            session()->flash('danger', 'You cannot join a channel that you\'re already a member.');
            return back();
        }

        session('info', 'You joined the #' . $channel->name);

        // Redirection to a page
        return redirect('/dashboard');
    }
}
