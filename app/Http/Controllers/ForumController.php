<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    //
    public function post(Request $req){
        $post = new Post;
        $post->user_id  = Auth::user()->id;
        $post->title    = $req->title;
        $post->content  = $req->content;
        $post->picture  = $req->new_name;
        $file = $req->file('post_image');
        $file->move('images/forums', $req->new_name);
        $post->save();
        return redirect()->route('forum');
    }

    public function show(){
        // $cmt = Comment::all();
        // dd($cmt);
        $posts = Post::all();
        $comments = Comment::all();

        // $test = $comments->user();
        // dd($posts->user['name']);
        return view('forum', compact('posts', 'comments'));
    }
}
