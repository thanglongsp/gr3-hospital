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

    // Post comment
    public function postComment(Request $req, $id, $post_id)
    {   
        $comment  = new Comment;
        $comment->post_id = $post_id;
        $comment->user_id = Auth::user()->id;
        $comment->parent_id = $req->parent_id;

        if($req->content != NULL)
            $comment->content = $req->content;

            $file       = 'file_comment'.$post_id;
            $name_file  = 'new_name_comment'.$post_id;
            $name_pic = ''; 
            $name_cam = ''; 
    
            if($req->$name_file != '#')
            {
                $file = $req->file($file);
                $file->move('images/comments', $req->$name_file);
                $name_pic = $req->$name_file;
            }
    
            if($req->srcImage != null)
            {
                $rawData        = $req->srcImage;
                $filteredData   = explode(',', $rawData);
                $unencoded      = base64_decode($filteredData[1]);
                $randomName     = rand(0, 99999);;
                $rs             = file_put_contents('images/comments/'.$randomName.'.png', $unencoded);
                $name_cam       = $randomName.'.png';    
            }

            if($name_cam == '' && $name_pic != '')
                $comment->picture   = $name_pic;
            if($name_cam != '' && $name_pic == '')
                $comment->picture   = $name_cam;
            if($name_cam != '' && $name_pic != '')
                $comment->picture   = $name_pic . ',' . $name_cam;
        $comment->save();

        return redirect()->route('forum');
    }

    // edit comment
    public function editComment(Request $req)
    {   
        $cmt            = Comment::find($req->comment_id);
        $cmt->content   = $req->comment_content;
        $cmt->save();
        
        return redirect()->route('forum');        
    }

    // Delete comment
    public function deleteComment($id)
    {
        $cmt = Comment::find($id);
        $cmt->delete();

        return redirect()->route('forum');        
    }

    // Reply comment
    public function replyComment(Request $req)
    {   
        // dd($req);
        $comment  = new Comment;
        $comment->post_id = $req->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->parent_id = $req->parent_id;

        if($req->content != NULL)
            $comment->content = $req->content;
            $file       = 'file_reply'.$req->parent_id;
            $name_file  = 'new_name_reply'.$req->parent_id;
            $name_pic = ''; 
            $name_cam = ''; 

            if($req->$name_file != '#')
            {
                $file = $req->file($file);
                $file->move('images/comments', $req->$name_file);
                $name_pic = $req->$name_file;
            }
    
            if($req->srcImage != null)
            {
                $rawData        = $req->srcImage;
                $filteredData   = explode(',', $rawData);
                $unencoded      = base64_decode($filteredData[1]);
                $randomName     = rand(0, 99999);;
                $rs             = file_put_contents('images/comments/'.$randomName.'.png', $unencoded);
                $name_cam       = $randomName.'.png';    
            }

            if($name_cam == '' && $name_pic != '')
                $comment->picture   = $name_pic;
            if($name_cam != '' && $name_pic == '')
                $comment->picture   = $name_cam;
            if($name_cam != '' && $name_pic != '')
                $comment->picture   = $name_pic . ',' . $name_cam;
        $comment->save();

        return redirect()->route('forum');
    }
}
