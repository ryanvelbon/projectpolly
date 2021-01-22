<?php

namespace App\Http\Controllers;
use App\Models\Sentence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SentenceController extends Controller
{
    // https://laravel.com/docs/8.x/controllers#actions-handled-by-resource-controller


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
        $user = Auth::user();

        // the sentence to be published must be in the user's native language
        $author_native_lang = $user->profile->native_lang;

        if(!$user->profile->native_lang){
            return "cannot publish sentence until you tell us your native lang";
        }

        $sentence = new Sentence();
        $sentence->body = $request['new-sentence'];
        $sentence->lang_id = $author_native_lang;
        $request->user()->sentences()->save($sentence);
        return redirect()->route('dashboard');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
