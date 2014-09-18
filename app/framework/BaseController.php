<?php

class BaseController{

  function __construct($config, $params, $controller, $action, $format){
    $this->config = $config;
    $this->params = $params;
    $this->controller = str_replace("Controller", "", $controller);
    $this->action = str_replace("Action", "", $action);
    $this->format = $format;

    $this->layout = "base_layout.html.haml";
  }

  function render($templateName, $variables = [], $inLayout = true){

    $variables["DOCUMENT_ROOT"] = $_SERVER['DOCUMENT_ROOT'];
    $variables["controller"] = $this;

    if( $templateName[0] == "/" ){
      $templatePath = $_SERVER['DOCUMENT_ROOT']."/app/views".$templateName;
    }else{
      $templatePath = $_SERVER['DOCUMENT_ROOT']."/app/views/".$this->controller."/".$templateName;
    }

    if( $this->format == "html" ){

      $haml = new MtHaml\Environment('php', array('enable_escaper' => false));
      $hamlExecutor = new MtHaml\Support\Php\Executor($haml, array(
        'cache' => $_SERVER['DOCUMENT_ROOT']."/tmp/haml",
      ));

      try {
        $content = $hamlExecutor->render($templatePath, $variables);
      } catch (MtHaml\Exception $e) {
        return "Failed to execute template: ".$templateName." ".$e->getMessage()."\n";
      }

      if( !$inLayout ) return $content;

      $layoutPath = $_SERVER['DOCUMENT_ROOT']."/app/views/layouts/".$this->layout;
      $variables["layoutContent"] = $content;

      try {
        $response = $hamlExecutor->render($layoutPath, $variables);
      } catch (MtHaml\Exception $e) {
        return "Failed to execute layout ".$this->layout.": ".$e->getMessage()."\n";
      }

      return $response;
    }else if( $format == "json" ){
      return "JSON FORMAT NOT IMPLEMENTED YET";
    }else{
      return "UNKNOWN FORMAT ".$this->format;
    }
  }
}
