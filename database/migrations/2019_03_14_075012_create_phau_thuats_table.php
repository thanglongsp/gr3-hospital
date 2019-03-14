<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhauThuatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqlb')->create('phau_thuats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_bn');
            $table->string('ma_bs');
            $table->string('ma_khoa');
            $table->string('ma_chuyen_mon');
            $table->string('so_phieu_pt');
            $table->datetime('ngay_thuc_hien');
            $table->string('ket_qua_pt');
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
        Schema::connection('mysqlb')->dropIfExists('phau_thuats');
    }
}
