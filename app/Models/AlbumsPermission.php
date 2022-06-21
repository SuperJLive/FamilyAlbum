<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumsPermission extends Model
{
    use HasFactory;
    protected $table = 'albums_permission';
    protected $fillable = ['albums_id','group_id'];
}
