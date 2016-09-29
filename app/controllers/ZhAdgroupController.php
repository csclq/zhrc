<?php
namespace App\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use App\Models\ZhAdgroup;

class ZhAdgroupController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for zh_adgroup
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, '\App\Models\ZhAdgroup', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $zh_adgroup = ZhAdgroup::find($parameters);
        if (count($zh_adgroup) == 0) {
            $this->flash->notice("The search did not find any zh_adgroup");

            $this->dispatcher->forward(array(
                "controller" => "zh_adgroup",
                "action" => "index"
            ));

            return;
        }

        $paginator = new Paginator(array(
            'data' => $zh_adgroup,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a zh_adgroup
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $zh_adgroup = ZhAdgroup::findFirstByid($id);
            if (!$zh_adgroup) {
                $this->flash->error("zh_adgroup was not found");

                $this->dispatcher->forward(array(
                    'controller' => "zh_adgroup",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $zh_adgroup->id;

            $this->tag->setDefault("id", $zh_adgroup->id);
            $this->tag->setDefault("name", $zh_adgroup->name);
            $this->tag->setDefault("permission", $zh_adgroup->permission);
            $this->tag->setDefault("add_time", $zh_adgroup->add_time);
            $this->tag->setDefault("update_time", $zh_adgroup->update_time);
            $this->tag->setDefault("active", $zh_adgroup->active);
            
        }
    }

    /**
     * Creates a new zh_adgroup
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zh_adgroup",
                'action' => 'index'
            ));

            return;
        }

        $zh_adgroup = new ZhAdgroup();
        $zh_adgroup->name = $this->request->getPost("name");
        $zh_adgroup->permission = $this->request->getPost("permission");
        $zh_adgroup->add_time = $this->request->getPost("add_time");
        $zh_adgroup->update_time = $this->request->getPost("update_time");
        $zh_adgroup->active = $this->request->getPost("active");
        

        if (!$zh_adgroup->save()) {
            foreach ($zh_adgroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zh_adgroup",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("zh_adgroup was created successfully");

        $this->dispatcher->forward(array(
            'controller' => "zh_adgroup",
            'action' => 'index'
        ));
    }

    /**
     * Saves a zh_adgroup edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "zh_adgroup",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $zh_adgroup = ZhAdgroup::findFirstByid($id);

        if (!$zh_adgroup) {
            $this->flash->error("zh_adgroup does not exist " . $id);

            $this->dispatcher->forward(array(
                'controller' => "zh_adgroup",
                'action' => 'index'
            ));

            return;
        }

        $zh_adgroup->name = $this->request->getPost("name");
        $zh_adgroup->permission = $this->request->getPost("permission");
        $zh_adgroup->add_time = $this->request->getPost("add_time");
        $zh_adgroup->update_time = $this->request->getPost("update_time");
        $zh_adgroup->active = $this->request->getPost("active");
        

        if (!$zh_adgroup->save()) {

            foreach ($zh_adgroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zh_adgroup",
                'action' => 'edit',
                'params' => array($zh_adgroup->id)
            ));

            return;
        }

        $this->flash->success("zh_adgroup was updated successfully");

        $this->dispatcher->forward(array(
            'controller' => "zh_adgroup",
            'action' => 'index'
        ));
    }

    /**
     * Deletes a zh_adgroup
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $zh_adgroup = ZhAdgroup::findFirstByid($id);
        if (!$zh_adgroup) {
            $this->flash->error("zh_adgroup was not found");

            $this->dispatcher->forward(array(
                'controller' => "zh_adgroup",
                'action' => 'index'
            ));

            return;
        }

        if (!$zh_adgroup->delete()) {

            foreach ($zh_adgroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "zh_adgroup",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("zh_adgroup was deleted successfully");

        $this->dispatcher->forward(array(
            'controller' => "zh_adgroup",
            'action' => "index"
        ));
    }

    public function testAction(){
        echo __METHOD__;
    }

}
