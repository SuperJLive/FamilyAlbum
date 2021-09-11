<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('album');
        Schema::create('album', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 128)->default('');
            $table->integer('owner_id')->default(0);
            $table->text('description');
            $table->bigInteger('permission_id');
            $table->string('password', 100)->nullable()->default(null);
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
        Schema::dropIfExists('album');
    }
}
