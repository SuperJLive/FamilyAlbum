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
            $table->string('album_name')->default('');
            $table->bigInteger('owner_id')->default(0);
            $table->integer('permission')->default(0);
            $table->string('password',100)->nullable();
            $table->boolean('is_visible')->default(true);
            $table->boolean('is_usable')->default(true);
            $table->boolean('downloadable')->default(false);
            $table->boolean('shareable')->default(false);
            $table->timestamp('birthday')->nullable();
            $table->integer('max_show_age')->default(0);//0不显示
            // $table->string('icon')->nullable()->default('');
            // $table->string('style')->nullable()->default('');
            // $table->string('cover')->nullable()->default('');
            $table->string('extention')->nullable()->default('');
            $table->string('description',500)->nullable();
            $table->integer('sorting_order')->default(0);
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
