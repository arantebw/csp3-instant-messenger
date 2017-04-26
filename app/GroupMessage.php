<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    public function comments() {
    	return $this->hasMany(Thread::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function add_comment($comment) {
        $new_comment = new Thread;

        $new_comment->body = request('comment');
        $new_comment->group_message_id = $this->id;
        $new_comment->member_id = auth()->id();

        $new_comment->save();
    }

    public function channel() {
        return $this->belongsTo('App\Channel');
    }

    public function team() {
        return $this->belongsTo('App\Team');
    }
}
