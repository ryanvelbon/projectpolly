<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function updateFollowStatus(Request $request)
    {
    	$data = $request->all();

    	$follower = Auth::id();
    	$followed = $data['id'];

    	$row = DB::table('followings')->where([
    		['follower', '=', $follower],
    		['followed', '=', $followed],
    	])->first();

    	if($row){
    		// if row exists then user is requesting "unfollow"
    		
    		DB::table('followings')->where([
	    		['follower', '=', $follower],
	    		['followed', '=', $followed],
	    	])->delete();

	    	$isFollowing = false;
    	}
    	else{
    		// else user is requesting "follow"

    		DB::table('followings')->insert([
    			'follower' => $follower,
    			'followed' => $followed
    		]);

    		$isFollowing = true;
    	}

    	return response()->json(['success' => 'Ajax request submitted successfully',
    							'isFollowing' => $isFollowing]);
    }
}
