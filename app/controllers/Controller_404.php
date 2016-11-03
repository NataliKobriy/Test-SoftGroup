<?php

class Controller_404 extends Controller {

    private static $instance;

    public static function Instance()
    {
        if (self::$instance == null)
            self::$instance = new Controller_404();

        return self::$instance;

    }

    public function action_index()
    {
        $this->view->generate('404_view.twig', array(
            "title" => "404 - Ошибка"
        ));
    }

}