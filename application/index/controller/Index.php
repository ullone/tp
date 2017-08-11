<?php
namespace app\index\controller;

use \think\View;

class Index
{
    public function index()
    {
        // echo getTpl('index');
        $view = new \think\View();
        return $view->fetch();
    }
}
