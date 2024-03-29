<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class RegistrationsController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['create','store']]);
    }

    public function create() {
        return view('registrations.create');
    }

    public function store() {
        // Validates user input
        $this->validate(request(), [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users|min:2',
            'password' => 'required|confirmed'
        ]);

        // Creates new team member
        $member = new User;
        $member->first_name = request('first_name');
        $member->last_name = request('last_name');
        $member->email = request('email');
        $member->username = request('username');
        $member->password = bcrypt(request('password'));
        // User is online
        $member->online = true;

        // Store changes
        $member->save();

        // Authorize new user to login
        auth()->login($member);

        // Redirects to create new team page
        return view('teams.create', compact('member'));
    }

    public function show() {
        $default_img = "/img/img_avatar.png";

        return view('registrations.show', compact('default_img'));
    }

    public function edit() {
        $default_img = "/img/img_avatar.png";

        return view('registrations.edit', compact('default_img'));
    }

    public function update() {
        $default_img = "/img/img_avatar.png";

        // Validates user input
        $this->validate(request(), [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email_address' => 'required|email',
            'username' => 'required|min:2',
            'password' => 'required|confirmed'
        ]);

        // Update team member details
        Auth::user()->first_name = request('first_name');
        Auth::user()->last_name = request('last_name');
        Auth::user()->email = request('email_address');
        Auth::user()->username = request('username');
        Auth::user()->password = bcrypt(request('password'));

        // Store changes
        Auth::user()->save();

        // Redirects to create new team page
        return view('registrations.show', compact('default_img'));
    }

    public function destroy() {
        // Searches for record of user to be deleted
        $user = User::find(Auth::user()->id);

        // User is offline
        $user->online = false;
        $user->save();

        // Delete the current authorized user
        $user->delete();

        session()->flash('danger', 'Your account has been deleted.');

        // Redirect to dashboard's main page
        return redirect('/logged-out');
    }

    public function logout() {
        // Search user record
        $user = User::find(Auth::user()->id);

        // User is now offline
        $user->online = false;
        $user->save();

        Auth::logout($user);

        session()->flash('info', 'Sign out successful.');

        return redirect('/logged-out');
    }
}
