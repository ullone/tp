<?php
namespace app\api\controller;

header("Content-Type:text/html; charset=utf-8");

require_once __DIR__ . '/../../../extend/autoload.php';
// include '/webdata/userAPI/vendor/autoload.php';

use app\index\controller;
use app\api\controller\Tool;
use EasyWeChat\Foundation as Foundation;

class Oauth {

  private $openid;
  private $options;
  private $state;
  public function index () {
    // $this->options = Tool::getOptions();
    $this->authCheck();
  }

  private function authCheck () {
    $code = $_GET['code'];//获取code
    $weixin =  file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx1088ddeead7c4aa7&secret=f8779402d2d919717ae7fe8a4fc26230&code=".$code."&grant_type=authorization_code");//通过code换取网页授权access_token
    $jsondecode = json_decode($weixin); //对JSON格式的字符串进行编码
    $array = get_object_vars($jsondecode);//转换成数组
    $openid = $array['openid'];//输出openid
    exit($openid);
    // if(empty($_GET['url']))
    //   $this->state = 'null';
    // else $this->state = $_GET['url'];
    // if(!empty($_GET['user_code'])){
    //   //应用有app_code
    //   $this->callBackUserInfo($_GET['user_code'], $this->state);
    // }
    // else {
    //   echo $this->getOpenId();
    // }
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
}
