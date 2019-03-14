<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiayChuyenViensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqla')->create('giay_chuyen_viens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('so_giay_chuyen');
            $table->string('ma_bn');
            $table->string('ma_khoa');
            $table->string('ma_csyt_di');
            $table->string('ma_csyt_den');
            $table->datetime('ngay_gio_chuyen');
            $table->datetime('ngay_gio_nhan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysqla')->dropIfExists('giay_chuyen_viens');
    }
}
