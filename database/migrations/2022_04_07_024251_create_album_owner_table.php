<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumOwnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_owner', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('owner_id')->default(0);
            $table->string('album_name')->default('');
            $table->integer('permission')->default(0);
            $table->string('password',100)->nullable();
            $table->string('description',500)->default('');
            $table->timestamps();
        });
    }
    //-1禁止访问（仅自己与管理员可以访问）
    //0继承自上级权限
    //1所有人可访问
    //2用户组和人员可以访问
    //3输入密码即可以访问
    //4符合权限后输入密码才可以访问
    //5回答问题可以访问
    //6符合权限后回答问题才可以访问

    //不可以访问人员及用户组

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album_owner');
    }
}
