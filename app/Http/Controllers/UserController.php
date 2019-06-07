<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Like;
use App\Post;
use App\Comment;
use App\Record;
use App\Share;
use Carbon\Carbon;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Update info profile 
    public function updateUserProfile(Request $req, $id)
    {
        $user = User::find($id);
        $user->name = $req->inputName;
        $user->gender = $req->inputGender;
        $user->email = $req->inputEmail;
        $user->work = $req->work;
        $user->full_name = $req->full_name;
        $user->address = $req->address;
        $user->phone_number = $req->phone_number;
        $birthday = date_create_from_format('m/d/Y', $req->birthday);
        $user->birth_day = $birthday;
        if ($req->new_password === $req->cof_new_password && $req->new_password != '' && $req->cof_new_password != '')
            $user->password = bcrypt($req->new_password);
        $user->save();
        return redirect()->route('users.profile', $user->id);
    }

    // update picture
    public function updateUserPicture(Request $req, $id)
    {
        $user = User::find($id);
        $user->avatar = $req->new_name;
        $file = $req->file('avatar');
        $file->move('images/avatars', $req->new_name);
        $user->save();
        return redirect()->route('users.profile', $user->id);
    }

    // get list favarite post
    public function getProfile($id)
    {
        $user = User::find($id);
        $likes = Like::all()->where('user_id', Auth::user()->id);
        $posts = Post::all()->where('user_id', Auth::user()->id);

        $requests_a = DB::connection('mysqla')->table('requests')
            ->join('khoas', 'requests.ma_khoa', '=', 'khoas.ma_khoa')
            ->join('chuyenmons', 'requests.ma_chuyen_mon', '=', 'chuyenmons.ma_chuyen_mon')
            ->where('requests.user_id', Auth::user()->id)
            ->get();
        $requests_b = DB::connection('mysqlb')->table('requests')
            ->join('khoas', 'requests.ma_khoa', '=', 'khoas.ma_khoa')
            ->join('chuyenmons', 'requests.ma_chuyen_mon', '=', 'chuyenmons.ma_chuyen_mon')
            ->where('requests.user_id', Auth::user()->id)
            ->get();
        $requests_a_all = DB::connection('mysqla')->table('requests')
            ->join('khoas', 'requests.ma_khoa', '=', 'khoas.ma_khoa')
            ->join('chuyenmons', 'requests.ma_chuyen_mon', '=', 'chuyenmons.ma_chuyen_mon')
            ->where('requests.trang_thai','=', 1)
            ->get();
        $requests_b_all = DB::connection('mysqlb')->table('requests')
            ->join('khoas', 'requests.ma_khoa', '=', 'khoas.ma_khoa')
            ->join('chuyenmons', 'requests.ma_chuyen_mon', '=', 'chuyenmons.ma_chuyen_mon')
            ->where('requests.trang_thai','=', 1)
            ->get();
        $chuyenmons_b = DB::connection('mysqlb')->table('chuyenmons')
            ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
            ->get();
        // dd($requests_a_all);
        $chuyenmons_a = DB::connection('mysqla')->table('chuyenmons')
            ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
            ->get();
        $hs_noikhoa_as = DB::connection('mysqla')->table('patients')
            ->join('bao_hiem_yts', 'patients.ma_benh_nhan', 'bao_hiem_yts.ma_bn')
            ->join('nguoi_nha_bns', 'patients.ma_benh_nhan', 'nguoi_nha_bns.ma_bn')
            ->join('quan_ly_bns', 'patients.ma_benh_nhan', 'quan_ly_bns.ma_bn')
            ->join('kham_chuyen_khoas', 'patients.ma_benh_nhan', 'kham_chuyen_khoas.ma_bn')
            ->join('giay_ra_viens', 'patients.ma_benh_nhan', 'giay_ra_viens.ma_bn')
            ->join('hoi_benhs', 'patients.ma_benh_nhan', 'hoi_benhs.ma_bn')
            ->get();
        $dac_diem_bns = DB::connection('mysqla')->table('dac_diem_bn')
            ->where('ma_bn', Auth::user()->hospital_a_code)
            ->get();
        // dd($dac_diem_bns);
        $xn_maus = DB::connection('mysqla')->table('xet_nghiem_maus')
            ->join('doctors', 'xet_nghiem_maus.ma_bs', 'doctors.ma_bs')
            ->join('loai_xet_nghiems', 'xet_nghiem_maus.ma_xn', 'loai_xet_nghiems.ma_xn')
            ->join('khoas', 'xet_nghiem_maus.ma_khoa', 'khoas.ma_khoa')
            ->where('xet_nghiem_maus.ma_bn', Auth::user()->hospital_a_code)
            ->get();
        $xn_nts = DB::connection('mysqla')->table('xet_nghiem_nuoctieus')
            ->join('doctors', 'xet_nghiem_nuoctieus.ma_bs', 'doctors.ma_bs')
            ->join('loai_xet_nghiems', 'xet_nghiem_nuoctieus.ma_so', 'loai_xet_nghiems.ma_xn')
            ->join('khoas', 'xet_nghiem_nuoctieus.ma_khoa', 'khoas.ma_khoa')
            ->where('xet_nghiem_nuoctieus.ma_bn', Auth::user()->hospital_a_code)
            ->get();
        $xn_vss = DB::connection('mysqla')->table('xet_nghiem_visinhs')
            ->join('doctors', 'xet_nghiem_visinhs.ma_bs', 'doctors.ma_bs')
            ->join('loai_xet_nghiems', 'xet_nghiem_visinhs.ma_so', 'loai_xet_nghiems.ma_xn')
            ->join('khoas', 'xet_nghiem_visinhs.ma_khoa', 'khoas.ma_khoa')
            ->where('xet_nghiem_visinhs.ma_bn', Auth::user()->hospital_a_code)
            ->get();
        $xn_hsms = DB::connection('mysqla')->table('xn_hoasinh_maus')
            ->join('doctors', 'xn_hoasinh_maus.ma_bs', 'doctors.ma_bs')
            ->join('loai_xet_nghiems', 'xn_hoasinh_maus.ma_so', 'loai_xet_nghiems.ma_xn')
            ->join('khoas', 'xn_hoasinh_maus.ma_khoa', 'khoas.ma_khoa')
            ->where('xn_hoasinh_maus.ma_bn', Auth::user()->hospital_a_code)
            ->get();
        $xn_htds = DB::connection('mysqla')->table('xn_huyettuy_dos')
            ->join('doctors', 'xn_huyettuy_dos.ma_bs', 'doctors.ma_bs')
            ->join('loai_xet_nghiems', 'xn_huyettuy_dos.ma_so', 'loai_xet_nghiems.ma_xn')
            ->join('khoas', 'xn_huyettuy_dos.ma_khoa', 'khoas.ma_khoa')
            ->where('xn_huyettuy_dos.ma_bn', Auth::user()->hospital_a_code)
            ->get();
        $chup_chieus = DB::connection('mysqla')->table('phieu_chup_xqs')
            ->join('doctors', 'phieu_chup_xqs.ma_bs', 'doctors.ma_bs')
            ->get();
        $benh_ans = DB::connection('mysqla')->table('benh_ans')
            ->join('doctors', 'benh_ans.ma_bs', 'doctors.ma_bs')
            ->where('benh_ans.ma_bn', Auth::user()->hospital_a_code)
            ->get();
        $users = User::all();

        $reqShares = DB::table('reqShares')
            ->join('users', 'reqShares.hospitalId', '=', 'users.id')
            ->join('uploadRecords', 'reqShares.recordId','=', 'uploadRecords.recordId' )
            ->where('uploadRecords.userId', Auth::user()->id)
            ->where('reqShares.status', 0)
            ->get();
        $uploadRecords = Record::all()->where('userId', Auth::user()->id);
        return view('users.profile', compact('reqShares', 'user', 'likes', 'posts', 'requests_a', 'requests_b', 'requests_b_all', 'requests_a_all', 'users', 'chuyenmons_a', 'chuyenmons_b', 'hs_noikhoa_as', 'dac_diem_bns', 'xn_maus', 'xn_nts', 'xn_vss', 'xn_hsms', 'xn_htds', 'chup_chieus', 'benh_ans', 'uploadRecords'));
    }

    // cancel dat lich
    public function cancelDatlich(Request $req)
    {
        if ($req->benh_vien == 'A') {
            DB::connection('mysqla')->table('requests')
                ->where('ma_request', $req->ma_request)
                ->update(['trang_thai' => 2, "reason" => $req->reason]);
        }

        if ($req->benh_vien == 'B') {
            DB::connection('mysqlb')->table('requests')
                ->where('ma_request', $req->ma_request)
                ->update(['trang_thai' => 2, "reason" => $req->reason]);
        }

        return redirect()->route('users.profile', Auth::user()->id);
    }

    public function deletePost(Request $req)
    {
        // dd($id);
        $cmts = Comment::where('post_id', $req->post_id);
        $cmts->delete();

        $likes = Like::where('post_id', $req->post_id);
        $likes->delete();

        $post = Post::find($req->post_id);
        $post->delete();
    }

    public function uploadRecord(Request $req)
    {
        $count = Record::all()->count();
        $recordName = rand(0, 99999);;
        $file = $req->file('uploadRecord');
        $file->move('records', $recordName.'.pdf');
        $record = new Record;
        $record->recordName = $recordName;
        $record->recordId = $count + 1;
        $record->userId = Auth::user()->id;
        $record->mota = $req->mota;
        $record->status = 0;
        $record->save();

        return redirect()->route('users.profile', Auth::user()->id);
    }

    public function onPublic($id){
        $record = Record::find($id);
        $record->status = 1;
        $record->save();
        return redirect()->route('users.profile', Auth::user()->id);
    }

    public function offPublic($id){
        $record = Record::find($id);
        $record->status = 0;
        $record->save();
        return redirect()->route('users.profile', Auth::user()->id);
    }

    public function reqShare($id){
        $reqShare = new Share;
        $reqShare->hospitalId = Auth::user()->id;
        $reqShare->recordId = $id;
        $reqShare->status = 0;
        $reqShare->save();
        return redirect()->route('record', Auth::user()->id);
    }

    public function noteRecord(Request $req){
        $curTime = Carbon::now();
        if(Auth::user()->role == 'A')
            $hospital = 'Hospital A : ';
        if(Auth::user()->role == 'B')
            $hospital = 'Hospital B : ';
        $record = Record::find($req->recordId);
        if($record->note == null)
            $record->note = $req->note;
        else
            $record->note = $curTime.' '.$hospital.$req->note.'|'.$record->note;
        $record->save();
        return redirect()->route('record', Auth::user()->id);
    }
}

