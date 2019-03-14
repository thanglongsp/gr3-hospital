<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNguoiNhaBnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqlb')->create('nguoi_nha_bns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_bn');
            $table->string('hoten_nguoi_nha');
            $table->string('dia_chi');
            $table->string('so_dien_thoai');
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
        Schema::connection('mysqlb')->dropIfExists('nguoi_nha_bns');
    }
}
