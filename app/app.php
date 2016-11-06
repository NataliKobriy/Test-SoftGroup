<?php

use \app\core\Route as Route;
include 'lib\Twig\Autoloader.php';
\Twig_Autoloader::register();
spl_autoload_register(function ($class){
    $class = str_replace("\\","/",$class);
    include $class .'.php';
});
$query = rtrim($_SERVER['QUERY_STRING'], '/');
Route::add('^$', ['controller' => 'Users', 'action' => 'index']);
Route::add('(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)?');
Route::dispatch($query);
