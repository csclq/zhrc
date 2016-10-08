<?php
namespace App\models;

class Admin extends BaseModel {

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $passwd;

    /**
     *
     * @var integer
     */
    protected $depart;

    /**
     *
     * @var integer
     */
    protected $active;

    /**
     *
     * @var integer
     */
    protected $add_time;

    /**
     *
     * @var integer
     */
    protected $update_time;

    /**
     *
     * @var string
     */
    protected $login_ip;

    /**
     *
     * @var integer
     */
    protected $login_time;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field passwd
     *
     * @param string $passwd
     * @return $this
     */
    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;

        return $this;
    }

    /**
     * Method to set the value of field gid
     *
     * @param integer $gid
     * @return $this
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Method to set the value of field active
     *
     * @param integer $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Method to set the value of field add_time
     *
     * @param integer $add_time
     * @return $this
     */
    public function setAddTime()
    {
        $this->add_time = time();

        return $this;
    }

    /**
     * Method to set the value of field update_time
     *
     * @param integer $update_time
     * @return $this
     */
    public function setUpdateTime()
    {
        $this->update_time = time();

        return $this;
    }

    /**
     * Method to set the value of field login_ip
     *
     * @param string $login_ip
     * @return $this
     */
    public function setLoginIp()
    {
        $this->login_ip = $_SERVER['REMOTE_ADDR'];

        return $this;
    }

    /**
     * Method to set the value of field login_time
     *
     * @param integer $login_time
     * @return $this
     */
    public function setLoginTime()
    {
        $this->login_time = time();

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field passwd
     *
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Returns the value of field gid
     *
     * @return integer
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * Returns the value of field active
     *
     * @return integer
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Returns the value of field add_time
     *
     * @return integer
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

    /**
     * Returns the value of field update_time
     *
     * @return integer
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Returns the value of field login_ip
     *
     * @return string
     */
    public function getLoginIp()
    {
        return $this->login_ip;
    }

    /**
     * Returns the value of field login_time
     *
     * @return integer
     */
    public function getLoginTime()
    {
        return $this->login_time;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('depart', 'App\Models\Depart', 'id', array('alias' => 'department'));
        $this->hasManyToMany(
            "depart",
            'App\Models\Permission',
            "did", "aid",
            "App\Models\App",
            "id",array('alias'=>'permisn')
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */


    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ZhAdmin[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ZhAdmin
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

//    public function afterSave(){
//        $log=new Syslog();
//        $log->setContent("新增(修改)".$this->getName()."管理员");
//        $log->setUsername();
//        $log->setAddIp();
//        $log->setAddTime();
//        $log->save();
//    }


    public function afterCreate(){
        $log=new Syslog();
        $log->setContent("新增".$this->getName()."管理员");
        $log->setUsername();
        $log->setAddIp();
        $log->setAddTime();
        $log->save();
    }


    public function afterUpdate(){
        $log=new Syslog();
        $log->setContent("修改".$this->getName()."管理员");
        $log->setUsername();
        $log->setAddIp();
        $log->setAddTime();
        $log->save();
    }

    public function afterDelete(){
        $log=new Syslog();
        $log->setContent("删除".$this->getName()."管理员");
        $log->setUsername();
        $log->setAddIp();
        $log->setAddTime();
        $log->save();
    }



    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return array(
            'id' => 'id',
            'name' => 'name',
            'passwd' => 'passwd',
            'depart' => 'depart',
            'active' => 'active',
            'add_time' => 'add_time',
            'update_time' => 'update_time',
            'login_ip' => 'login_ip',
            'login_time' => 'login_time'
        );
    }
}