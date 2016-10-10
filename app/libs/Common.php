<?php
namespace App\libs;


use App\models\Syslog;



class Common{

    public static function infinate($arr,$level=0,$access=null){         //无限极分类
        $res=array();
        for($i=0;$i<count($arr);$i++){
            if(is_array($access)){
                $arr[$i]['checked']=in_array($arr[$i]['id'],$access);
            }else{
                $arr[$i]['checked']=false;
            }
            if($arr[$i]['pid']==$level){
                $arr[$i]['child']=self::infinate($arr,$arr[$i]['id'],$access);
                array_push($res,$arr[$i]);
            }

        }
        return $res;
    }

   public static function itoc36($number,&$pasenum){                 //十进制整数转36进制        number要转换的整数，pasenum转换后的数字
        $shu=array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $len=count($shu);
        if($number<$len){
            $pasenum.=$shu[$number];
        }else{

            itoc36(intval($number/$len),$pasenum);
            $pasenum.=$shu[$number%$len];
        }
    }
    public static function c36toi($str){                               //36进制转十进制             str要转换的数字
        $shu=array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $n=0;
        for($i=strlen($str);$i>0;$i--){
            $n+=intval(array_search($str[$i-1],$shu)*pow(count($shu),(strlen($str)-$i)));
        }
        return $n;                                      //返回转换后的数字
    }

    public static function databackup(){            //数据库手动备份 **必须设置mysql环境变量
            $filename=$GLOBALS['config']['dataDir'].date("YmdHis",time()).".sql";
            $command="mysqldump -h ".$GLOBALS['config']['database']['host']. " -u ".$GLOBALS['config']['database']['username']." -p".$GLOBALS['config']['database']['password']." ".$GLOBALS['config']['database']['dbname']." > ".getcwd().$filename;
            system($command);
            sleep(1);
            return $filename;                       //返回备份文件名

    }

    public static function say(){
        echo __METHOD__;
    }

    public static function cleancache($dir=null){               //清除缓存文件
        $dir||$dir= $GLOBALS['config']['application']['cacheDir'];
//        $dir=trim($dir,DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
        $source=opendir($dir);
        if(count(scandir($dir))==2){
            return;
        }
        while ($file=readdir($source)){
            if($file=='.'||$file=='..')
                continue;
            if(is_dir($dir.$file)&&count(scandir($dir.$file))>2){
                self::cleancache($dir.$file.DIRECTORY_SEPARATOR);
            }
            if(is_dir($dir.$file)&&count(scandir($dir.$file))==2){
                    rmdir($dir.$file);
                    continue;
            }

            if(is_file($dir.$file))
            unlink($dir.$file);
        }
    }

    public static function fileList($p=1,$dir=null){                 //查看目录下的文件
        empty($dir)&&$dir=getcwd().$GLOBALS['config']['dataDir'];
        $i=0;
        $res=opendir($dir);
        if($res){
            while ($file=readdir($res)){
                if(is_file($dir.$file)){
                    if($i++<($p-1)*$GLOBALS['config']['pageNum']){
                        continue;
                    }

                    yield $file;
                }
            }
        }
    }

    public static function  get($arg=null){                     //PATHINFO get
       $arr=array();
      $params= $GLOBALS['application']->dispatcher->getParams();
        if(is_array($params)){
            for($i=0;$i<count($params);$i+=2){
                if(($i+1)<count($params)){
                    $arr[$params[$i]]=$params[$i+1];
                }
            }
        }
        if($arg){
            if(array_key_exists($arg,$arr)){
                return $arr[$arg];
            }else{
                return null;
            }
        }else{
          return  $arr;
        }
    }


    public static function dircount($dir=null){            // 获取指定文件夹下文件数量
        $dir||$dir= getcwd().$GLOBALS['config']['dataDir'];
        return count(scandir($dir))-2;
    }

    public static function syslog($content){
        $log=new Syslog();
        $log->setAddTime();
        $log->setAddIp();
        $log->setUsername($_SESSION['username']);
        $log->setContent($content);
        $log->save();
    }



}