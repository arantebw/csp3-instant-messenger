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
        $teams = Team::all();
        $team = Team::where('name', $team)->get();

        $channels = Channel::all();

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
}
