<?php
namespace App\controllers;

use App\models\Admin;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

class LoginController extends Controller {

    public function indexAction(){
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);

    }

    public function loginAction(){
        $this->view->disable();
        $code=trim(htmlspecialchars($this->request->getPost('code')));
        if(strtolower($code)!=$this->session->get('verify_code')){
            echo "<script>alert('验证码错误');history.back();</script>";
        }
        $username=trim(htmlspecialchars($this->request->getPost('username')));
        $password=md5(trim(htmlspecialchars($this->request->getPost('password'))));
        if(empty($code)||empty($username)||empty($password)){
            echo "<script>alert('用户名或密码不能为空');history.back();</script>";
        }
        $where=array(
                "name =  :name: and passwd = :passwd:",
                 'bind'  =>  array(
                'name'  =>  $username,
                'passwd'    =>  $password
            )
        );
        $user=Admin::findFirst($where);
        if($user){
            if($user->getActive()==0){
                echo "<script>alert('该用户已经被冻结');history.back();</script>";
                exit;
            }
            $this->session->set('depart_id',$user->getDepart());
            $this->session->set('username',$username);
            $this->session->set('uid',$user->getId());
            header("location:/system/user");
        }else{
           echo "<script>alert('用户名或密码错误');history.back();</script>";
            exit;
        }
    }

    public function verifyAction(){
        $this->view->setRenderLevel(VIEW::LEVEL_NO_RENDER);
        ob_clean();
        header('Content-type: image/png');
        $this->captcha->build();
    }

    public function logoutAction(){
        $this->session->destroy();
        return $this->dispatcher->forward(array(
            'controller'    =>  'login',
            'action'    =>  'index'
        ));
    }
}