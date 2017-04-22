<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Channel;
use App\User;
use App\DirectMessage;
use DB;
use Auth;

class DirectMessagesController extends Controller
{
    public function chats($team, $user1, $user2) {
        // Filters channel's list in sidebar
        $team = Team::where('name', session('current_team'))->get();
        foreach ($team as $t) {
            $current_team_id = $t->id;
            $current_member_id = $t->member_id;
        }
        $channels = Channel::where('team_id', $current_team_id)->get();

        $teams = Team::all();
        $team = Team::where('name', $team)->get();

        $users = User::all();

        // $direct_messages = DirectMessage::all();
        $direct_messages = DirectMessage::where([['receiver_id', $user2],['sender_id', $user1]])
            ->orWhere([['receiver_id', $user1],['sender_id', $user2]])
            ->get();

        $user1 = User::where('id', $user1)->get();
        $user2 = User::where('id', $user2)->get();

        return view(
            'members.chat',
            compact(
                'teams',
                'channels',
                'users',
                'direct_messages',
                'team',
                'user1',
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
        $teams = Team::all();
        $channels = Channel::all();
        $users = User::all();

        $sender = User::where('id', $direct_message->sender_id)->first();
        $receiver = User::where('id', $direct_message->receiver_id)->first();

        return view('direct-messages.show',
            compact('direct_message', 'teams', 'channels', 'users', 'sender', 'receiver')
        );
    }

    public function edit(DirectMessage $direct_message) {
        $teams = Team::all();
        $channels = Channel::all();
        $users = User::all();

        $sender = User::where('id', $direct_message->sender_id)->first();
        $receiver = User::where('id', $direct_message->receiver_id)->first();

        return view('direct-messages.edit',
            compact('direct_message', 'teams', 'channels', 'users', 'sender', 'receiver')
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

        return redirect('/dashboard/' . session('current_team') . '/' . $message->sender_id . '/chats/' . $message->receiver_id);
    }
}
