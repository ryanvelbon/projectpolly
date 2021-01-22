<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    use HasFactory;


    // author
    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }


    public function lang()
    {
    	return $this->belongsTo('App\Models\Language');
    }
}
