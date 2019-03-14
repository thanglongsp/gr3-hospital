<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXetNghiemVisinhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqla')->create('xet_nghiem_visinhs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_so');
            $table->string('ma_bn');
            $table->string('ma_bs');
            $table->string('penicilline');
            $table->string('ampicilline');
            $table->string('amo_a_clavulanic');
            $table->string('aztreonam');
            $table->string('mezlociline');
            $table->string('oxacilline_phe');
            $table->string('oxacilline_tu');
            $table->string('cephalotine');
            $table->string('cefuroxime');
            $table->string('ceftazidime');
            $table->string('cefotaxime');
            $table->string('ceftriaxino');
            $table->string('cefoperazone');
            $table->string('cefepime');
            $table->string('vancomycin');
            $table->string('clindamycin');
            $table->string('chloramphenicol');
            $table->string('erythromycine');
            $table->string('tetracycline');
            $table->string('doxycycline');
            $table->string('nalidixic_acid');
            $table->string('nofloxacine');
            $table->string('ofloxacine');
            $table->string('ciprofloxacine');
            $table->string('gentamycine');
            $table->string('tobramycine');
            $table->string('amikacine');
            $table->string('netromycine');
            $table->string('co_trimoxazol');
            $table->string('nitroxoline');
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
        Schema::connection('mysqla')->dropIfExists('xet_nghiem_visinhs');
    }
}
