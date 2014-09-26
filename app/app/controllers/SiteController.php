<?php

class SiteController extends BaseController{

  function indexAction() {
    $items = Item::findAll();
    return $this->render("index.html.haml", array("items" => $items));
  }

}
