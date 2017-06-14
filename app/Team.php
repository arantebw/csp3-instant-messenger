<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Channel;

class Team extends Model
{
    public function users() {
        return $this->belongsToMany(
            'App\User', 'team_members', 'team_id', 'member_id'
        );
    }

    public function channels() {
        return $this->hasMany('App\Channel');
    }

    public function team_members() {
    	return $this->hasMany('App\TeamMember');
    }

    public function group_messages() {
        return $this->hasMany('App\GroupMessage');
    }
}
