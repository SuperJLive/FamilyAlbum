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
            $table->integer('create_user_id')->default(0);//创建人
            $table->string('title', 100);
            //$table->string('file_name',100);
            $table->string('original_path',100);
            $table->string('thumb_path',100);
            location
            checksum
            thumb_path
            take_stamp
            star            
            $table->string('type', 30)->default('');//文件类型
			$table->integer('width')->nullable();
			$table->integer('height')->nullable();
			$table->string('size', 20)->default('');
            $table->boolean('is_show')->default(true);//是否展示
            $table->boolean('permission')->default(0);
            $table->string('description',500)->nullable();
            $table->text('exif',2000)->nullable();
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
