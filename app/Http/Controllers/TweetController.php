<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Auth;
use Illuminate\Support\Facades\DB;

class TweetController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required', 'string','min:5','max:255',
            'image' => '',
            'tags' => '',            
        ]);
        $user = Auth::user();
         Tweet::create([
            'content' => $request->input('content'),
            'image' => $request->input('image'),
            'tags' => $request->input('tags'),   
            'user_id' => $user->id,               
        ]);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tweet $tweet)
    {   
        return view('tweet.modiftweet', compact('tweet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Tweet $tweet)
    {  
        $request->validate([
            'content' => 'required', 'string','min:5','max:255',
            'image' => '',
            'tags' => '',            
        ]);
        $tweet->content=$request->input('content');
        $tweet->tags=$request->input('tags');
        $tweet->image=$request->input('image');
        $tweet->save();

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet)
    {
        $tweet->delete();
        return redirect()->route('home');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required', 'string', 'max:20'
        ]);
        $recherche = $request->input('search');
        $tweets = DB::table('tweets')
                     ->where('tweets.content', 'like', "%$recherche%")
                     ->orWhere('tweets.tags', 'like', "%$recherche%")
                     ->join('users', 'tweets.user_id', '=', 'users.id')
                     ->join('comments', 'tweets.id', '=', 'comments.tweet_id')
                     ->get();
                     
        
        return view('search', compact('tweets'));
        
    }
}
