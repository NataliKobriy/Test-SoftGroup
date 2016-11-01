<?php

class Model_Main extends Model
{
    private static $instance;
    public $table;
    public $msql;

    public static function Instance()
    {
        if (self::$instance == null)
            self::$instance = new Model_Main();

        return self::$instance;
    }

    public function __construct()
    {
        parent::__construct();
        $this->msql = Model::Instance();

    }

    public function getAllData ($table) {
        $t = "SELECT * FROM  $table";
        $result = $this->msql->Select($t);
        return $result;

    }
    public function dataFilter ($table, $data, $parameter) {
        $t = "SELECT * FROM $table ORDER BY $data $parameter";
        $query = sprintf($t, mysqli_real_escape_string($this->link, $data));
        $result = $this->msql->Select($query);
        return $result;

    }


    public function getUser ($parameter1, $table, $data, $parameter2) {
        $t = "SELECT $parameter1  FROM $table WHERE $parameter2 = '$data'";
        $query = sprintf($t, mysqli_real_escape_string($this->link, $data));
        $result = $this->msql->Select($query);
        return $result;
    }

    public function gerSortData ($table, $id) {
        $t = "SELECT * FROM $table WHERE id_generals = $id";
        $query = sprintf($t, mysqli_real_escape_string($this->link, $id));
        $result = $this->msql->Select($query);
        return $result;
}
 }
