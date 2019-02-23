<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    //
    public function getChuyenmon($ma_khoa)
    {   
              
    }

    public function getKhoa($ma_khoa)
    {   
        return redirect()->route('home', $ma_khoa);        
    }
}
