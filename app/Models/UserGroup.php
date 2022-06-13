<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;
    protected $table = 'user_group';

    protected $fillable = ['group_name','description','is_usable','sorting_order'];
    //protected $checked ='checked';
    public function isUsableChecked():Attribute
    {
        $checked = '';
        if($this->is_usable)
        {
            $checked='checked';
        }
        return new Attribute(
            get: fn () => $checked
        );
    }
}
