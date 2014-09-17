<?php

class Routes{

  private static $routes = array(); 

  public static function getRoutes(){
    return self::$routes;
  }

  public function addRoute($path, $httpMethod, $controller, $action){
    self::$routes[$path."__".$httpMethod] = [ $controller, $action ]; 
  }
}

Routes::addRoute("/", "GET", "Prince", "hi");
