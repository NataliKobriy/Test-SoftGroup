<?php

class Controller_About extends Controller {

    private $result;
    private $msql;

    public function __construct()
    {
        parent::__construct();
        $this->msql =  Model_Main::Instance();

    }

    function action_prev () {
        if (isset($_GET['id'])) {

        $this->action_view();
        }
    }

    function action_index () {
        if (isset($_GET['id'])) {
            $this->result = $this->msql->getUser('*', 'dataGenerals', $_GET['id'], 'id_generals');
        }
        $this->action_view();
    }

    function action_view () {
        $this->view->generate('about_view.twig', array('data' => $this->result));

    }
}