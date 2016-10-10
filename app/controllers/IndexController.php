<?php
namespace App\controllers;


use Phalcon\Mvc\Controller;

class IndexController extends Controller
{

    public function indexAction()
    {
        $this->view->title = "abcedfg";

    }

    public function sayAction()
    {
        $this->view->disable();
        echo __METHOD__;
    }

    public function testAction()
    {


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


    public function phpinfoAction(){
        $this->view->disable();
        phpinfo();
    }
}

