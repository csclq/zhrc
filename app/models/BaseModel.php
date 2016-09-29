<?php
namespace App\Models;

use Phalcon\Mvc\Model;

class BaseModel extends Model {
    public function getSource()
    {
        $classname=trim(str_replace(__NAMESPACE__,'',get_class($this)),"\\");
       return $GLOBALS['config']['database']['preTable'].strtolower($classname);
    }
}