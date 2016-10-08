<?php
namespace App\models;

class Syslog extends BaseModel {

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $content;

    /**
     *
     * @var string
     */
    protected $username;

    /**
     *
     * @var integer
     */
    protected $add_time;

    /**
     *
     * @var string
     */
    protected $add_ip;

    /**
     *
     * @var integer
     */

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }


    public function setUsername()
    {
        $this->username = $_SESSION['username'];

        return $this;
    }


    public function setAddTime()
    {
        $this->add_time = time();

        return $this;
    }


    public function setAddIp()
    {
        $this->add_ip = $_SERVER['REMOTE_ADDR'];

        return $this;
    }




    public function getId()
    {
        return $this->id;
    }


    public function getContent()
    {
        return $this->content;
    }


    public function getUsername()
    {
        return $this->username;
    }


    public function getAddTime()
    {
        return date("Y-m-d H:i:s",$this->add_time);
    }


    public function getAddIp()
    {
        return $this->add_ip;
    }



    public function initialize()
    {
        $this->belongsTo('username', 'App\Models\Admin', 'name', array('alias' => 'admin'));
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
            'username' => 'username',
            'content' => 'content',
            'add_time' => 'add_time',
            'add_ip' => 'add_ip',
        );
    }
}