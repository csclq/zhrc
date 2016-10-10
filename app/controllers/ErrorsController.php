<?php


namespace App\controllers;


use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

class ErrorsController extends Controller{

    public function show404Action(){
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
    }


}