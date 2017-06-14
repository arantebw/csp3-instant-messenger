<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function group_message() {
    	return $this->belongsTo('App\GroupMessage');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
