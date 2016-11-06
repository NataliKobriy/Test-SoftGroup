<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Model_Users;

class Controller_About extends Controller  {

    private $result;
    private $msql;
    private $prev;
    private $next;
    public function __construct()
    {
        parent::__construct();
        $this->msql =  Model_Users::Instance();

    }

    function action_index () {
        if (isset($_GET['id'])) {
            $id = $this->msql->isSetId('generals', 'id_generals', $_GET['id']);
            if ($id == null) {
                $error = Controller_404::Instance();
                $error = $error->action_index_404();
                return false;
            } else {
                $this->prev = $this->msql->getPage('<', $_GET['id'], 'DESC LIMIT 1');
                $this->next = $this->msql->getPage('>', $_GET['id'], 'LIMIT 1');
                if (empty($this->prev['id_generals'])) {
                    $this->prev = $this->msql->getId('generals', 'surname', 'DESC LIMIT 1');
                }
                if (empty($this->next['id_generals'])) {
                    $this->next = $this->msql->getId('generals', 'surname', 'ASC LIMIT 1');
                }
                $this->result = $this->msql->getUser('*', 'dataGenerals', $_GET['id'], 'id_generals', '=');
            }
        }
        $this->action_view();
    }

    function action_view () {
        $this->view->generate('about_view.twig', array('data' => $this->result, 'prev' => $this->prev, 'next' => $this->next));

    }
}