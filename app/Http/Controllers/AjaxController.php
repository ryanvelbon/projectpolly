<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\User;

class AjaxController extends Controller
{
    public function updateFollow(Request $request)
    {
    	$data = $request->all();

    	$follower = Auth::id();
    	$followed = (int) $data['id'];

        $session_array = Session::get('following_ids');


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

            // remove from session variable
            $session_array = array_diff($session_array, array($followed));

    	}
    	else{
    		// else user is requesting "follow"

    		DB::table('followings')->insert([
    			'follower' => $follower,
    			'followed' => $followed
    		]);

    		$isFollowing = true;

            // add to session variable
            array_push($session_array, $followed);

    	}

        Session::put('following_ids', $session_array); // update session
        Session::save();

        // return "Clicked on user " . $followed . " ----- " . var_dump($session_array); // uncomment for testing

    	return response()->json(['success' => 'Ajax request submitted successfully',
    							'isFollowing' => $isFollowing]);
    }

    public function updateLike(Request $request)
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

    /*
     *  This function is essentially exactly the same as updateFollow
     *  Find a DRY solution.
     *
     */
    public function updateBookmark(Request $request)
    {
        $data = $request->all();

        $user_id = Auth::id();
        $sentence_id = (int) $data['sentenceId'];

        $session_array = Session::get('bookmark_ids');

        $row = DB::table('bookmarks')->where([
            ['user_id', '=', $user_id],
            ['sentence_id', '=', $sentence_id],
        ])->first();

        if($row) {
            // if row exists then user is requesting "remove this sentence from bookmarks"
            DB::table('bookmarks')->where([
                ['user_id', '=', $user_id],
                ['sentence_id', '=', $sentence_id],
            ])->delete();

            $isBookmarked = false;

            // remove from session variable
            $session_array = array_diff($session_array, array($sentence_id));
            
        }else {
            // else user is requesting "bookmark this sentence"
            DB::table('bookmarks')->insert([
                'user_id' => $user_id,
                'sentence_id' => $sentence_id
            ]);

            $isBookmarked = true;

            // add to session variable
            array_push($session_array, $sentence_id);
            
        }

        Session::put('bookmark_ids', $session_array);
        Session::save();

        return response()->json(['success' => 'Record updated.',
                                    'isBookmarked' => $isBookmarked]);
    }

    public function checkIfPvtConversationAlreadyExists(Request $request)
    {
        $data = $request->all();

        $sender_id = (int) $data['senderId'];
        $recipient_id = (int) $data['recipientId'];

        $sender = User::find($sender_id);

        $conversation = $sender->getPvtConversationWith($recipient_id);

        $already_contacted = (bool) $conversation;

        $url = NULL;

        if($conversation){
            $url = route('conversations.show', ['conversation' => $conversation->slug ]);
        }

        return response()->json(['success' => 'Searched database records.',
                            'alreadyContacted' => $already_contacted,
                            'url'=> $url]);
    }

    public function sendInitialMsgPvtConversation(Request $request)
    {
        $data = $request->all();

        $sender_id = (int) $data['senderId'];
        $recipient_id = (int) $data['recipientId'];
        $msg = $data['msg'];

        $sender = User::find($sender_id);

        $sender->startPvtConversationWith($recipient_id);

        $conversation = $sender->getPvtConversationWith($recipient_id);

        $sender->sendMsg($conversation->id, $msg);

        return response()->json(['success' => 'Message sent!', 'foobar' => 'This is not actually necessary']);
    }
}
