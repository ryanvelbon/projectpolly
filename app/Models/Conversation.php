<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\Message;
use App\Helpers\Custom;


class Conversation extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        self::creating(function($conversation){
            $conversation->slug = Custom::generateSlug(10) . time();
        });
    }

    // this function should only be for group chats
    public function addParticipant($id, $is_admin = 0){

    	if((bool)$this->is_group_chat){
    		DB::insert('INSERT INTO conversation_user (conversation_id, user_id, joined, is_admin)
    									values(?,?,?,?)', [$this->id, $id, date('Y-m-d H:i:s'), $is_admin]);
	    }else{
			throw new Exception("This is a Private Chat. Participants can only be added to Group Chats");
		}
    }

    public function addParticipants($ids){
    	foreach($ids as $id){
    		$this->addParticipant($id);
    	}
    }

    public function getParticipantsAttribute()
    {
        // this is an Accessor Function which allows us to retrieve $this->participants

        $results = DB::select('SELECT * FROM conversation_user WHERE conversation_id = ?', [$this->id]);

        $users = array();

        foreach($results as $result){
            $user = User::find($result->user_id);
            array_push($users, $user);
        }

        return $users;
    }

    public function getMessagesAttribute()
    {
        // this is an Accessor Function which allows us to retrieve $this->messages

        $messages = Message::where('conversation_id', $this->id)
                                ->orderByDesc('created_at')
                                ->get();

        return $messages;
    }
}
