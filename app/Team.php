<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Channel;

class Team extends Model
{
    // public function user() {
    //     return $this->belongsTo(User::class);
    // }

    public function users() {
        return $this->belongsToMany('App\User','team_members','team_id','member_id');
    }

    public function channels() {
        return $this->hasMany(Channel::class);
    }

    public function team_members() {
    	return $this->hasMany(TeamMember::class);
    }
}
