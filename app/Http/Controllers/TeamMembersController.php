<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeamMember;
use App\Team;
use App\User;
use Auth;
use App\ChannelMember;
use App\Channel;

class TeamMembersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('team-members.index');
    }

    public function create() {
        // User input validation
        $this->validate(request(), [
            'team' => 'required|exists:teams,name|min:5'
        ]);

        // Search for team name's ID
        $team = Team::where('name', request('team'))->first();
        $channel = Channel::where('team_id', $team->id)->first();

        if (count(TeamMember::where([['team_id', $team->id],['member_id', Auth::user()->id]])->first()) == 0) {
            $new_team_member = new TeamMember;
            $new_team_member->team_id = $team->id;
            $new_team_member->member_id = Auth::user()->id;
            $new_team_member->save();
            session(['current_team' => $team->name]);

            $new_channel_member = new ChannelMember;
            $new_channel_member->channel_id = $channel->id;
            $new_channel_member->member_id = Auth::user()->id;
            $new_channel_member->save();
            session(['current_channel' => 'general']);
        }
        else {
            session()->flash('danger', 'You cannot join a team that you are already a member.');

            return back();
        }

        session()->flash('info', 'You joined the team #' . $team->name);

        return redirect('/dashboard');
    }
}
