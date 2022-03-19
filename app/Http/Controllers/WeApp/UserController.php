<?php

namespace App\Http\Controllers\WeApp;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
class UserController extends Controller
{
    //
    public int $aaa;

    public function onLogin(string $code)
    {
        
        //https://api.weixin.qq.com/sns/jscode2session?appid=APPID&secret=SECRET&js_code=JSCODE&grant_type=authorization_code
        //AppID(小程序ID)wx224848dcd0a8cf8b	
        //AppSecret(小程序密钥)b23a6352c88384e3de1da7da649b890a
        $query_data = array(
            'appid' => 'wx224848dcd0a8cf8b',
            'secret' => 'b23a6352c88384e3de1da7da649b890a',
            'js_code' => $code,
            'grant_type' => 'authorization_code'
        );
        $authurl='https://api.weixin.qq.com/sns/jscode2session';
        //$authurl='http://127.0.0.1:8000/wxprog/test';
        $temp = $this->send_get($authurl,$query_data);
        $result = json_decode($temp);
        
        if(!property_exists($result,'errcode'))
        {
            // openid	string	用户唯一标识
            // session_key	string	会话密钥
            // unionid	string	用户在开放平台的唯一标识符，若当前小程序已绑定到微信开放平台帐号下会返回，详见 UnionID 机制说明。
            // errcode	number	错误码
            // errmsg	string	错误信息
            $unionid = null;
            if(property_exists($result,'unionid'))
            {
                    $unionid=$result.unionid;
            }
            $user=DB::table('user')->where('openid','=',$result->openid)->first();
            if($user!=null){
                $useId=DB::table('user')->insertGetId(
                    [
                        'openid'=>$result->openid,
                        'session_key'=>$result->session_key,
                         'unionid'=>$unionid
                    ]);
            }else{
                DB::table('user')->where('openid',$result->openid)
                ->update(['session_key',$result->session_key,'unionid'=>$unionid]);
            }

            //$user=User::
           
                
            //$result.openid;
        }
        else{
            return $result;
        }
    }
    public function SaveUserInfo()
    {

    }
    function test()
    {
        //$name = Request::input('appid');
        $name = phpinfo();
        return $name;
    }
    private function send_get($url, $query_data) {
        $getdata = http_build_query($query_data);
        $options = array(
            'http' => array(
                'method' => 'GET',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                //'header' => 'Content-type:application/json',
                //'content' => $getdata,
                'timeout' => 6 // 超时时间（单位:s）
            )
        );
        $context = stream_context_create($options);
        //$url=$url.'?appid='.$query_data["appid"].'&secret='.$query_data['secret'].'&js_code='.$query_data["js_code"].'&grant_type='.$query_data["grant_type"];
        $result = file_get_contents($url.'?'.$getdata,false,$context);
        return $result;
    }

}
