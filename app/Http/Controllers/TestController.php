<?php

namespace App\Http\Controllers;
use App\Utility\PermissionDic;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function Test1()
    {
        $pd=new PermissionDic();
        $text= $pd->getPhotoPermissionSelect(2);
        dd($text);
    }
}
