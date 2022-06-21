<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateAlbumsPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('albums_permission');
        Schema::create('albums_permission', function (Blueprint $table) {
            $table->bigInteger('albums_id');
            $table->bigInteger('group_id');
            $table->boolean('is_allow')->default(true);
            $table->primary(['albums_id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums_permission');
    }
}
