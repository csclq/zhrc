<?php
namespace App\libs;

class ThirdPart{                                    //JAVA接口类
    public $url;                                    //接口url
    public $port=80;                                   //接口端口
    public $path='';                                //接口路径
    private $parm;                                  //传递的参数


    public function setConfig($parm){             //设置要传递的参数
        $this->url= empty($parm['url'])?$GLOBALS['config']['thirdpart']['url']:$parm['url'];
        $this->port= empty($parm['port'])?$GLOBALS['config']['thirdpart']['port']:$parm['port'];
        empty($parm['path'])||$this->path=$parm['path'];
        if(is_array($parm['data'])){
            $parm['data']=json_encode($parm['data']);
        }
        $this->parm=$parm['data'];
        return $this;
    }

   public function curl_post(){                 //post接口返回数据
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_PORT => $this->port,
            CURLOPT_URL => $this->url.$this->path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $this->parm,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                return $err;
            } else {
                return $response;
            }

    }

}