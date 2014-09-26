<?php

class UserController extends BaseController{

  function registerAction($params) {
    $firstName = $params["firstName"];
    $lastName = $params["lastName"];
    $email = $params["email"];
    $password = $params["password"];
  	$user = new User();
    $user->setFirstName($firstName);
    $user->setLastName($lastName);
    $user->setEmail($email);
    $user->setPassword(md5($password));
    $user->save();
    $this->signInUser($user->getId());
    
    return $this->redirect("Site", "index");
  }

  function loginAction($params) {
    $email = $params["email"];
    $password = md5($params["password"]);
    $user = User::findById(array("email", $email));
    if(($user!= null) 
      && ($user->getPassword() == $password) {
      $this->signInUser($user->getId());
    }
    
    return $this->redirect("Site", "index");
  }

  function logoutAction($params) {
    $_SESSION['userId'] = null;
    
    return $this->redirect("Site", "index");
  }
}
