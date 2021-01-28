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

    public function updateLikeSentenceStatus(Request $request)
    {
        $data = $request->all();

        $user_id = Auth::id();
        $sentence_id = $data['sentenceId'];
        $is_like = filter_var($data['isLike'], FILTER_VALIDATE_BOOLEAN);

        $row = DB::table('likes')->where([
            ['user_id', '=', $user_id],
            ['sentence_id', '=', $sentence_id],
        ])->first();

        if($row){
            
            $prev_value = (bool) $row->is_like;
            
            DB::table('likes')->where([
                ['user_id', '=', $user_id],
                ['sentence_id', '=', $sentence_id],                
            ])->delete();

            if($is_like == $prev_value){
                // do nothing
                return response()->json(['success' => 'Record deleted.',
                                        'reaction' => 'neither']);
            }
        }
        
        DB::table('likes')->insert([
            'user_id' => $user_id,
            'sentence_id' => $sentence_id,
            'is_like' => ($is_like=='true'?1:0)
        ]);

        $reaction = ($is_like=='true'?'like':'dislike');

        return response()->json(['success' => 'Record inserted.',
                                'reaction' => $reaction]);
    }

    public function updateBookmarkSentenceStatus(Request $request)
    {
        $data = $request->all();

        $user_id = Auth::id();
        $sentence_id = $data['sentenceId'];

        $row = DB::table('bookmarks')->where([
            ['user_id', '=', $user_id],
            ['sentence_id', '=', $sentence_id],
        ])->first();

        if($row) {
            DB::table('bookmarks')->where([
                ['user_id', '=', $user_id],
                ['sentence_id', '=', $sentence_id],
            ])->delete();

            return response()->json(['success' => 'Record deleted.',
                                    'isBookmarked' => false]);
        }else {
            DB::table('bookmarks')->insert([
                'user_id' => $user_id,
                'sentence_id' => $sentence_id
            ]);

            return response()->json(['success' => 'Record inserted.',
                                    'isBookmarked' => true]);
        }
    }
}
