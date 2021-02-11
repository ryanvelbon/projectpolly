<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\Sentence;



class User extends Model implements Authenticatable
{
    use HasFactory;
    use \Illuminate\Auth\Authenticatable;


    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }


    public function sentences()
    {
    	return $this->hasMany('App\Models\Sentence');
    }


    public function getBookmarksAttribute()
    {
        // this is an Accessor Function
        // allows us to do $myUser->bookmarks

        $results = DB::select('SELECT * FROM bookmarks WHERE user_id = ?', [$this->id]);

        $sentences = array();

        foreach($results as $result){
            $sentence = Sentence::where('id', $result->sentence_id)->first();
            array_push($sentences, $sentence);
        }

        return $sentences;
        
    }


    public function getFollowersAttribute()
    {
        // this is an Accessor Function
        // allows us to do $myUser->followers

        $results = DB::select('SELECT * FROM followings WHERE followed = ?', [$this->id]);

        $followers = array();

        foreach($results as $result){
            $follower = $this::where('id', $result->follower)->first();
            array_push($followers, $follower);
        }

        return $followers;
    }


    public function getFollowingAttribute()
    {
        // this is an Accessor Function
        // allows us to do $myUser->following

        $results = DB::select('SELECT * FROM followings WHERE follower = ?', [$this->id]);

        $following = array();

        foreach($results as $result){
            $user_being_followed_by_this_user = $this::where('id', $result->followed)->first();
            array_push($following, $user_being_followed_by_this_user);
        }

        return $following;
    }

    /*
     *=====================================================================================================
     *                                         --------
     *---------------------------------------CONVERSATIONS------------------------------------------------
     *                                 -----------------------
     *                                         -------
     */


    public function getConversationsAttribute()
    {
        $results = DB::select('SELECT * FROM conversation_user WHERE user_id = ?', [$this->id]);

        $conversations = array();

        foreach($results as $result){
            $conversation = Conversation::find($result->conversation_id);
            array_push($conversations, $conversation);
        }

        return $conversations;
    }


    public function allConversationsWith($id)
    {
        $user = User::find($id);

        $resultsA = $this->conversations;
        $resultsB = $user->conversations;

        $conversations = collect($resultsA)->intersect($resultsB);

        return $conversations;

    }


    // Private conversation means a conversation between exactly two users
    public function getPvtConversationWith($id)
    {
        return $this->allConversationsWith($id)->where('is_group_chat', 0)->first();
    }


    public function startPvtConversationWith($id)
    {

        // if there is not already a private conversation between these two users
        if(!$this->getPvtConversationWith($id)) {
            // create conversation
            $c = new Conversation();
            $c->is_group_chat = 0;
            $c->save();
            DB::insert('INSERT INTO conversation_user (conversation_id, user_id) values(?,?)', [$c->id, $this->id]);
            DB::insert('INSERT INTO conversation_user (conversation_id, user_id) values(?,?)', [$c->id, $id]);
        }else {
            throw new Exception("A private conversation between these two users already exists.");
        }
    }


    public function startGroupConversationWith($ids)
    {
        $c = new Conversation();
        $c->is_group_chat = 1;
        $c->save();
        $c->addParticipant($this->id, $is_admin = 1);
        $c->addParticipants($ids);
    }


    /*
     *   @param    int     $id        id of Conversation
     */
    public function isParticipant($id){

        $result = DB::table('conversation_user')
                        ->where('user_id', '=', $this->id)
                        ->where('conversation_id', '=', $id)
                        ->first();

        return (bool) $result;
    }


    public function sendMsg($conversation_id, $text){

        if(!$this->isParticipant($conversation_id)){
            throw new Exception("Delivery failed: You are not a participant of this conversation.");
        }

        // try catch
        // send response on success/fail
        // is this SQL query prone to an SQL injection?

        DB::insert('INSERT INTO messages (created_at, user_id, conversation_id, msg_body) values(?,?,?,?)',
                                        [date('Y-m-d H:i:s'), $this->id, $conversation_id, $text]);

    }
}
