<?php

class Controller {

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();

    }

    protected function IsGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    function action_index(){

    }

}