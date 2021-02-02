<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Sentence;
use App\Models\Following;
use App\Models\Language;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
	private function setSessions()
	{
			$following_ids = Following::where('follower', Auth::id())->get()->pluck('followed')->toArray();
			$bookmark_ids = Bookmark::where('user_id', Auth::id())->get()->pluck('sentence_id')->toArray();
			$feed_sentence_ids = Sentence::orderByDesc('created_at')->limit(1000)->get()->pluck('id')->toArray();
			Session::put('following_ids', $following_ids);
			Session::put('bookmark_ids', $bookmark_ids);
			Session::put('feed_sentence_ids', $feed_sentence_ids);
			Session::put('feed_sentence_ids_pointer', 0); // always start from the first item in the feed_sentence_ids array
			// $follower_ids = Following::where('followed', Auth::id())->get()->pluck('follower')->toArray();
			// Session::put('follower_ids', $follower_ids);
        	Session::save();
	}

	public function getDashboard()
	{
		$sentences = Sentence::orderByDesc('created_at')
				->limit(10)
				->get();

		$languages = Language::where('ranking', '<=', 15)->get();

		$countries = DB::select('SELECT * FROM countries');

		$lang_stats = DB::select('SELECT * FROM calc_lang_stats ORDER BY lang_id ASC');

		return view('dashboard', ['sentences' => $sentences,
								'languages' => $languages,
								'countries' => $countries,
								'lang_stats' => $lang_stats]);
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

		$this->setSessions();

		return redirect()->route('dashboard');
	}

	public function postLogIn(Request $request)
	{
		if (Auth::attempt(['email' => $request['email'],
				'password' => $request['password']])) {

			$this->setSessions();

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