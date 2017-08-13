<?php
namespace app\api\controller;

class Tool {
  public function index () {

  }

  public static function getOptions () {
    return [
      'debug'    => true,
      //测试服务号
      'app_id'   => 'wx1088ddeead7c4aa7',
      'secret'   => 'f8779402d2d919717ae7fe8a4fc26230',
      'token'    => 'qrcodetest',
      'log'      => [
        'level'  => 'debug',
        'file'   => '/tmp/easywechat.log'
      ],
    ];
  }
}
