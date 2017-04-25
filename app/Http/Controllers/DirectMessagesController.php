<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Channel;
use App\User;
use App\DirectMessage;
use DB;
use Auth;
use App\TeamMember;

class DirectMessagesController extends Controller
{
    public function chats($team, $user1, $user2) {
        // Retrieve's current team ID
        if (session('current_team')) {
            $team = Team::where('name', session('current_team'))->get();
            foreach ($team as $t) {
                $current_team_id = $t->id;
                $current_member_id = $t->owner;
            }
        } else {
            $team = Team::where('owner', Auth::user()->id)->first();

            $current_team_id = $team->id;
            $current_member_id = $team->owner;

            // Sets current team of authenticated user
            session(['current_team' => $team->name]);
        }

        // Retrieve's current channel ID
        if (session('current_channel')) {
            $channel = Channel::where('name', session('current_channel'))->get();
            foreach ($channel as $c) {
                $current_channel_id = $c->id;
            }
        } else {
            $channel = Channel::where('member_id', Auth::user()->id)->first();
            $current_channel_id = $channel->id;

            // Sets current channel of authenticated user
            session(['current_channel' => $channel->name]);
            session(['current_channel_purpose' => $channel->purpose]);
        }

        // Filter all teams user is member of
        $teams = Auth::user()->teams;

        // Filter all channels of user's teams
        $channels = Channel::where('team_id', $current_team_id)->get();

        $users = User::all();
        $my_team_mates = TeamMember::where('team_id', $current_member_id)->get();

        $direct_messages = DirectMessage::where([['receiver_id', $user2],['sender_id', $user1]])
            ->orWhere([['receiver_id', $user1],['sender_id', $user2]])
            ->get();

        $user1 = User::where('id', $user1)->get();
        $user2 = User::where('id', $user2)->get();

        return view(
            'members.chat',
            compact(
                'teams','channels','users','direct_messages','team','user1',
                'user2'
            )
        );
    }

    public function store($u2) {
        $this->validate(request(), [
            'body' => 'required|min:5'
        ]);
        $user2 = User::where('id', $u2)->get();

        $message = new DirectMessage;
        $message->sender_id = Auth::user()->id;
        $message->receiver_id = intval($u2);
        $message->body = request('body');
        $message->save();

        return back();
    }

    public function show(DirectMessage $direct_message) {
        $team = Team::where('name', session('current_team'))->get();
        foreach ($team as $t) {
            $current_team_id = $t->id;
            $current_member_id = $t->owner;
        }

        // Filter all teams user is member of
        $teams = Auth::user()->teams;

        // Filter all channels of user's teams
        $channels = Auth::user()->channels;

        $users = User::all();
        $my_team_mates = TeamMember::where('team_id', $current_member_id)->get();

        $sender = User::where('id', $direct_message->sender_id)->first();
        $receiver = User::where('id', $direct_message->receiver_id)->first();

        return view('direct-messages.show',
            compact(
                'direct_message', 'teams', 'channels', 'users', 'sender',
                'receiver', 'my_teams', 'my_team_mates'
            )
        );
    }

    public function edit(DirectMessage $direct_message) {
        $team = Team::where('name', session('current_team'))->get();
        foreach ($team as $t) {
            $current_team_id = $t->id;
            $current_member_id = $t->owner;
        }

        $teams = Team::all();
        $my_teams = TeamMember::where('member_id', Auth::user()->id)->get();

        $channels = Channel::all();

        $users = User::all();
        $my_team_mates = TeamMember::where('team_id', $current_member_id)->get();

        $sender = User::where('id', $direct_message->sender_id)->first();
        $receiver = User::where('id', $direct_message->receiver_id)->first();

        return view('direct-messages.edit',
            compact(
                'direct_message', 'teams', 'channels', 'users', 'sender',
                'receiver', 'my_teams', 'my_team_mates'
            )
        );
    }

    public function update(DirectMessage $direct_message) {
        $teams = Team::all();
        $channels = Channel::all();
        $users = User::all();

        $sender = User::where('id', $direct_message->sender_id)->first();
        $receiver = User::where('id', $direct_message->receiver_id)->first();

        $this->validate(request(), [
            'body' => 'required|min:5'
        ]);

        $message = DirectMessage::find($direct_message->id);
        $message->sender_id = $direct_message->sender_id;
        $message->receiver_id = $direct_message->receiver_id;
        $message->body = request('body');

        $message->save();

        session()->flash('info', 'You modified this direct message.');

        return redirect('/direct-messages/' . $message->id);
    }

    public function destroy(DirectMessage $direct_message) {
        $message = DirectMessage::find($direct_message->id);
        $sender = $message->sender_id;
        $receiver = $message->receiver_id;
        $message->delete();

        session()->flash('info', 'You deleted a direct message.');
        
        return redirect('/dashboard/'. session('current_team') .'/'.  $sender .'/chats/'. $receiver);
    }
}
