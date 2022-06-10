<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $table = 'album';
    protected $fillable = ['title','owner_id','permission','password','tags','min_take_stamp','max_take_stamp',
    'shareable','downloadable','description'];
}