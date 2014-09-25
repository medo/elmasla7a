<?php

class PrinceController extends BaseController{

  function hiAction(){
    $user = new User();
    $user->setEmail("mohamed@farghal");
    $user->setName("sayed");
    $user->setPassword("redhat");
    $result = $user->save();
    return var_dump($user->getError());
    return $this->render("test.html.haml", array("test" => "ssss"));
  }
}
