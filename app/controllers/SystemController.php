<?php
namespace App\Controllers;

use App\Models\Admin;
use App\Models\App;
use App\Models\Depart;
use App\Models\Permission;
use App\Models\Syslog;

class SystemController extends ControllerBase
{


    public function userAction()
    {
        if ($this->request->isPost()) {
            $this->view->disable();
            $post = json_decode(file_get_contents("php://input"), true);
            $where = '1=1';
            empty($post['username']) || $where .= " and name like '%" . htmlspecialchars(trim($post['username'])) . "%'";
            empty($post['depart']) || $where .= " and depart=" . intval($post['depart']);
            $limit = array('number' => $GLOBALS['config']['pageNum'], 'offset' => (intval($post['p']) - 1) * $GLOBALS['config']['pageNum']);
            $arr = array($where, 'limit' => $limit, 'order' => 'id desc');
            $user = Admin::find($arr);

            $total = Admin::count($where);
            $info = array('total' => ceil($total / $GLOBALS['config']['pageNum']),
                'info' => $user->toArray());
            echo json_encode($info);
        }
        $this->view->departs = Depart::find()->toArray();

    }

    public function departAction()
    {
        if ($this->request->isPost()) {
            $this->view->disable();
            $post = json_decode(file_get_contents("php://input"), true);
            $where = 'active=1';
            empty($post['username']) || $where .= " and name like '%" . htmlspecialchars(trim($post['username'])) . "%'";
            empty($post['remark']) || $where .= " and remark like '%" . htmlspecialchars(trim($post['remark'])) . "%'";
            $limit = array('number' => $GLOBALS['config']['pageNum'], 'offset' => (intval($post['p']) - 1) * $GLOBALS['config']['pageNum']);
            $arr = array($where, 'limit' => $limit, 'order' => 'id desc');
            $user = Depart::find($arr);

            $total = Depart::count($where);
            $info = array('total' => ceil($total / $GLOBALS['config']['pageNum']),
                'info' => $user->toArray());
            echo json_encode($info);
        }

    }

    public function appAction()
    {


    }

    public function clearcacheAction()
    {             //清队缓存
        $this->common->cleancache();
        $this->common->cleancache();
        echo "<script>alert('缓存清除成功');history.back()</script>";
    }

    public function backupAction()
    {               //数据备份
        $total = ceil($this->common->dircount() / $GLOBALS['config']['pageNum']);
        $this->view->total = $total;
        if ($this->request->isPost()) {
            $this->view->disable();
            $post = json_decode(file_get_contents("php://input"), true);

            if (isset($post['back'])) {
                $this->common->databackup();
                if ($this->common->dircount() % $GLOBALS['config']['pageNum'] == 1) {
                    $total++;
                }
                $p = $total;
            } else {
                $p = $post['p'];
            }

            $file = $this->common->fileList($p);
            $i = 0;
            $filelist = array();
            foreach ($file as $v) {
                if ($i++ < $GLOBALS['config']['pageNum']) {
                    $info['filename'] = $v;
                    $info['path'] = $GLOBALS['config']['dataDir'] . $v;
                    $info['mtime'] = date("Y-m-d H:i:s", filemtime(getcwd() . $info['path']));
                    array_push($filelist, $info);
                }
            }
            $info = array('total' => $total,
                'info' => $filelist);
            echo json_encode($info);

        }

    }

