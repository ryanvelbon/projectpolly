<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profiles.show', [
            'user' => Auth::user()
        ]);
    }

    public function show($username)
    {
        return view('profiles.show', [
            'user' => User::where('username', $username)->first()
        ]);
    }

    public function edit()
    {
        return view('profile-edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }
}
