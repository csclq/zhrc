<?php
namespace App\models;

class App extends BaseModel {

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
    protected $remark;

    /**
     *
     * @var integer
     */
    protected $pid;
    protected $level;

    /**
     *
     * @var integer
     */
    protected $active;
    protected $show;

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
    protected $add_ip;

    /**
     *
     * @var string
     */
    protected $update_ip;

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
    public function setShow($show)
    {
        $this->show = $show;

        return $this;
    }

    /**
     * Method to set the value of field passwd
     *
     * @param string $passwd
     * @return $this
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Method to set the value of field gid
     *
     * @param integer $gid
     * @return $this
     */
    public function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * Method to set the value of field active
     *
     * @param integer $active
     * @return $this
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }
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
    public function setAddIp()
    {
        $this->add_ip = $_SERVER['REMOTE_ADDR'];

        return $this;
    }

    /**
     * Method to set the value of field login_time
     *
     * @param integer $login_time
     * @return $this
     */
    public function setUpdateIp()
    {
        $this->update_ip = $_SERVER['REMOTE_ADDR'];

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
    public function getRemark()
    {
        return $this->remark;
    }

    public function getShow()
    {
        return $this->show;
    }
    /**
     * Returns the value of field gid
     *
     * @return integer
     */
    public function getPid()
    {
        return $this->pid;
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
    public function getAddIp()
    {
        return $this->add_ip;
    }
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Returns the value of field login_time
     *
     * @return integer
     */
    public function getUpdateIp()
    {
        return $this->update_ip;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
//        $this->belongsTo('depart', 'App\Models\Depart', 'id', array('alias' => 'department'));
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
            'remark' => 'remark',
            'level' => 'level',
            'pid'   =>  'pid',
            'active' => 'active',
            'show' => 'show',
            'add_time' => 'add_time',
            'update_time' => 'update_time',
            'add_ip' => 'add_ip',
            'update_ip' => 'update_ip'
        );
    }
}