<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SentenceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\DB;
Route::get('/test', function() {

	$languages = DB::select('SELECT * FROM languages WHERE ranking <= 99');
	return view('test', ['languages' => $languages]);
});



Route::get('/', function () {
    return view('home');
});





Route::get('/signup', function () {
	if (Auth::check()) {
	    return redirect()->route('dashboard');
	}
	else{
		return view('signup');
	}    
});

Route::post('/signup', [UserController::class, 'postSignUp'])->name('signup');

// Route::get('/signup/complete-profile');

Route::get('/login', function () {
	if (Auth::check()) {
	    return redirect()->route('dashboard');
	}
	else{
		return view('login');
	} 
});

Route::post('/login', [UserController::class, 'postLogIn'])->name('login');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/reset-password', function () {
	return view('reset-password');
})->name('pwdReset');

// Route::get('/user/edit-profile', [ProfileController::class, 'edit']);

// Route::get('/user/profile');


// instead of the default URI provided by ProfileController profile/{profile}/edit
// we have defined our own profile/edit URI
Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

Route::resource('profile', ProfileController::class)->only([
	'index', 'show', 'update'
]);





// Route::get('/dashboard', function () {
// 	return view('dashboard');
// });


Route::get('/dashboard', [UserController::class, 'getDashboard'])->name('dashboard')->middleware('auth');





Route::resource('sentences', SentenceController::class);