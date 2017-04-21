<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function teams() {
        return $this->belongsTo(Team::class);
    }
}
