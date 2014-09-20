<?php

class Routes{

  private static $routes = array(); 

  public static function getRoutes(){
    return self::$routes;
  }

  public function addRoute($path, $httpMethod, $controller, $action, $format = "html"){
    self::$routes[$path."__".$httpMethod."__".$format] = [ $controller, $action ];
  }
}

Routes::addRoute("/", "GET", "Site", "index");
Routes::addRoute("/cart", "GET", "Cart", "index");
Routes::addRoute("/cart/buy", "POST", "Cart", "buy");
Routes::addRoute("/cart/history", "GET", "Cart", "history");
Routes::addRoute("/user/register", "POST", "User", "register");
Routes::addRoute("/user/login", "POST", "User", "login");
Routes::addRoute("/user/logout", "POST", "User", "logout");
