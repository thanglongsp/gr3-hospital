<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhanGiuongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqlb')->create('phan_giuongs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_bn');
            $table->integer('so_phong');
            $table->integer('toa_nha');
            $table->integer('so_giuong');
            $table->datetime('ngay_nhan');
            $table->datetime('ngay_di');
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
        Schema::connection('mysqlb')->dropIfExists('phan_giuongs');
    }
}
