<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//MariaDB [lychee]> show columns from lychee_albums;
//+--------------+---------------------+------+-----+---------+-------+
//| Field        | Type                | Null | Key | Default | Extra |
//+--------------+---------------------+------+-----+---------+-------+
//| id           | bigint(14) unsigned | NO   | PRI | NULL    |       |
//| title        | varchar(100)        | NO   |     |         |       |
//| description  | varchar(1000)       | YES  |     |         |       |
//| owner_id     | int(11)             | NO   |     | NULL    |       |
//| public       | tinyint(1)          | NO   |     | 0       |       |
//| visible      | tinyint(1)          | NO   |     | 1       |       |
//| downloadable | tinyint(1)          | NO   |     | 0       |       |
//| password     | varchar(100)        | YES  |     | NULL    |       |
//+--------------+---------------------+------+-----+---------+-------+
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
            $table->string('title', 128)->default('');//标题
            //$table->bigInteger('cover_id')->default(0);//封面图片 放到图片里
            $table->bigInteger('albums_id')->default(0);//所属相册集
            //$table->bigInteger('related_album_id')->default(null);//关联相册 改为多对多
            $table->Integer('permission');//权限
            $table->string('tags')->nullable();
            $table->timestamp('min_take_stamp')->nullable()->default(null);
			$table->timestamp('max_take_stamp')->nullable()->default(null);
            $table->integer('downloadable')->default(0);
            $table->integer('shareable')->default(0);
            $table->bigInteger('user_id')->default(0);//创建人
            $table->string('password', 100)->nullable()->default(null);//密码
            $table->text('description')->nullable();//相册概述
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
