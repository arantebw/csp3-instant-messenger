<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeamMember;
use App\Team;
use App\User;
use Auth;

class TeamMembersController extends Controller
{
    public function index() {
        return view('team-members.index');
    }

    public function create() {
        $this->validate(request(), [
            'team' => 'required|min:5'
        ]);

        // Search for team name's ID
        $team = Team::where('name', request('team'))->first();

        $new_team_member = new TeamMember;
        $new_team_member->team_id = $team->id;
        $new_team_member->member_id = Auth::user()->id;

        $new_team_member->save();

        session(['current_team' => $team->name]);
        session(['current_channel' => 'general']);
        
        return redirect('/dashboard');
    }
}
