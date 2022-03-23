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
            $table->bigInteger('cover_id')->default(0);//封面图片
            $table->integer('owner_id')->default(0);//所有者
            $table->bigInteger('related_album_id')->default(null);//关联相册
            $table->text('description');//相册概述
            $table->bigInteger('permission_id');//权限
            $table->string('password', 100)->nullable()->default(null);//密码
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
