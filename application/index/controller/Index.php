<?php
namespace app\index\controller;

use \think\View;
use app\api\controller\CheckToken;

class Index
{
    public function index()
    {
        $first = new CheckToken();
        $first ->index();
        // $view = new \think\View();
        // return $view->fetch();
    }
}
