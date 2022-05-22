<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumOwner extends Model
{
    use HasFactory;
    protected $table = 'album_owner';
    protected $fillable = ['album_name','owner_id','permission','password','is_visible','is_usable','downloadable',
    'shareable','birthday','max_show_age','sorting_order','description'];

}
