<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqlb')->create('khoas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_khoa');
            $table->string('ten_khoa');
            $table->string('van_phong');
            $table->string('ma_truong_khoa');
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
        Schema::connection('mysqlb')->dropIfExists('khoas');
    }
}
