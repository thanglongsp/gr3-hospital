<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXetNghiemNuoctieusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqlb')->create('xet_nghiem_nuoctieus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_so');
            $table->string('ma_bn');
            $table->string('ma_bs');
            $table->string('hong_cau');
            $table->string('bach_cau');
            $table->string('tru_hat');
            $table->string('tru_trong');
            $table->string('tru_mo');
            $table->string('tbbm_than');
            $table->string('tbbm_nieu_dao');
            $table->string('tbbm_bang_quan');
            $table->string('can_oxalat');
            $table->string('can_cacbonat');
            $table->string('can_suphat');
            $table->string('can_photphat');
            $table->string('can_urat');
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
        Schema::connection('mysqlb')->dropIfExists('xet_nghiem_nuoctieus');
    }
}
