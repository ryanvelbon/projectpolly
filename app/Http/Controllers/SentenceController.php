<?php

namespace App\Http\Controllers;
use App\Models\Sentence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    /*
     *  Load n more sentences starting from index i of session variable feed_sentence_ids
     */
    public function fetchNextSentences(Request $request)
    {
        $data = $request->all();

        $i = Session::get('feed_sentence_ids_pointer');
        $n = $data['n'];

        $ids = Session::get('feed_sentence_ids');

        $sentences = [];

        for($x=$i; $x<$i+$n; $x++){
            $id = $ids[$x];
            $sentence = Sentence::find($id);
            array_push($sentences, $sentence);            
        }

        $new_pointer = $i + $n;

        Session::put('feed_sentence_ids_pointer', $new_pointer);

        // return json_encode($sentences);
        // return $i;

        $html = "";

        foreach($sentences as $sentence){
            $html .= view('includes.sentence-post', ['sentence' => $sentence])->render();
        }

        return $html;
    }
}
