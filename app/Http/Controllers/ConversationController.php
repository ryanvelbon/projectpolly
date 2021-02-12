<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Conversation;

class ConversationController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($slug)
    {
        $c = Conversation::where('slug', '=', $slug)->first();

        return view('conversations.show', ['c' => $c]);

    }

}
