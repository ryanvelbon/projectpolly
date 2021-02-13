<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Conversation;
use App\Models\Message;

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

        $timestamp_now = date("Y-m-d H:i:s", strtotime(now()));
        Session::put('conversation_timestamp_pointer', $timestamp_now);

        return view('conversations.show', ['c' => $c]);
    }

}
