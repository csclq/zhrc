<?php
namespace App\models;

class Depart extends BaseModel {
    protected  $id;
    protected $name;
    protected $remark;
    protected $active;
    protected $add_time;
    protected $update_time;

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getRemark(){
        return  explode(',',$this->remark);
    }
    public function getActive(){
        return $this->active;
    }
    public function getAddTime(){
        return date("Y-m-d H:i:s",$this->add_time);
    }
    public function getUpdateTime(){
        return date("Y-m-d H:i:s",$this->update_time);
    }
    public function setId($id){
        $this->id=$id;
        return $this;
    }
    public function setName($name){
        $this->name=$name;
        return $this;
    }
    public function setRemark($remark){
        $this->remark=$remark;
        return $this;
    }
    public function setActive($active){
        $this->active=$active;
        return $this;
    }
    public function setAddTime(){
        $this->add_time=time();
        return $this;
    }
    public function setUpdateTime(){
        $this->update_time=time();
        return $this;
    }

    public function afterCreate(){
        $log=new Syslog();
        $log->setContent("新增".$this->getRemark()[0]."部门");
        $log->setUsername();
        $log->setAddIp();
        $log->setAddTime();
        $log->save();
    }


    public function afterUpdate(){
        $log=new Syslog();
        $log->setContent("修改".$this->getRemark()[0]."部门");
        $log->setUsername();
        $log->setAddIp();
        $log->setAddTime();
        $log->save();
    }

    public function afterDelete(){
        $log=new Syslog();
        $log->setContent("删除".$this->getRemark()[0]."部门");
        $log->setUsername();
        $log->setAddIp();
        $log->setAddTime();
        $log->save();
    }




    public function columnMap()
    {
        return array(
            'id' => 'id',
            'name' => 'name',
            'remark' => 'remark',
            'active' => 'active',
            'add_time' => 'add_time',
            'update_time' => 'update_time',
        );
    }

}