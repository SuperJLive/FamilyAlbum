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
            $table->integer('owner_id')->default(0);
            $table->string('title', 100);
            $table->string('file_name',100);
            $table->string('path',100);
            $table->string('type', 30)->default('');
			$table->integer('width')->nullable();
			$table->integer('height')->nullable();
			$table->string('size', 20)->default('');
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
