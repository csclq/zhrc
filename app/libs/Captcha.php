<?php
namespace  App\libs;

class Captcha{                                              //验证码类
    public $size=5;                                        //字体大小
    public $width=80;                                      //图像宽度
    public $height=24;                                      //图像高度
    public $number=4;                                       //验证个数
    public $type=10;                                        //图像类型 10：全数字，26：全字母
    public $dots=100;                                        //干扰点数
    public $lines=4;                                        //干扰线数
    public $chars=['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

    public function setConfig($config){                     //设置参数
        empty($config['size'])|| $this->size=$config['size'];
        empty($config['width'])|| $this->width=$config['width'];
        empty($config['height'])|| $this->height=$config['height'];
        empty($config['number'])|| $this->number=$config['number'];
        empty($config['type'])|| $this->type=$config['type'];
        empty($config['dots'])|| $this->dots=$config['dots'];
        empty($config['lines'])|| $this->lines=$config['lines'];
    }

    public function build(){                                //生成图像
        if(!isset($_SESSION)){
            session_start();
        }
        switch ($this->type){
            case 10:
                $char=array_slice($this->chars,0,10);
                break;
            case 26:
                $char=array_slice($this->chars,10);
                break;
            default:
                $char=$this->chars;
        }
        $str="";
        for($i=0;$i<$this->number;$i++){
            $str.=$char[array_rand($char)];
        }
        $im=imagecreatetruecolor($this->width,$this->height);
        $bgcolor=imagecolorallocate($im,rand(180,250),rand(180,250),rand(180,250));
        imagefill($im,0,0,$bgcolor);
        for($i=0;$i<$this->dots;$i++){
            imagesetpixel($im,rand(0,$this->width),rand(0,$this->height),imagecolorallocate($im,rand(120,200),rand(120,200),rand(120,200)));
        }
        for($i=0;$i<$this->lines;$i++){
            $x1=rand(0,$this->width);
            $x2=rand(0,$this->width);
            $y1=rand(0,$this->height);
            $y2=rand(0,$this->height);
            imageline($im,min($x1,$x2),min($y1,$y2),max($x1,$x2),max($y1,$y2),imagecolorallocate($im,rand(100,220),rand(100,220),rand(100,220)));
        }
        $_SESSION['verify_code']=strtolower($str);

        for($i=0;$i<$this->number;$i++){
            imagechar($im,$this->size,$i*20+5,rand(0,10),$str[$i],imagecolorallocate($im,rand(0,150),rand(0,150),rand(0,150)));
        }
        imagepng($im);
        imagedestroy($im);
    }



}