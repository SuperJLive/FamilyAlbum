<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'Permission';

    protected $fillable = ['permission_name','description','is_usable','sorting_order'];
    //protected $checked ='checked';
    public function getIsUsableChecked()
    {
        $checked = '';
        if($this->is_usable)
        {
            $checked='checked';
        }
        return $checked;
    }
    
}
