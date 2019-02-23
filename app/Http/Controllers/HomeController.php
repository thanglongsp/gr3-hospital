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
        if($khoa == 'ALL')
            $tests = DB::connection('mysqla')->table('chuyenmons')
                    ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                    ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                    ->paginate(2);
        else
            $tests = DB::connection('mysqla')->table('chuyenmons')
                ->join('khoas', 'chuyenmons.ma_khoa', '=', 'khoas.ma_khoa')
                ->join('quytrinhs', 'chuyenmons.ma_chuyen_mon', '=', 'quytrinhs.ma_chuyen_mon')
                ->where('chuyenmons.ma_khoa', '=', $khoa)
                ->paginate(2);
        $chuyenmons = DB::connection('mysqla')->table('chuyenmons')->get();
        // dd($chuyenmons);
        return view('home', compact('tests', 'chuyenmons'));
    }
    
}
