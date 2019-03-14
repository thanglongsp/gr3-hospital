<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXetNghiemMausTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqlb')->create('xet_nghiem_maus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_bn');
            $table->string('ma_bs');
            $table->string('ma_khoa');
            $table->string('so_luong_hc');
            $table->string('huyet_sac_to');
            $table->string('hematocrit');
            $table->string('hong_cau_conhan');
            $table->string('hong_cau_luoi');
            $table->string('so_luong_tieucau');
            $table->string('so_luong_bachcau');
            $table->string('thanh_phan_bachcau');
            $table->string('tebao_bat_thuong');
            $table->string('tg_mau_dong');
            $table->string('nhom_mau');
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
        Schema::connection('mysqlb')->dropIfExists('xet_nghiem_maus');
    }
}
