<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoiBenhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqlb')->create('hoi_benhs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_bn');
            $table->date('ngay_khoi_phat');
            $table->text('dien_bien');
            $table->text('chan_doan')->nullable();
            $table->text('dt_tuyen_duoi')->nullable();
            $table->text('tien_su_benh')->nullable();
            $table->text('mo_ta_benh');
            $table->text('di_truyen_gd')->nullable();
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
        Schema::connection('mysqlb')->dropIfExists('hoi_benhs');
    }
}
