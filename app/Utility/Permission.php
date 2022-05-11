<?php

namespace App\Utility;


class Permission
{
    function permissionSelect()
    {
    //-1禁止访问（仅自己与管理员可以访问）
    //0继承自上级权限
    //1所有人可访问
    //2用户组和人员可以访问
    //3输入密码即可以访问
    //4符合权限后输入密码才可以访问
    //5回答问题可以访问
    //6符合权限后回答问题才可以访问

    //不可以访问人员及用户组
            $arraPermission[]= array(
                ['id'=>-1,
                'text'=>'禁止访问'],
                ['id'=>0,
                'text'=>'继承'],
                ['id'=>1,
                'text'=>'所有人可访问'],
                ['id'=>2,
                'text'=>'用户组和人员可以访问'],
                ['id'=>3,
                'text'=>'输入密码即可以访问'],
                ['id'=>4,
                'text'=>'符合权限后输入密码才可以访问'],
                ['id'=>5,
                'text'=>'回答问题可以访问'],
                ['id'=>6,
                'text'=>'符合权限后回答问题才可以访问']
            );

        return $arraPermission;
    }
}
