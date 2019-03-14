<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhieuChupXqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqla')->create('phieu_chup_xqs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_bn');
            $table->string('so_phieu_cc');
            $table->integer('lan_chup');
            $table->datetime('ngay_gio_yc');
            $table->datetime('ngay_gio_th');
            $table->datetime('ket_qua');
            $table->string('ma_bs');
            $table->string('image');
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
        Schema::connection('mysqla')->dropIfExists('phieu_chup_xqs');
    }
}
