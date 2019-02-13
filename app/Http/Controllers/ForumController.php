<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\User;
use App\Like;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    // post
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

    // show posts
    public function show(){
        $posts      = Post::all();
        $comments   = Comment::all();
        $likes      = Like::all();
        $count_like = $likes->count();
        $dem;
        return view('forum', compact('posts', 'comments', 'likes', 'count_like', 'dem'));
    }

    // like post
    public function likePost(Request $req, $id)
    {   
        // dd($req);
        if($req->value == 0){
            $dislike = Like::find($req->like_id);
            $dislike->delete();
        }
        else{
            $like = new Like;
            $like->post_id = $req->post_id = $id;
            $like->user_id = $req->user_id = Auth::user()->id;
            $like->value = 1;            
            $like->save();
        }
        return redirect()->route('forum');
    }
}
