<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXnHoasinhMausTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqla')->create('xn_hoasinh_maus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_bn');
            $table->string('ma_bs');
            $table->string('ure');
            $table->string('glucose');
            $table->string('creatinin');
            $table->string('acid_uric');
            $table->string('bilirubin_tp');
            $table->string('bilirubin_tt');
            $table->string('bilirubin_gt');
            $table->string('protein_tp');
            $table->string('albumin');
            $table->string('globulin');
            $table->string('ty_le_ag');
            $table->string('fibrinogen');
            $table->string('cholesterol');
            $table->string('triglycerid');
            $table->string('hdl_cho');
            $table->string('ldl_cho');
            $table->string('na+');
            $table->string('k+');
            $table->string('cl-');
            $table->string('calci');
            $table->string('calci_ion_hoa');
            $table->string('phospho');
            $table->string('sat');
            $table->string('magie');
            $table->string('ast');
            $table->string('alt');
            $table->string('amylase');
            $table->string('ck');
            $table->string('ck_mb');
            $table->string('ldh');
            $table->string('ggt');
            $table->string('chosphatase');
            $table->string('phoshatase_kiem');
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
        Schema::connection('mysqla')->dropIfExists('xn_hoasinh_maus');
    }
}
