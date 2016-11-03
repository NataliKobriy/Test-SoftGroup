<?php

use \app\core\Route as router;
use \app\core\Controller as controller_base;
use \app\core\View as view;
include 'D:\Programing\Web\Program Files\OpenServer\domains\project\app\lib\Twig\Autoloader.php';
Twig_Autoloader::register();

function __autoload ($class) {
       $class = str_replace("\\","/",$class);
       include $class .'.php';
}

var_dump(new view());
$query = rtrim($_SERVER['QUERY_STRING'], '/');

router::add('^$', ['controller' => 'Main', 'action' => 'index']);
router::add('(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)?');
router::dispatch($query);

