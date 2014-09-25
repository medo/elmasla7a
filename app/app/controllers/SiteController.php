<?php

class SiteController extends BaseController{

  function indexAction() {
  	$items = item::findAll();
  	return $this->render("index.html.haml", array("items" => $items));
  }

}
