<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Model_Users;
class Controller_Users extends Controller   {
    private $result;
    private $msql;
    public function __construct()
    {
        parent::__construct();
        $this->msql = Model_Users::Instance();
    }
    function action_index()
    {
//
        $this->result = $this->msql->getAllData('generals');
        $this->view->generate('users_view.twig', array('data' => $this->result));
    }

    function action_get () {
        if (isset($_POST['filter'])) {
            echo json_encode($this->msql->dataSort('generals', $_POST['filter'], 'ASC'));
        }
    }
}