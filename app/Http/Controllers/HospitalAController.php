<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class HospitalAController extends Controller
{
    //
    public function table(){
        Schema::connection('mysqla')->create('chuyengias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_chuyen_gia');
            $table->string('ma_bs');
            $table->string('ma_khoa');
            $table->string('ma_chuyen_mon');
            $table->timestamps();
        });
    }
}
