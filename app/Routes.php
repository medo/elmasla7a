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

Routes::addRoute("/", "GET", "Prince", "hi");
