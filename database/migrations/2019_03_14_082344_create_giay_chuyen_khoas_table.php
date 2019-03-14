<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiayChuyenKhoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqla')->create('giay_chuyen_khoas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_bn');
            $table->string('ma_khoa_chuyen');
            $table->string('ma_khoa_den');
            $table->string('ma_bs_kc');
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
        Schema::connection('mysqla')->dropIfExists('giay_chuyen_khoas');
    }
}
