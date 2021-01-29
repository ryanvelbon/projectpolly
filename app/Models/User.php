<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;

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
}
