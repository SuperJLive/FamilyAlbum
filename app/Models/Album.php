<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $table = 'album';
    protected $fillable = ['title','owner_id','permission','password','tags','min_takestamp','max_takestamp',
    'shareable','downloadable','description'];
}