<?php
namespace App\models;

class Permission extends BaseModel {

    /**
     *
     * @var integer
     */
    protected $id;

    protected $did;

    protected $aid;
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
    public function setDid($did)
    {
        $this->did = $did;

        return $this;
    }

    /**
     * Method to set the value of field passwd
     *
     * @param string $passwd
     * @return $this
     */
    public function setAid($aid)
    {
        $this->aid = $aid;

        return $this;
    }


    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getDid()
    {
        return $this->did;
    }

    /**
     * Returns the value of field passwd
     *
     * @return string
     */
    public function getAid()
    {
        return $this->aid;
    }

    /**
     * Returns the value of field gid
     *
     * @return integer
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

    public function initialize()
    {
        $this->belongsTo('did', 'App\Models\Depart', 'id', array('alias' => 'department'));
        $this->belongsTo('aid', 'App\Models\App', 'id', array('alias' => 'app'));
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */

    public function afterCreate(){
        $log=new Syslog();
        $log->setContent("修改".$this->department->remark[0]."权限");
        $log->setUsername();
        $log->setAddIp();
        $log->setAddTime();
        $log->save();
    }


    public function afterUpdate(){
        $log=new Syslog();
        $log->setContent("修改".$this->department->remark[0]."权限");
        $log->setUsername();
        $log->setAddIp();
        $log->setAddTime();
        $log->save();
    }

    public function afterDelete(){
        $log=new Syslog();
        $log->setContent("删除".$this->department->remark[0]."权限");
        $log->setUsername();
        $log->setAddIp();
        $log->setAddTime();
        $log->save();
    }


    public function columnMap()
    {
        return array(
            'id' => 'id',
            'did' => 'did',
            'aid' => 'aid',
        );
    }
}