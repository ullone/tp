<?php
namespace app\index\controller;

use \think\View;
use app\api\controller\CheckToken;
use app\api\controller\UserAuth;

class Index
{
    public function index()
    {
      // $first = new CheckToken();
      // $first ->index();
      $a = '<a href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1088ddeead7c4aa7&redirect_uri=http://rewrite.ullone.com/api/Oauth&response_type=code&scope=snsapi_base&state=123#wechat_redirect"></a>';
      $view = new \think\View();
      $view->a = $a;
      return $view->fetch();
      // $oAuth = new UserAuth();
      // $oAuth -> index();
    }
}
