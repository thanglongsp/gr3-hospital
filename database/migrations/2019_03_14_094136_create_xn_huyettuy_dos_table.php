<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXnHuyettuyDosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqla')->create('xn_huyettuy_dos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_so');
            $table->string('ma_bn');
            $table->string('ma_bs');
            $table->string('luong_hong_cau');
            $table->string('luong_huyet_sacto');
            $table->string('hermatocrit');
            $table->string('mcv');
            $table->string('mch');
            $table->string('mchc');
            $table->string('hong_cau_conhan');
            $table->string('hong_cau_luoi');
            $table->string('luong_bach_cau');
            $table->string('luong_tieu_cau');
            $table->string('peroxydase');
            $table->string('sudan_den');
            $table->string('esterase_khong_dachieu');
            $table->string('esterase_dac_hieu');
            $table->string('pas');
            $table->string('phosphatase_kiem_bc');
            $table->string('hong_cau_nhiemsat');
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
        Schema::connection('mysqla')->dropIfExists('xn_huyettuy_dos');
    }
}
