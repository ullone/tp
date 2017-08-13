<?php
namespace app\api\controller;

header("Content-Type:text/html; charset=utf-8");

require_once __DIR__ . '/../../../extend/autoload.php';
// include '/webdata/userAPI/vendor/autoload.php';

use app\index\controller;
use app\api\controller\Tool;
use EasyWeChat\Foundation as Foundation;

class UserAuth {

  private $openid;
  private $options;
  private $state;
  public function index () {
    $this->options = Tool::getOptions();
    // $this->getOpenId();
    $this->reply();
  }

  private function reply () {
    if(empty($_GET['code'])) exit('missing code');
    $app = new Foundation\Application($this->options);
    // 从项目实例中得到服务端应用实例。
    $server = $app->server;
    $server->setMessageHandler(function ($message) {
        // $message->FromUserName // 用户的 openid
        // $message->MsgType // 消息类型：event, text....
        return "您好！欢迎关注我!";
    });
    $response = $server->serve();
    $response->send(); // Laravel 里请使用：return $response;
  }

  private function authCheck () {
    if(empty($_GET['url']))
      $this->state = 'null';
    else $this->state = $_GET['url'];
    if(!empty($_GET['user_code'])){
      //应用有app_code
      $this->callBackUserInfo($_GET['user_code'], $this->state);
    }
    else {
      echo $this->getOpenId();
    }
  }
  private function callBackUserInfo($user_code,$last_url){
    //返回uid给应用
    $returnInfo = new ReturnUserInfo($user_code,$last_url);
    if(!$returnInfo->index()){
      $this->getOpenId();
    }
  }

  private function getOpenId(){
    //获取openid
    $config = [
      'app_id'   => 'wx1088ddeead7c4aa7',
      'secret'   => 'f8779402d2d919717ae7fe8a4fc26230',
      'redirect_uri' => '',
      'response_type' => 'code',
      's'
    ];
    $app   = new Foundation\Application($config);
    if(empty($_GET['code'])){
      $response = $app->oauth->scopes(['snsapi_base'])->redirect($this->state);
      $response->send();
    }
    $user = $app->oauth->user();
    //执行跳转，重定向操作
    // $operate = new Operate($user->getId());
    // $operate->index();
  }

  private function getQrcode () {
    $app = new Foundation\Application($this->options);
    $qrcode = $app->qrcode;
    $result = $qrcode->temporary(56, 6 * 24 * 3600);
    $ticket = $result->ticket;// 或者 $result['ticket']
    $expireSeconds = $result->expire_seconds; // 有效秒数
    $url = $result->url; // 二维码图片解析后的地址，开发者可根据该地址自行生成需要的二维码图片
    // var_dump($url);die ;
    // echo 'url:'.$url;
    // echo 'ticket:'.$ticket;
    echo '<img src="'.$qrcode->url($ticket).'">';
  }

  public function setMenu(){
    $app   = new Foundation\Application($this->options);
    if(empty($_GET['code'])){
      $response = $app->oauth->scopes(['snsapi_base'])->redirect($this->state);
      $response->send();
    }
    $menu = $app->menu;
    $buttons = [
      [
          "type" => "view",
          "name" => "商城",
          "url" => "http://dxzshop.cjiumeng.com/"
      ],
      [
          "type" => "view",
          "name" => "社区",
          "url" => "http://dxzchat.cjiumeng.com/"
      ],
      [
          "type" => "view",
          "name" => "关于我们",
          "url" => "http://dxzshop.cjiumeng.com/?feat=default"
      ],
    ];
    $menu->add($buttons);

  }
}
