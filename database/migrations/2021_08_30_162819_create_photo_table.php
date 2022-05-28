<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('photo');
        Schema::create('photo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('album_id');//->references('id')->on('albums')->onDelete('cascade');
            $table->integer('user_id')->default(0);//创建人
            $table->string('title', 100);
            $table->string('original_path',100);
            $table->string('thumb_path',100);
            $table->string('location',100)->nullable();
            $table->string('checksum',100)->nullable();
            $table->timestamp('take_stamp')->nullable();
            $table->integer('star')->default(0);
            $table->string('type', 30)->default('');//文件类型
			$table->integer('width')->nullable();
			$table->integer('height')->nullable();
			$table->string('size', 20)->default('');
            $table->boolean('is_show')->default(true);//是否展示
            $table->integer('cover')->default(0);//封面
            $table->integer('permission')->default(0);
            $table->integer('downloadable')->default(0);
            $table->integer('shareable')->default(0);
            $table->string('password', 100)->nullable()->default(null);//密码
            $table->string('description',500)->nullable();
            $table->json('exif')->nullable();
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
        Schema::dropIfExists('photo');
    }
}
