<?php

class SiteController extends BaseController{

  function indexAction() {
    $items = Item::model()->findAll();
    return $this->render("index.html.haml", array("items" => $items));
  }

  function registerAction(){
    if(!$this->isGuest()){
      $this->redirect("Site","index");
    }
    return $this->render("register.html.haml");
  }

}
