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
      $oAuth = new UserAuth();
      $oAuth -> index();
    }
}
