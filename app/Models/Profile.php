<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function isComplete()
    {
    	// returns TRUE if the following table fields are set

    	return $this->attributes['user_id']
    		&& $this->attributes['native_lang'];
    }
}
