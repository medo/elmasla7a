<?php

class App{

  function __construct($con, $config, $routes){
    $this->con = $con;
    $this->config = $config;
    $this->routes = $routes;
  }
  
  function resolveRoutes(){
    $pathInfo = $_SERVER["PATH_INFO"];
    if( $pathInfo == "" ) $pathInfo = "/";
    $pathInfo .= "__".$_SERVER["REQUEST_METHOD"];
    if( array_key_exists($pathInfo, $this->routes) ){
      return $this->routes[$pathInfo];
    }else{
      return NULL;
    }
  }


  function run(){
    $route = $this->resolveRoutes();
    if( $route == NULL ){
      return "ROUTE NOT FOUND";
    }
    $controller = $route[0]."Controller";
    $action = $route[1]."Action";
    if( class_exists($controller) ){
      $controllerInstance = new $controller($this->config, $_REQUEST);
    }else{
      return "CONTROLLER \"$controller\" NOT FOUND";
    }
    if( !method_exists( $controllerInstance, $action ) ){
      return "ACTION \"$action\" NOT FOUND";
    }
    return $controllerInstance->$action();
  }
}
