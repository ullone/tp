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
    $this->reply();
  }

  private function reply () {
    $app = new Foundation\Application($this->options);
    // 从项目实例中得到服务端应用实例。
    $server = $app->server;
    $server->setMessageHandler(function ($message) {
        // $message->FromUserName // 用户的 openid
        // $message->MsgType // 消息类型：event, text....
        // if(!empty($_GET['code']))
        return "fdfds";
        // else
          // return "success";
    });
    $response = $server->serve();
    $response->send(); // Laravel 里请使用：return $response;
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
