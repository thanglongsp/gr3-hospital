<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiayRaViensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqlb')->create('giay_ra_viens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('so_giay_rv');
            $table->datetime('ngay_gio_vao');
            $table->datetime('ngay_gio_ra');
            $table->string('phuong_phap_dt');
            $table->string('ket_qua_dt');
            $table->text('loi_khuyen_bs');
            $table->string('ma_bn');
            $table->string('ma_bs');
            $table->string('ma_khoa');
            $table->string('ma_chuyen_mon');
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
        Schema::connection('mysqlb')->dropIfExists('giay_ra_viens');
    }
}
