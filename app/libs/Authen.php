<?php

namespace App\libs;


use App\Models\Permission;
use App\Models\App;

class Authen{                                   //权限管理

    public  $depart;
    private $accesslist=array();

    public function __construct()
    {
        $this->depart=$_SESSION['depart_id'];
        $this->getAccess();
    }

    private function getAccess(){

        if($GLOBALS['config']['superadmin']==$_SESSION['username']){
            $this->accesslist=Common::infinate(App::find()->toArray());
        }else{
            $arr=array();
            $acc=Permission::find('did='.$this->depart);

            if($acc){
                foreach ($acc as $v){
                    array_push($arr,$v->app->toArray());
                }
            }
            $this->accesslist=Common::infinate($arr);
        }

    }

    public function getAccessList(){
        return $this->accesslist;
    }

    public function check($route){
//        return in_array(ucfirst(strtolower($route->getControllerName())).'Controller',$this->accesslist)&&in_array(strtolower($route->getActionName()),$this->accesslist);
        $result=false;
        if($GLOBALS['config']['superadmin']==$_SESSION['username']){
            $result=true;
        }else{
        foreach ($this->accesslist as $v){
            if(strtolower($route->getControllerName())==strtolower(trim($v['name']))){
                foreach ($v['child'] as $action){
                    if( strtolower($route->getActionName())==strtolower(trim($action['name']))){
                        $result=true;
                    }
                }
            }
        }}
        return $result;
    }




}