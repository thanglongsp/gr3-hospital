<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuytrinhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqlb')->create('quytrinhs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_quy_trinh');
            $table->string('hinh_thuc');
            $table->string('ma_chuyen_mon');
            $table->string('quy_trinh');
            $table->string('thoi_gian');
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
        Schema::connection('mysqlb')->dropIfExists('quytrinhs');
    }
}
