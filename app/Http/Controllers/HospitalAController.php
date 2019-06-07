<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class HospitalAController extends Controller
{
    //
    public function table(){
        Schema::create('reqShares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hospitalId');
            $table->string('userId');
            $table->string('recordId');
            $table->integer('status');
            $table->timestamps();
        });
    }
}
