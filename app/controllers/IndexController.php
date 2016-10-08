<?php
namespace App\controllers;


use Phalcon\Mvc\Controller;

class IndexController extends Controller
{

    public function indexAction()
    {
        $this->view->title = "abcedfg";
//        $this->view->disable();
//        $admin=new Admin();
//        $depart=new Depart();
//        $depart->setAddTime(time());
//        $depart->setName("财务");
//        $depart->setUpdateTime(time());
//        $depart->setRemark("财务");
//        $arr=array(
//            'name'  =>  'wangchao',
//            'passwd'    =>  md5("123456"),
//            'depart'    =>  $depart,
//            'add_time'  =>  time(),
//            'update_time'   =>  time(),
//            'login_time'    =>  time(),
//            'login_ip'  =>  $_SERVER['REMOTE_ADDR']
//        );
//        $admin->setName("wangchao");
//        $admin->setDepart($depart);

//        var_dump($admin->save());
//        echo '<br />',$admin->getId();

//        var_dump(Admin::findFirst()->permisn->toArray());
//        $depart= Depart::find()->toArray();
//        foreach ($depart as &$item) {
////            var_dump($item);
//            $depart['perm']=App::find(array("id in :id",
//                "bind" => array('id'=>$item['permission'])));
//        }
//        var_dump($depart);
//        echo __METHOD__;
//        echo "<pre>";
//        print_r($this->view->menus);
    }

    public function sayAction()
    {
        $this->view->disable();
        echo __METHOD__;
    }

    public function testAction()
    {
//        $this->view->disable();
    }



    public function uploadAction()                          //图片上传
    {
        $this->view->disable();
        if ($this->request->hasFiles() == true) {
        $types = ['jpg', 'jpeg', 'gif', 'png'];             //上传类型
        $sizes = 6291456;                                   //上传大小
        $info = array();
        foreach ($_FILES['img']['type'] as $type) {
            if (!in_array(explode('/',$type)[1], $types)) {
                exit(json_encode(['code' => 0, 'msg' => '上传类型错误']));
            }
        }
        foreach ($_FILES['img']['size'] as $size) {
            if ($size > $sizes) {
                exit(json_encode(['code' => 0, 'msg' => '上传文件超大']));
            }
        }
        for ($i=0;$i<count($_FILES['img']['tmp_name']);$i++) {
            $file=uniqid().'.'.explode('/',$_FILES['img']['type'][$i])[1];
            move_uploaded_file($_FILES['img']['tmp_name'][$i], getcwd() . $GLOBALS['config']['uploadDir'] .$file);
            $info[$i]=$GLOBALS['config']['uploadDir'] . $file;
        }
        echo json_encode(['code'=>1,'msg'=>'ok','info'=>$info]);



        }

    }
}

