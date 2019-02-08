<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentController extends Controller
{
    //
    public function getComment()
    {

    }

    public function postComment(Request $req, $id, $post_id)
    {
        $file       = 'file_comment'.$post_id;
        $name_file  = 'new_name_comment'.$post_id; 
        // dd($file);
        // dd($req->$file);
        $comment  = new Comment;
        $comment->post_id = $post_id;
        $comment->user_id = Auth::user()->id;
        $comment->parent_id = $req->parent_id;

        if($req->content != NULL)
            $comment->content = $req->content;

        if($req->$name_file != NULL)
        {
            $comment->picture = $req->$name_file;
            $file = $req->file($file);
            $file->move('images/comments', $req->$name_file);
        }

        $comment->save();

        return redirect()->route('forum');
    }
}
