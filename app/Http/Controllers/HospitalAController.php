<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class HospitalAController extends Controller
{
    //
    public function table(){
        Schema::connection('mysqlb')->create('motas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_quy_trinh');
            $table->string('mo_ta');
            $table->timestamps();
        });
    }
}
