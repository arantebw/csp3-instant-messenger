<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;

class TeamsController extends Controller
{
    public function create() {
        return view('teams.create');
    }

    public function store() {
        $this->validate(request(), [
            'team' => 'min:5'
        ]);

        $new_team = new Team;
        $new_team->name = request('team');
        $new_team->owner = 0;  // Defaults to 0; no owner yet
        $new_team->save();

        return back();
    }
}
