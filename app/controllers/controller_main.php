<?php
class Controller_Main extends Controller {

    private $result;
    private $msql;

    public function __construct()
    {
        parent::__construct();
        $this->msql = Model_Main::Instance();

    }

    function action_index()
    {
//
        $this->result = $this->msql->getAllData('generals');

        if (isset($_GET['filter'])) {
            $this->result = $this->msql->dataSort('generals', $_GET['filter'], 'ASC');
        }

        $this->view->generate('main_view.twig', array('data' => $this->result));
    }

}