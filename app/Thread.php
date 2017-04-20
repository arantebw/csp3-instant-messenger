<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function group_message() {
    	return $this->belongsTo(GroupMessage::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
