<?php
namespace App\controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public $uid;
    public $admin;

    public function initialize()
    {
        if (empty($this->session->get('uid'))) {
            return $this->dispatcher->forward(
                array(
                    'controller' => 'Login',
                    'action' => 'index'
                )
            );
        }
        $this->uid = $this->session->get('uid');
        $this->admin = $this->session->get('username');
        $this->view->user=$this->session->get('username');
        $this->view->menus = $this->authen->getAccessList();
        $this->view->currentcontroller=$this->dispatcher->getControllerName();
        $this->view->currentaction=$this->dispatcher->getActionName();


        if (!$this->authen->check($this->dispatcher)) {
            echo "<script>alert('您的权限不足');history.back()</script>";
        }
    }
}
