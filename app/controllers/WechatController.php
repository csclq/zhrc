<?php
namespace App\controllers;


use Phalcon\Mvc\Controller;

class WechatController extends Controller {
    const APPID='wxbcf68516881437e2';
    const APPSECRET='2c8d5e5d50af9111cacaa157734b2a80';
    const TOKEN='pou08uhg';
    protected $token='';

    public function indexAction(){
        $this->view->disable();
        echo __METHOD__;
    }

    public function initialize(){
        if(empty($this->token)){
            $this->getToken();
        }
    }




    public function valid()
    {
        $echoStr = $_GET["echostr"];

        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            if(!empty( $keyword ))
            {
                $msgType = "text";
                $contentStr = "Welcome to wechat world!";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else{
                echo "Input something...";
            }

        }else {
            echo "";
            exit;
        }
    }

    private function checkSignature()
    {

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = self::TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }

    }
    //微信用户注册（绑定）
    public function registerAction(){
        $this->view->disable();
//        echo "<pre>";
//        var_dump($_SERVER);
        echo $this->setUrl('system/open');
    }
    //获取用户信息
    public function userinfoAction(){

    }
    //生成url
    protected function setUrl($url){

        return 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.self::APPID.'&redirect_uri='.urlencode( $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/wechat/userinfo/'.$url).'&response_type=code&scope=SCOPE&state=STATE#wechat_redirect';

    }

    public function menuAction(){
        $data=[
            'data'=>[
                'button'=>[
                    [  'type'=>'view',
                        'name'=>'网易',
                        'url'=>'http://www.163.com'
                    ],
                    [  'type'=>'view',
                        'name'=>'新浪',
                        'url'=>'http://www.sina.com.cn'
                    ],
                    [  'type'=>'view',
                        'name'=>'搜狐',
                        'url'=>'http://www.sohu.com'
                    ]

                ]
            ],
            'url'=>'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->token
        ];


       var_dump($this->thirdpart->setConfig($data)->curl_post());

    }

    protected function getToken(){
        if(!file_exists(APP_PATH.'/public/files/token.txt')){
            $this->setToken();
        }else{
            $token=json_decode(file_get_contents(APP_PATH.'/public/files/token.txt'));
            if(time()-$token->add_time>7000){
                $this->setToken();
            }else{
                $this->token=$token->token;
            }
        }
        return $this;
    }


    protected function setToken(){
        $res=json_decode(file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.self::APPID.'&secret='.self::APPSECRET));
        $token=array(
            'token' =>  $res->access_token,
            'add_time'  =>  time()
        );
        $this->token=$res->access_token;
        file_put_contents(APP_PATH.'/public/files/token.txt',json_encode($token));
    }


}