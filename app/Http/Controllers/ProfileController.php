<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profiles.show', [
            'user' => Auth::user(),
            'profile' => DB::table('view_profiles_records')->where('id', Auth::id())->first()
        ]);
    }

    public function show($username)
    {
        $user = User::where('username', $username)->first();

        return view('profiles.show', [
            'user' => $user,
            'profile' => DB::table('view_profiles_records')->where('id', $user->id)->first()
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
        $profile = Profile::find($id);

        $profile->gender = $request['gender'];
        $profile->native_lang = $request['native-lang'];
        $profile->nationality = $request['nationality'];
        $profile->dob = $request['yyyy'] . "-" .
                $request['mm'] . "-" .
                $request['dd'];
        $profile->bio = $request['bio'];

        $profile->save();
        return "success";
    }
}
