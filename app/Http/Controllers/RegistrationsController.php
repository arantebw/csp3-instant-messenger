<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegistrationsController extends Controller
{
    public function create() {
        return view('registrations.create');
    }

    public function store() {
        // Validates user input
        $this->validate(request(), [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email_address' => 'required|email',
            'username' => 'required|min:2',
            'password' => 'required|confirmed'
        ]);

        // Creates new team member
        $member = new User;
        $member->first_name = request('first_name');
        $member->last_name = request('last_name');
        $member->email = request('email_address');
        $member->username = request('username');
        $member->password = bcrypt(request('password'));

        // Store changes
        $member->save();

        // Authorize new user to login
        auth()->login($member);

        // Owner of the new team to be created
        session(['owner' => $member->id]);

        // Redirects to create new team page
        return view('teams.create');
    }
}
