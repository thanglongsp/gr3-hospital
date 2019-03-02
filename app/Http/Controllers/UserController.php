<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Like;
use App\Post;

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

    // get list favarite post
    public function getProfile($id){
        $user   = User::find($id);
        $likes   = Like::all()->where('user_id', Auth::user()->id);
        $posts   = Post::all()->where('user_id', Auth::user()->id);

        $requests_a = DB::connection('mysqla')->table('requests')
                ->join('khoas', 'requests.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('chuyenmons', 'requests.ma_chuyen_mon', '=', 'chuyenmons.ma_chuyen_mon')
                ->where([['requests.user_id', Auth::user()->id],['requests.trang_thai', 3]])
                ->get();
        $requests_b = DB::connection('mysqlb')->table('requests')
                ->join('khoas', 'requests.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('chuyenmons', 'requests.ma_chuyen_mon', '=', 'chuyenmons.ma_chuyen_mon')
                ->where([['requests.user_id', Auth::user()->id],['requests.trang_thai', 3]])
                ->get();
        $requests_a_all = DB::connection('mysqla')->table('requests')
                ->join('khoas', 'requests.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('chuyenmons', 'requests.ma_chuyen_mon', '=', 'chuyenmons.ma_chuyen_mon')
                ->where('requests.trang_thai', 3)
                ->get();
        // dd($requests_a_all);
        $requests_b_all = DB::connection('mysqlb')->table('requests')
                ->join('khoas', 'requests.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('chuyenmons', 'requests.ma_chuyen_mon', '=', 'chuyenmons.ma_chuyen_mon')
                ->where('requests.trang_thai', 3)
                ->get();
        $users = User::all();
        // dd($users[0]->name);
        return view('users.profile', compact('user','likes', 'posts', 'requests_a', 'requests_b', 'requests_b_all', 'requests_a_all', 'users'));
    }

    // cancel dat lich
    public function cancelDatlich(Request $req)
    {
        // dd($req);
        if( $req->benh_vien == 'A' )
            DB::connection('mysqla')->table('requests')
                ->where('ma_request', $req->ma_request)
                ->delete();
        if( $req->benh_vien == 'B' )
            DB::connection('mysqlb')->table('requests')
                ->where('ma_request', $req->ma_request)
                ->delete();

        return redirect()->route('users.profile', Auth::user()->id);         
    }
}

