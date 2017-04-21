<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Channel;

class Team extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function channels() {
        return $this->hasMany(Channel::class);
    }
}
