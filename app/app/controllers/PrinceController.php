<?php

class PrinceController extends BaseController{

  function hiAction(){
    return $this->render("test.html.haml", array("test" => "ssss"));
  }
}
