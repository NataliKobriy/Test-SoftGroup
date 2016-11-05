<?php
namespace app\models;

use app\core\Model;
use app\core\Model_Base;

class Model_Users extends Model_Base
{
    private static $instance;
    public $table;
    public $msql;

    public static function Instance()
    {
        if (self::$instance == null)
            self::$instance = new Model_Users();

        return self::$instance;
    }

    public function __construct()
    {
        parent::__construct();
        $this->msql = Model_Base::Instance();

    }

    public function getAllData ($table) {
        $t = "SELECT * FROM  $table";
        $result = $this->msql->Select($t);
        return $result;

    }
    public function dataSort ($table, $data, $parameter) {
        $t = "SELECT * FROM $table ORDER BY $data $parameter";
        $query = sprintf($t, mysqli_real_escape_string($this->link, $data));
        $result = $this->msql->Select($query);
        return $result;

    }

    public function getUser ($parameter1, $table, $data, $parameter2, $condition) {
        $t = "SELECT $parameter1  FROM $table WHERE $parameter2 $condition '$data'";
        $query = sprintf($t, mysqli_real_escape_string($this->link, $data));
        $result = $this->msql->Select($query);
        return $result;
    }

    function getPage ($table, $parameter, $condition1, $surname, $condition2) {
        $t = "SELECT * FROM $table WHERE $parameter $condition1 $surname ORDER BY $parameter $condition2";
        $result = $this->msql->Select($t);
        foreach ($result as $key => $value) {
            return $value;
        }
    }


    function getId ($table, $parameter, $condition) {
        $t = "SELECT * FROM $table ORDER BY $parameter $condition";
        $result = $this->msql->Select($t);
        foreach ($result as $key => $value) {
            return $value;
        }
    }
    function isSetId ($table, $parameter, $data) {
        $t = "SELECT  $parameter FROM $table WHERE $parameter = $data";
        $query = sprintf($t, mysqli_real_escape_string($this->link, $data));
        $result = $this->msql->Select($query);
        foreach ($result as $key => $value) {
            return $value;
        }
    }
}
