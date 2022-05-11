<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('user');
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('openid',128);
            $table->string('session_key',128)->nullable();
            $table->string('unionid',128)->nullable();
            $table->string('nick_name',50)->nullable();
            $table->integer('gender')->nullable();
            $table->string('language',20)->nullable();
            $table->string('city',50)->nullable();
            $table->string('province',50)->nullable();
            $table->string('country',50)->nullable();
            $table->string('avatar_url',50)->nullable();
            $table->bigInteger('role_id')->default(0);
            $table->string('true_name',50)->nullable();
            $table->string('identity',50)->nullable();
            $table->string('username',50)->nullable();
            $table->string('password',50)->nullable();
            $table->string('permission',50)->nullable();
            $table->boolean('alow_login')->default(true);
            $table->timestamp('first_login_time')->nullable()->useCurrent();
            //$table->timestamp('first_login_time')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('last_login_time')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

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
