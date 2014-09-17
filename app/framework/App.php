<?php

class App{

  function __construct($con, $config, $routes){
    $this->con = $con;
    $this->config = $config;
    $this->routes = $routes;
  }
  
  function resolveRoutes($pathInfo, $method, $format){
    if( $pathInfo == "" ) $pathInfo = "/";
    $pathInfo .= "__".$method."__".$format;
    if( array_key_exists($pathInfo, $this->routes) ){
      return $this->routes[$pathInfo];
    }else{
      return [NULL, $pathInfo];
    }
  }


  function run(){
    $pathInfo = $_SERVER["PATH_INFO"];
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $format = isset($_REQUEST["format"]) ? $_REQUEST["format"] : "html";
    $route = $this->resolveRoutes($pathInfo, $requestMethod, $format);

    if( $route[0] == NULL ){
      return "ROUTE ".$route[1]." NOT FOUND";
    }
    $controller = $route[0]."Controller";
    $action = $route[1]."Action";
    if( class_exists($controller) ){
      $controllerInstance = new $controller($this->config, $_REQUEST, $controller,$action, $format);
    }else{
      return "CONTROLLER \"$controller\" NOT FOUND";
    }
    if( !method_exists( $controllerInstance, $action ) ){
      return "ACTION \"$action\" NOT FOUND";
    }
    return $controllerInstance->$action();
  }
}
