<?php

class Model
{
    private static $instance;
    public $link;

    public static function Instance()
    {
        if (self::$instance == null)
            self::$instance = new Model();

        return self::$instance;

    }

    public function __construct () {
        $this->link = mysqli_connect("localhost", "root", "", "generals_UPR");
        if (!$this->link) {
            printf("Не вдалося підключитися %s\n", mysqli_connect_error());
            exit();
        }
//        mysqli_set_charset($this->link, "cp1251_ukrainian_ci");

    }

    public function Select($query)
    {
        $result = mysqli_query($this->link, $query);

        if (!$result)
            die(mysqli_error($this->link));

        $n = mysqli_num_rows($result);
        $arr = array();

        for($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $arr[] = $row;
        }

        return $arr;
    }


}
