<?php
define('WWW' , __DIR__);
define('CORE' , dirname(__DIR__) . 'app/core');
define('ROOT' , dirname(__DIR__));
define('APP' , dirname(__DIR__) . '/app');
spl_autoload_register(function ($class){
    $route = APP . "/core/$class.php";
    $controller = APP . "/controllers/$class.php";
    if (is_file($controller)) {
        include_once $controller;
    }
    $model = APP . "/models/$class.php";
    if (is_file($model)) {
        include_once $model;
    }
    $view = APP . "/views/$class.php";
    if (is_file($view)) {
        include_once $view;
    }
    $core_controller = APP . "/core/$class.php";
    if (is_file($core_controller)) {
        include_once $core_controller;
    }
    $core_model = APP . "/core/$class.php";
    if (is_file($core_model)) {
        include_once $core_model;
    }
    $core_view = APP . "/core/$class.php";
    if (is_file($core_view)) {
        include_once $core_view;
    }
});

$query = rtrim($_SERVER['QUERY_STRING'], '/');

Route::add('^$', ['controller' => 'Main', 'action' => 'index']);
Route::add('(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)?');
Route::dispatch($query);
