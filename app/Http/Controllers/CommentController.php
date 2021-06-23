<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
   
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required', 'string', 'min:5', 'max:255',
        ]);

        $user_id = Auth::user()->id;
        $comment = new Comment;
        $comment->user_id = $user_id;
        $comment->tweet_id = $request->input('tweet_id');
        $comment->content = $request->input('content');
        $comment->image = $request->input('image');
        $comment->tags = $request->input('tags');
        $comment->save();

        return redirect()->route('home')->with('message', 'Commentaire poster avec succès');
    }

    public function edit(Comment $comment)
    {
        return view('comment.modifcomment', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required', 'string', 'min:5', 'max:255',

        ]);
        $comment->content = $request->input('content');
        $comment->tags = $request->input('tags');
        $comment->image = $request->input('image');
        $comment->save();

        return redirect()->route('home')->with('message', 'Commentaire modifié avec succès');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('home')->with('message', 'Commentaire supprimer avec succès');
    }
}
