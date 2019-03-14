<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqla')->create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_y_te');
            $table->string('ma_benh_nhan');
            $table->string('ten_benh_nhan');
            $table->string('gioi_tinh');
            $table->string('birth_day');
            $table->string('nghe_nghiep');
            $table->string('dia_chi');
            $table->string('nhom_mau');
            $table->string('viet_kieu');
            $table->string('nguoi_nuoc_ngoai');
            $table->string('cmtnd');
            $table->string('ho_chieu');
            $table->string('ma_doi_tuong');
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
        Schema::connection('mysqla')->dropIfExists('patients');
    }
}
