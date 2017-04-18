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
        $this->validate(request(), [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email_address' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        // Creates new team member
        $member = new User;
        $member->first_name = request('first_name');
        $member->last_name = request('last_name');
        $member->email = request('email_address');
        $member->password = bcrypt(request('password'));

        // Store changes
        $member->save();

        // Session of member ID
        session(['owner' => $member->id]);

        // Redirect to a page
        return view('teams.create');
    }
}