    public function delbackupAction()
    {
        $this->view->disable();
        if ($this->request->isGet()) {
            $file = getcwd() . $GLOBALS['config']['dataDir'] . trim($this->dispatcher->getParam(0));
            if (file_exists($file)) {
                unlink($file);
            }
        }
        if ($this->request->isPost()) {
            if ($this->request->getPost('backfile')) {
                foreach ($this->request->getPost('backfile') as $v) {
                    $file = getcwd() . $GLOBALS['config']['dataDir'] . trim($v);
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
            }
        }


        $this->response->redirect('/system/backup');


    }

    public function adduserAction()
    {                                            //添加管理员
        if ($this->request->isPost()) {
            $this->view->disable();
            if (stristr($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded')) {
                $post = $_POST;
            } elseif (stristr($_SERVER['CONTENT_TYPE'], 'application/json')) {
                $post = json_decode(file_get_contents("php://input"), true);
            }

            $admin = new Admin();
            $admin->setPasswd(md5(trim($post['passwd'])));
            $admin->setAddTime();
            $admin->setName(htmlspecialchars(trim($post['name'])));
            $admin->setDepart(intval(trim($post['depart'])));
            $admin->create();
            exit;
        }
    }

    public function chuserAction()
    {                                            //修改管理员
        if ($this->request->isPost()) {
            $this->view->disable();
            $id = intval($this->request->getPost('id'));
            $depart = intval($this->request->getPost('depart'));
            $active = intval($this->request->getPost('active'));
            $username = htmlspecialchars(trim($this->request->getPost('name')));

            $admin = Admin::findFirst($id);
            empty($username) || $admin->setName($username);
            $admin->setDepart($depart);
            $admin->setActive($active);
            $admin->setUpdateTime();
            $admin->save();
            return $this->response->redirect('/system/user');
        }
    }


    public function adddepartAction()
    {                                            //添加新部门
        if ($this->request->isPost()) {
            $this->view->disable();
            if (stristr($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded')) {
                $post = $_POST;
            } elseif (stristr($_SERVER['CONTENT_TYPE'], 'application/json')) {
                $post = json_decode(file_get_contents("php://input"), true);
            }
            $admin = new Depart();
            $admin->setAddTime();
            $admin->setName(htmlspecialchars(trim($post['name'])));
            $admin->setRemark(htmlspecialchars(trim($post['remark'])));

            $admin->save();
            if ($admin->getId()) {
                echo 1;
            } else {
                echo 0;
            }
            exit;
        }
    }


    public function deleteUserAction()
    {                                     //删除管理员
        if ($this->request->isPost()) {
            $this->view->disable();
            $post = json_decode(file_get_contents("php://input"), true);
            $model = Admin::findFirst(intval($post['id']));
            $model->delete();
            exit;
        }
    }

    public function deleteDepartAction()
    {                               //删除部门
        if ($this->request->isPost()) {
            $this->view->disable();
            $post = json_decode(file_get_contents("php://input"), true);
            $model = Depart::findFirst(intval($post['id']));
            $model->delete();
            exit;
        }
    }

    public function permissionAction()
    {                                //权限管理
        $did = intval($this->dispatcher->getParam(0));
        if (!$did) {
            $this->view->disable();
            echo "<script>alert('选择部门出错');history.back();</script>";
        }
        if ($this->request->isPost()) {
            $this->modelsManager->executeQuery("delete from App\Models\Permission where did=:did:", array('did' => $did));
            foreach ($_POST['app'] as $v) {
                $model = new Permission();
                $model->setAid($v);
                $model->setDid($did);
                $model->save();
            }

        }
        $perm = App::find('active=1');
        $arr = array();
        $acc = Permission::find('did=' . $did);
        if ($acc) {
            foreach ($acc as $v) {
                array_push($arr, $v->aid);
            }
        }
        $list = $this->common->infinate($perm->toArray(), 0, $arr);


        $this->view->list = $list;
    }

    public function addappAction()
    {                         //添加新应用
        if ($this->request->isPost()) {
            $this->view->disable();
            $post = json_decode(file_get_contents("php://input"), true);
            $app = new App();
            $app->setName(htmlspecialchars(trim($post['name'])));
            $app->setRemark(htmlspecialchars(trim($post['remark'])));
            $app->setPid(intval($post['pid']));
            $app->setShow(intval($post['show']));
            $app->setLevel(intval($post['pid']) > 0 ? 2 : 1);
            $app->setAddTime();
            $app->setAddIp();
            $app->save();
        }
    }

    public function chpassAction()
    {              //密码修改
        if ($this->request->isPost()) {
            $this->view->disable();
            $oldpass=trim($this->request->getPost('oldpass'));
            $newpass=trim($this->request->getPost('newpass'));
            if(empty($oldpass)||empty($newpass)){
                echo "<script>alert('密码不能为空'),history.back();</script>";
                exit;
            }
            $user=Admin::findFirst($this->uid);
            if(md5($oldpass)!=$user->getPasswd()){
                echo "<script>alert('原密码错误'),history.back();</script>";
                exit;
            }
            $user->setPasswd(md5($newpass));
            $user->update();
            echo "<script>alert('密码修改成功'),history.back();</script>";
            exit;
        }else{
            $this->response->setStatusCode(404, "Not Found");
        }
    }

    public function operlogAction(){                //系统操作日志
        if ($this->request->isPost()) {
            $this->view->disable();
            $post = json_decode(file_get_contents("php://input"), true);
            $where = '1=1';
            empty($post['username']) || $where .= " and username like '%" . htmlspecialchars(trim($post['username'])) . "%'";
            empty($post['content']) || $where .= " and content like '%" . htmlspecialchars(trim($post['content'])) . "%'";
            $limit = array('number' => $GLOBALS['config']['pageNum'], 'offset' => (intval($post['p']) - 1) * $GLOBALS['config']['pageNum']);
            $arr = array($where, 'limit' => $limit, 'order' => 'id desc');
            $list = Syslog::find($arr);

            $total = Syslog::count($where);
            $info = array('total' => ceil($total / $GLOBALS['config']['pageNum']),
                'info' => $list->toArray());
            echo json_encode($info);
        }
    }




    public function testAction()
    {
//        if($this->request->isPost()){
        $this->view->disable();

        $depart=Depart::findFirst(1);
        var_dump($depart->getRemark());
    }
//    }


}