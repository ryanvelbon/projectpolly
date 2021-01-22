<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Sentence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function getDashboard()
	{
		$sentences = Sentence::orderByDesc('created_at')
				->limit(10)
				->get();

		return view('dashboard', ['sentences' => $sentences]);
	}


	public function postSignUp(Request $request)
	{
		// $validated = $request->validate([
		$validator = Validator::make($request->all(), [

			'email' => ['required',
						'unique:users',
						'max:320',
						'regex:/^[a-z0-9]+[\._]?[a-z0-9]+[@]\w+[.]\w{2,3}$/i'],

			'username' => ['required',
						'unique:users',
						'min:8',
						'max:20',
						'regex:/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/i'],

			'first_name' => ['required'],

			'last_name' => ['required'],

			'password' => ['required',
						'confirmed',
						// Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character
						'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/i'],



		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$email = $request['email'];
		$username = $request['username'];
		$first_name = $request['first_name'];
		$last_name = $request['last_name'];
		$password = bcrypt($request['password']);

		$user = new User();
		$user->email = $email;
		$user->username = $username;
		$user->first_name = $first_name;
		$user->last_name = $last_name;
		$user->password = $password;

		$user->save();

		Auth::login($user);

		// this code should be place elsewhere. Perhaps override the save() of the User model so that even
		// when a User object is instantiated from tinker a corresponding Profile is created
		$profile = new Profile();
		$profile->user_id = Auth::id();
		$profile->save();

		return redirect()->route('dashboard');
	}

	public function postLogIn(Request $request)
	{
		if (Auth::attempt(['email' => $request['email'],
				'password' => $request['password']])) {
			return redirect()->route('dashboard');
		}
		return redirect()->back()->withErrors(['Incorrect email or password.']);
	}

	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect()->route('login');
	}
}