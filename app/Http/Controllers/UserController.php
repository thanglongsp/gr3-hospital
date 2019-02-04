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

    // Update info profile 
    public function updateUserProfile(Request $req, $id)
    {
        $user           = User::find($id);
        $user->name     = $req->inputName;
        $user->gender   = $req->inputGender;
        $user->email    = $req->inputEmail;
        $user->work     = $req->work;
        $user->full_name    = $req->full_name;
        $user->address      = $req->address;
        $user->phone_number = $req->phone_number;
        $birthday = date_create_from_format('m/d/Y', $req->birthday);
        $user->birth_day = $birthday;
        if($req->new_password === $req->cof_new_password && $req->new_password != '' && $req->cof_new_password != '')
            $user->password = bcrypt($req->new_password);
        $user->save();
        return redirect()->route('users.profile', $user->id);
    }

    // update picture
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
