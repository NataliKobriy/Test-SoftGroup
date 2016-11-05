<?php
namespace app\core;

class Route {
    protected static $routes = [];
    protected static $route = [];
    public static function add ($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }
    public static function getRoutes() {
        return self::$routes;
    }
    public static function getRoute() {
        return self::$route;
    }
    public static function matchRoute ($url) {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                self::$route = $route;
                return true;
            }
        }
        return false;
    }
    public static function dispatch($url) {
            if (self::matchRoute($url)) {
                $controller = '\app\controllers\Controller_' . self::$route['controller'];
                if (class_exists($controller)) {
                    $cObj = new $controller;
                    $action = 'action_' . self::$route['action'];
                    if (method_exists($cObj, $action)) {
                        $cObj->$action();
                    } else {
                        Route::ErrorPage404();
                    }
                } else {
                    Route::ErrorPage404();
                }
            } else {
                Route::ErrorPage404();
            }


    }
    static function ErrorPage404(){
        $error = \app\controllers\Controller_404::Instance();
        $error->action_index_404();
    }
}