<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuanLyBnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqlb')->create('quan_ly_bns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_bn');
            $table->string('ma_khoa');
            $table->string('ma_chuyen_mon');
            $table->string('tinh_trang');
            $table->string('noi_gioi_thieu')->nullable();
            $table->string('chuyen_vien');
            $table->integer('so_ngay_dt');
            $table->string('cach_thuc_rv')->nullable();
            $table->datetime('ngay_vao');
            $table->datetime('ngay_ra');
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
        Schema::connection('mysqlb')->dropIfExists('quan_ly_bns');
    }
}
