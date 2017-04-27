<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Channel;
use App\User;
use App\GroupMessage;
use Auth;
use App\TeamMember;
use App\ChannelMember;
use DB;

class TeamsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function create() {
        return view('teams.create');
    }

    public function store() {
        // Validate user input
        $this->validate(request(), [
            'team' => 'required|min:5|unique:teams,name'
        ]);

        $new_team = new Team;
        $new_team->name = request('team');
        $new_team->owner = Auth::user()->id;
        $new_team->save();

        // Create new relationship between member and team
        $new_team_member = new TeamMember;
        $new_team_member->team_id = $new_team->id;
        $new_team_member->member_id = Auth::user()->id;
        $new_team_member->save();

        // Set current session's team
        session(['current_team' => $new_team->name]);

        // Creates the default channel general
        $new_channel = new Channel;
        $new_channel->name = "general";
        $new_channel->team_id = $new_team->id;
        $new_channel->member_id = Auth::user()->id;
        $new_channel->purpose = "A general-purpose channel. Everyone can view and join this channel.";
        $new_channel->save();

        $new_channel_member = new ChannelMember;
        $new_channel_member->channel_id = $new_channel->id;
        $new_channel_member->member_id = Auth::user()->id;
        $new_channel_member->save();

        // Set default channel general as current channel
        session(['current_channel' => $new_channel->name]);

        session()->flash('info', 'You created the new #' . $new_team->name . ' with default #general channel.');

        // Go to home page
        return redirect('/dashboard');
    }

    public function show(Team $team) {
        $user = User::where('id', $team->owner)->first();
        $team_members = $team->users;

        return view('teams.show',
            compact('team','user','team_members')
        );
    }

    public function set(Team $team) {
        // Retrieve default channel
        $current_channel = Channel::where('name', 'general')->first();

        // Filter all teams user is member of
        $teams = Auth::user()->teams;

        // Filter all channels of session current team
        $channels = Channel::where('team_id', $team->id)->get();
        $my_channels = ChannelMember::where('member_id', Auth::user()->id)->get();

        // Filter all of user team mates
        $users = DB::table('users')
            ->join('team_members', 'users.id', '=', 'team_members.member_id')
            ->where('team_id', '=', $team->id)
            ->select('users.*')
            ->get();

        // Filter group messages of current team & channel
        $messages = GroupMessage::where([
            ['team_id', $team->id],['channel_id', $current_channel->id]
        ])
        ->get();

        session(['current_channel' => $current_channel->name]);
        session(['current_channel_purpose' => $current_channel->purpose]);
        session(['current_team' => $team->name]);

        session()->flash('info', 'You set #' . $team->name . ' as your current team.');

        return view('dashboard.index',
                compact('teams','channels','users','current_channel','messages','my_channels')
        );
    }

    public function edit(Team $team) {
        $user = User::all();
        return view('teams.edit', compact('team', 'user'));
    }

    public function update(Team $team) {
        $team = Team::find($team->id);

        $this->validate(request(), [
            'team_name' => 'required|min:2'
        ]);

        $team->name = request('team_name');
        $user = User::where('id', request('team_owner'))->get();
        foreach ($user as $u1) {
            $team->owner = $u1->id;
        }
        $team->save();

        return redirect('/teams/' . $team->id);
    }

    public function destroy(Team $team) {
        // $team = Team::find($team->id);
        $current_team = Team::where('name', session('current_team'))->first();

        if ($current_team->id != $team->id) {
            if (Auth::user()->id == $team->owner) {
                $deleted_team_name = $team->name;
                $team->delete();
            }
            else {
                session()->flash('danger', 'You cannot delete a team if you are not the owner.');
                return back();
            }
        }
        else {
            session()->flash('danger', 'You cannot delete a team that is your current team.');
            return back();
        }

        session()->flash('info', 'You deleted the team #' . $deleted_team_name . '.');
        return redirect('/dashboard');
    }
}
