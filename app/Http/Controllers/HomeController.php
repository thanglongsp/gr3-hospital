<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        }
        if($bv == 'ALL' && $khoa != 'ALL' && $cm != 'ALL' )
        {
            $chuyenmons_a = DB::connection('mysqla')->table('chuyenmons')
                    ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                    ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                    // ->where('chuyenmons.ma_chuyen_mon', '=', $cm)
                    ->where('chuyenmons.ma_khoa', '=', $khoa)
                    ->paginate(2);
            $chuyenmons_b = DB::connection('mysqlb')->table('chuyenmons')
                    ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                    ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                    // ->where('chuyenmons.ma_chuyen_mon', '=', $cm)
                    ->where('chuyenmons.ma_khoa', '=', $khoa)
                    ->paginate(2);
        }
        if($bv == 'A' && $khoa == 'ALL' && $cm == 'ALL')
        {
            $chuyenmons_a = DB::connection('mysqla')->table('chuyenmons')
                ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                ->paginate(2);
        }
        if($bv == 'A' && $khoa == 'ALL' && $cm != 'ALL')
        {
            $chuyenmons_a = DB::connection('mysqla')->table('chuyenmons')
                ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                ->where('chuyenmons.ma_chuyen_mon', '=', $cm)
                ->get();
        }
        if($bv == 'A' && $khoa != 'ALL')
        {
            $chuyenmons_a = DB::connection('mysqla')->table('chuyenmons')
                ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                ->where('chuyenmons.ma_khoa', '=', $khoa)
                ->paginate(2);
        }
        if($bv == 'B' && $khoa == 'ALL')
        {
            $chuyenmons_b = DB::connection('mysqlb')->table('chuyenmons')
                ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                ->paginate(2);
        }
        if($bv == 'B' && $khoa != 'ALL')
        {
            $chuyenmons_b = DB::connection('mysqlb')->table('chuyenmons')
                ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                ->where('chuyenmons.ma_khoa', '=', $khoa)
                ->paginate(2);
        }
        if($bv == 'B' && $khoa == 'ALL' && $cm != 'ALL')
        {
            $chuyenmons_b = DB::connection('mysqlb')->table('chuyenmons')
                ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                ->where('chuyenmons.ma_chuyen_mon', '=', $cm)
                ->get();
        }

        $chuyenmons = DB::connection('mysqla')->table('chuyenmons')->get();
        $requests_a = DB::connection('mysqla')
                    ->table('requests')
                    ->where('trang_thai', 3)
                    ->orWhere('trang_thai', 2)
                    ->get();
        // dd($time.":00");
        if($time == 'ALL')
            $time = "00:00:00";
        if($date == 'ALL')
            $date = "YYYY:MM:DD";
        $time = explode(':',$time);
        $time_gio = $time[0];
        $time_phut = $time[1];
        // dd($t[0] + 1);
        // dd($date);

        // $requests_a
        return view('home', compact('chuyenmons_a', 'chuyenmons_b', 'chuyenmons', 'ma_chuyen_mon', 'bv', 'date', 'requests_a', 'time_gio', 'time_phut'));
    }
    
}
