<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTheoDoiDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqla')->create('theo_doi_dts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_benh_nhan');
            $table->datetime('ngay_gio_td');
            $table->string('cs_can_nang');
            $table->string('cs_huyet_ap');
            $table->string('cs_ho_hap');
            $table->text('y_lenh');
            $table->datetime('ngay_th_tlenh');
            $table->string('ma_bs');
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
        Schema::connection('mysqla')->dropIfExists('theo_doi_dts');
    }
}
