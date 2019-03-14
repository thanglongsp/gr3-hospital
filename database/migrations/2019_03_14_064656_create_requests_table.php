<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqlb')->create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_request');
            $table->string('user_id');
            $table->string('ma_cm');
            $table->string('ma_khoa');
            $table->string('hinh_thuc');
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
        Schema::connection('mysqlb')->dropIfExists('requests');
    }
}
