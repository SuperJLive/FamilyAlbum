<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumOwner extends Model
{
    use HasFactory;
    protected $table = 'album_owner';
    protected $fillable = ['album_name','owner_id','permission','description','password'];
}
