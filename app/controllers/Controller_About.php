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
            $id = $this->msql->isSetId('generals', 'id_generals', $_GET['id']);
            if ($id == null) {
                $error = Controller_404::Instance();
                $error = $error->action_index();
            } else {
                $sort = $this->msql->dataSort('generals', 'surname', 'ASC');
                $prev = $this->msql->getPage('generals', 'id_generals','<', $_GET['id'], 'DESC LIMIT 1');
                $this->result = $this->msql->getUser('*', 'dataGenerals', $prev['id_generals'], 'id_generals', '=');
                if (empty($prev['id_generals'])) {
                    $nextId = $this->msql->getId('generals', 'surname', 'DESC LIMIT 1');
                    $this->result = $this->msql->getUser('*', 'dataGenerals', $nextId['id_generals'], 'id_generals', '=');
                }
            }
        }
            $this->action_view();
    }

    function action_next () {
        if (isset($_GET['id'])) {
            $id = $this->msql->isSetId('generals', 'id_generals', $_GET['id']);
            if ($id == null) {
                $error = Controller_404::Instance();
                $error = $error->action_index();
            } else {
                $sort = $this->msql->dataSort('generals', 'surname', 'ASC');
                $next = $this->msql->getPage('generals', 'id_generals', '>', $_GET['id'], 'LIMIT 1');
                $this->result = $this->msql->getUser('*', 'dataGenerals', $next['id_generals'], 'id_generals', '=');

                if (empty($next['id_generals'])) {
                    $prevId = $this->msql->getId('generals', 'surname', 'ASC LIMIT 1');
                    $this->result = $this->msql->getUser('*', 'dataGenerals', $prevId['id_generals'], 'id_generals', '=');
                }
            }
            $this->action_view();
        }
    }

    function action_index () {
        if (isset($_GET['id'])) {
            $id = $this->msql->isSetId('generals', 'id_generals', $_GET['id']);
            if ($id == null) {
                $error = Controller_404::Instance();
                $error = $error->action_index();
            } else {
                $this->result = $this->msql->getUser('*', 'dataGenerals', $_GET['id'], 'id_generals', '=');
            }
        }
        $this->action_view();
    }

    function action_view () {
        $this->view->generate('about_view.twig', array('data' => $this->result));

    }
}