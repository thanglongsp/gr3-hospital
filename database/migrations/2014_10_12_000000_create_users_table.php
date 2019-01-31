<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('gender')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('full_name')->nullable();
            $table->date('birth_day')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('work')->nullable();
            $table->string('hospital_a_code')->nullable();
            $table->string('hospital_b_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token')->nullable();
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
        Schema::dropIfExists('users');
    }
}
