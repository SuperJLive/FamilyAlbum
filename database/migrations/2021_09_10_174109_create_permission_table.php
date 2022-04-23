<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('permission');
        Schema::create('permission', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('permission_name');
            $table->string('description',1000)->nullable();
            $table->boolean('is_usable')->default(true);
            $table->integer('sorting_order');
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
        Schema::dropIfExists('permission');
    }
}
