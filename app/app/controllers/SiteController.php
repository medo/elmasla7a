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

  function loginAction(){
    if(!$this->isGuest()){
      $this->redirect("Site","index");
    }
    return $this->render("login.html.haml");
  }

  function postRegisterAction($params) {
    $firstName = $params["firstName"];
    $lastName = $params["lastName"];
    $email = $params["email"];
    $password = $params["password"];
    $profilePicturePath = $params["profilePicturePath"];
    $user = User::model()->findOne(array("email" => $email));
    if(!$user) {
    $user = new User();
    $user->firstName = $firstName;
    $user->lastName = $lastName;
    $user->email = $email;
    $user->password = md5($password);
    $user->profilePicturePath = $profilePicturePath;
    $user->save();
      $this->signInUser($user->id);
      return $this->redirect("Site", "index");
    }else{
      $message = true;
      return $this->render("register.html.haml", array("message" => $message));
    }
  }

   function postLoginAction($params) {
    $email = $params["email"];
    $password = md5($params["password"]);
    $user = User::model()->findOne(array("email" => $email, "password" => $password));
    if($user!= null){
      $this->signInUser($user->id);
     return $this->redirect("Site", "index");
    } else {
      $message = true;
      return $this->render("login.html.haml", array("message" => $message));
    }
  }
}
