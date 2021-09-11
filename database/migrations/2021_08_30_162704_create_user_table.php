<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('openid',128);
            $table->string('session_key',128);
            $table->string('unionid',128);
            $table->string('nick_name',50);
            $table->integer('gender');
            $table->string('language',20);
            $table->string('city',50);
            $table->string('province',50);
            $table->string('country',50);
            $table->string('avatarUrl',50);

            $table->string('true_name',50);
            $table->string('identity',50);
            $table->string('username',50);
            $table->string('password',50);
            $table->string('relation',50);
            $table->boolean('is_alow_login');
            $table->nullableTimestamps('first_login_time',0);
            $table->nullableTimestamps('last_login_time',0);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
