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
                    ->paginate(2);
            $chuyenmons_b = DB::connection('mysqlb')->table('chuyenmons')
                    ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                    ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                    ->where('chuyenmons.ma_chuyen_mon', '=', $cm)
                    ->paginate(2);
        }
        // dd($chuyenmons_b[0]->ten_khoa);
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

        if($bv == 'A' && $khoa == 'ALL')
        {
            $chuyenmons_a = DB::connection('mysqla')->table('chuyenmons')
                ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                ->paginate(2);
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
        $chuyenmons = DB::connection('mysqla')->table('chuyenmons')->get();
        // dd($chuyenmons_a);
        return view('home', compact('chuyenmons_a', 'chuyenmons_b', 'chuyenmons'));
    }
    
}
