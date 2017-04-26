<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function teams() {
        return $this->belongsTo(Team::class);
    }

    public function channel_members() {
    	return $this->hasMany('App\ChannelMember');
    }

    public function group_messages() {
        return $this->hasMany('App\GroupMessage');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'channel_members', 'channel_id', 'member_id');
    }
}
