<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments() {
        return $this->hasMany(Thread::class);
    }

    public function group_messages() {
        return $this->hasMany(GroupMessage::class);
    }

    public function teams() {
        return $this->belongsToMany('App\Team','team_members','member_id','team_id');
    }

    public function channels() {
        return $this->belongsToMany('App\Channel','channel_members','member_id','channel_id');
    }
}
