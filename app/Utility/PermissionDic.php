<?php

namespace App\Utility;

use App\Models\Permission;

class PermissionDic
{
    public function permissionOwnerSelect()
    {
        $permission = $this->permissionCollect();
        $permission=$permission->where('id','!=',0)->all();
        
        return $permission;
    }
    public function permissionAlbumSelect()
    {
        $permission = $this->permissionCollect();
        return $permission;
    }
    public function permissionPhotoSelect()
    {
        $arrayPermission = $this->permissionCollect();
        return $arrayPermission;
    }
    public function permissionSelectItem()
    {
    }
    public function permissionCollect()
    {
        //-1继承自上级权限（仅自己与管理员可以访问）
        //0禁止访问
        //1所有人可访问
        //2用户组和人员可以访问
        //3输入密码即可以访问
        //4符合权限后输入密码才可以访问
        //5回答问题可以访问
        //6符合权限后回答问题才可以访问
        //不可以访问人员及用户组
        $permission = collect(
            [
                [
                    'id' => 0,
                    'text' => '继承'
                ],
                [
                    'id' => 1,
                    'text' => '所有人可访问'
                ],
                [
                    'id' => 2,
                    'text' => '用户组和人员可以访问'
                ],
                [
                    'id' => 3,
                    'text' => '输入密码即可以访问'
                ],
                [
                    'id' => 4,
                    'text' => '符合权限后输入密码才可以访问'
                ],
                [
                    'id' => 5,
                    'text' => '回答问题可以访问'
                ],
                [
                    'id' => 6,
                    'text' => '符合权限后回答问题才可以访问'
                ],
                [
                    'id' => -1,
                    'text' => '禁止访问'
                ]
            ]
        );
        return $permission;
    }
    public function downloadableCollect()
    {
        $arrayDownloadable = collect(
            [
                [
                    'id' => 0,
                    'text' => '继承'
                ],
                [
                    'id' => 1,
                    'text' => '可下载'
                ],
                [
                    'id' => -1,
                    'text' => '禁止下载'
                ]
            ]
        );
        return $arrayDownloadable;
    }
    public function shareableCollect()
    {
        $arrayShareable = collect(
            [
                [
                    'id' => 0,
                    'text' => '继承'
                ],
                [
                    'id' => 1,
                    'text' => '可分享'
                ],
                [
                    'id' => -1,
                    'text' => '禁止分享'
                ]
            ]
        );
        return $arrayShareable;
    }
    /**
     * 
     */
    public function getParentPermissionText(int $id)
    {
        $col = $this->permissionCollect();
        $text = $col->where('id', '=', $id)->first()['text'];
        return $text;
    }
    public function getParentDownloadableText(int $id)
    {
        $col = $this->downloadableCollect();
        $text = $col->where('id', '=', $id)->first()['text'];
        return $text;
    }
    public function getParentShareableText(int $id)
    {
        $col = $this->permissionCollect();
        $text = $col->where('id', '=', $id)->first()['text'];
        return $text;
    }
}
