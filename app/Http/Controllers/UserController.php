<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function updateUserPicture(Request $req, $id)
    {
        $user           = User::find($id);
        $user->avatar   = $req->new_name;
        $file = $req->file('avatar');
        $file->move('images/avatars', $req->new_name);
        $user->save();
        return redirect()->route('users.profile', $user->id);
    }
}
