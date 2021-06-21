<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $user_id = Auth::user()->id;
          $comment = new Comment;
          $comment->user_id = $user_id;
          $comment->tweet_id = $request ->input('tweet_id');
          $comment->content = $request ->input('content');
          $comment->image = $request ->input('image');
          $comment->tags = $request ->input('tags');
          $comment->save();

        ;
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
    public function edit(Comment $comment)
    {
        return view('comment.modifcomment', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required', 'string','min:5','max:255',
            'image' => '',
            'tags' => '',            
        ]);
        $comment->content=$request->input('content');
        $comment->tags=$request->input('tags');
        $comment->image=$request->input('image');
        $comment->save();

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {   
        $comment->delete();
        return redirect()->route('home');
    }
}