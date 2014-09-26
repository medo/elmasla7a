<?php

class Routes{

  private static $routes = array();
  private static $routes_inverse = array();

  public static function getRoutes(){
    return self::$routes;
  }

  public static function getPath($controller, $action, $absolute = true){
    if($absolute){
      return $_SERVER['REMOTE_HOST'].self::$routes_inverse[$controller."_".$action];
    }else{
      return self::$routes_inverse[$controller."_".$action];
    }
  }

  public function addRoute($path, $httpMethod, $controller, $action, $format = "html"){
    self::$routes[$path."__".$httpMethod."__".$format] = [ $controller, $action ];
    self::$routes_inverse[$controller."_".$action] = $path;
  }
}

Routes::addRoute("/", "GET", "Site", "index");
Routes::addRoute("/cart/buy", "GET", "Transaction", "buy");
Routes::addRoute("/cart/checkout", "POST", "Transaction", "checkout");
Routes::addRoute("/cart/history", "GET", "Transaction", "history");
Routes::addRoute("/user/register", "POST", "User", "register");
Routes::addRoute("/user/login", "POST", "User", "login");
Routes::addRoute("/user/logout", "POST", "User", "logout");
Routes::addRoute("/user/edit", "GET", "User", "edit");
Routes::addRoute("/user/save", "POST", "User", "save");
