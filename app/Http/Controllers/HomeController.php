<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard. 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getHome($bv, $khoa, $cm, $date, $time)
    {   
        $chuyenmons_a = "";
        $chuyenmons_b = "";
        $ma_chuyen_mon = $cm;
        // dd($chuyenmons_a);
        if($bv == 'ALL' && $khoa == 'ALL' && $cm == 'ALL')
        {
            $chuyenmons_a = DB::connection('mysqla')->table('chuyenmons')
                    ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                    ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                    ->paginate(2);
            $chuyenmons_b = DB::connection('mysqlb')->table('chuyenmons')
                    ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                    ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                    ->paginate(2);
            $search_info = "Tất cả các bệnh viện, tất cả các khoa, tất cả các chuyên môn";
        }
        if($bv == 'ALL' && $khoa != 'ALL' && $cm == 'ALL' )
        {
            $chuyenmons_a = DB::connection('mysqla')->table('chuyenmons')
                    ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                    ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                    ->where('chuyenmons.ma_khoa', '=', $khoa)
                    ->paginate(2);
            $chuyenmons_b = DB::connection('mysqlb')->table('chuyenmons')
                    ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                    ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                    ->where('chuyenmons.ma_khoa', '=', $khoa)
                    ->paginate(2);
            $search_info = "Tất cả các bệnh viện, ".$chuyenmons_a[0]->ten_khoa.", tất cả các chuyên môn";
        }
        if($bv == 'ALL' && $khoa == 'ALL' && $cm != 'ALL' )
        {
            $chuyenmons_a = DB::connection('mysqla')->table('chuyenmons')
                    ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                    ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                    ->where('chuyenmons.ma_chuyen_mon', '=', $cm)
                    ->get();
            $chuyenmons_b = DB::connection('mysqlb')->table('chuyenmons')
                    ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                    ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                    ->where('chuyenmons.ma_chuyen_mon', '=', $cm)
                    ->get();
            $search_info = "Tất cả các bệnh viện, chuyên môn ".$chuyenmons_a[0]->ten_chuyen_mon;            
        }
        if($bv == 'ALL' && $khoa != 'ALL' && $cm != 'ALL' )
        {
            $chuyenmons_a = DB::connection('mysqla')->table('chuyenmons')
                    ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                    ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                    ->where([['chuyenmons.ma_khoa', '=', $khoa],['chuyenmons.ma_chuyen_mon', '=', $cm]])                    
                    ->get();                    
            $chuyenmons_b = DB::connection('mysqlb')->table('chuyenmons')
                    ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                    ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                    ->where([['chuyenmons.ma_khoa', '=', $khoa],['chuyenmons.ma_chuyen_mon', '=', $cm]])
                    ->get();
            $search_info = "Tất cả các bệnh viện, ".$chuyenmons_a[0]->ten_khoa.", chuyên môn ".$chuyenmons_a[0]->ten_chuyen_mon;                        
        }
        if($bv == 'A' && $khoa == 'ALL' && $ma_chuyen_mon == 'ALL')
        {
            $chuyenmons_a = DB::connection('mysqla')->table('chuyenmons')
                ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                ->paginate(2);
            $search_info = "Bệnh viện A, tất cả khoa, tất cả chuyên môn";                        
        }
        // dd($chuyenmons_a);
        if($bv == 'A' && $ma_chuyen_mon != 'ALL')
        {
            $chuyenmons_a = DB::connection('mysqla')->table('chuyenmons')
                ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                ->where('chuyenmons.ma_chuyen_mon', '=', $cm)
                ->get();

            $search_info = "Bệnh viện A, chuyên môn".$chuyenmons_a[0]->ten_chuyen_mon;                        
        }
        if($bv == 'A' && $khoa != 'ALL' && $ma_chuyen_mon == "ALL")
        {
            $chuyenmons_a = DB::connection('mysqla')->table('chuyenmons')
                ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                ->where('chuyenmons.ma_khoa', '=', $khoa)
                ->paginate(2);
            $search_info = "Bệnh viện A, ".$chuyenmons_a[0]->ten_khoa.", chuyên môn ".$chuyenmons_a[0]->ten_chuyen_mon;                                    
        }
        if($bv == 'B' && $khoa == 'ALL' && $ma_chuyen_mon == 'ALL')
        {
            $chuyenmons_b = DB::connection('mysqlb')->table('chuyenmons')
                ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                ->paginate(2);
            $search_info = "Bệnh viện B, tất cả khoa, tất cả chuyên môn"; 
        }
        if($bv == 'B' && $khoa != 'ALL')
        {
            $chuyenmons_b = DB::connection('mysqlb')->table('chuyenmons')
                ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                ->where('chuyenmons.ma_khoa', '=', $khoa)
                ->paginate(2);
            $search_info = "Bệnh viện B, chuyên môn".$chuyenmons_b[0]->ten_chuyen_mon;
        }
        if($bv == 'B' && $khoa == 'ALL' && $cm != 'ALL')
        {
            $chuyenmons_b = DB::connection('mysqlb')->table('chuyenmons')
                ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                ->where('chuyenmons.ma_chuyen_mon', '=', $cm)
                ->get();
            $search_info = "Bệnh viện B, ".$chuyenmons_b[0]->ten_khoa.", chuyên môn ".$chuyenmons_b[0]->ten_chuyen_mon;
        }

        $chuyenmons = DB::connection('mysqla')->table('chuyenmons')->get();
        $requests_a = DB::connection('mysqla')
                    ->table('requests')
                    ->where('trang_thai', 3)
                    ->orWhere('trang_thai', 2)
                    ->get();
        $requests_b = DB::connection('mysqlb')
                    ->table('requests')
                    ->where('trang_thai', 3)
                    ->orWhere('trang_thai', 2)
                    ->get();
        // dd($time.":00");
        if($time == 'ALL')
            $time = "00:00:00";
        if($date == 'ALL')
            $date = "YYYY:MM:DD";
        $input_time = $time;
        $time = explode(':',$time);
        $time_gio = $time[0];
        $time_phut = $time[1];

        $motas_a = DB::connection('mysqla')->table('motas')
                ->join('doctors', 'motas.bs_phu_trach', '=', 'doctors.ma_bs')
                ->get();
        $motas_b = DB::connection('mysqlb')->table('motas')
                ->join('doctors', 'motas.bs_phu_trach', '=', 'doctors.ma_bs')
                ->get();
        
        return view('home', compact('chuyenmons_a', 'chuyenmons_b', 'chuyenmons', 'ma_chuyen_mon', 'bv', 'khoa', 'date', 'requests_a', 'requests_b', 'input_time', 'time_gio', 'time_phut', 'search_info', 'motas_a', 'motas_b'));
    }
    
    public function postDatlich(Request $req)
    {
        if( $req->benh_vien == 'A' )
        {
            $count_a = DB::connection('mysqla')
                    ->table('requests')
                    ->where('trang_thai', 3)
                    ->count();
            
            if($count_a < 10)
                    $ma_request = "RQ00".($count_a + 1);
            else    
                $ma_request = "RQ0".($count_a + 1);
            
            DB::connection('mysqla')->table('requests')->insert([
                // dd($req),
            'ma_request' => $ma_request,
            'user_id'   => Auth::user()->id,
            'ngay_thu'  => $req->ngay,
            'thoi_gian' => $req->time,
            'trang_thai' => 3,
            'ma_khoa' => $req->khoa,
            'ma_chuyen_mon' => $req->chuyen_mon,
            'cach_thuc' => $req->cach_thuc
            ]);
        }

        if( $req->benh_vien == 'B' )
        {
            $count_a = DB::connection('mysqlb')
                    ->table('requests')
                    ->where('trang_thai', 3)
                    ->count();
            
            if($count_a < 10)
                    $ma_request = "RQ00".($count_a + 1);
            else    
                $ma_request = "RQ0".($count_a + 1);
            
            DB::connection('mysqlb')->table('requests')->insert([
                // dd($req),
            'ma_request' => $ma_request,
            'user_id'   => Auth::user()->id,
            'ngay_thu'  => $req->ngay,
            'thoi_gian' => $req->time,
            'trang_thai' => 3,
            'ma_khoa' => $req->khoa,
            'ma_chuyen_mon' => $req->chuyen_mon,
            'cach_thuc' => $req->cach_thuc
            ]);
        }
    return redirect()->route('home', ['ALL','ALL','ALL','ALL','ALL']);
    
    }
}
