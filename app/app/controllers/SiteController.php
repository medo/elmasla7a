<?php

class SiteController extends BaseController{

  function indexAction() {
    $items = Item::model()->findAll();
    return $this->render("index.html.haml", array("items" => $items));
  }

}
