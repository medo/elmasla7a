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

  function editAction($params) {
    $user = $this->signedInUser();
    $firstName = $user->getFirstName();
    $lastName = $user->getLastName();
    $email = $user->getEmail();

    return $this->render("edit.html.haml", 
      array("firstName"=>$firstName,"lastName"=>$lastName,"email"=>$email));
  }

  function saveAction($params) {
    $user = $this->signedInUser();
    $user->setFirstName(($params["firstName"])? $user->getFirstName() : $params["firstName"]);
    $user->setLastName(($params["lastName"])? $user->getLastName() : $params["lastName"]);
    $user->setEmail(($params["email"])? $user->getEmail() : $params["email"]);
    $user->setPassword(($params["password"])? $user->getpassword() : md5($params["password"]));
    $user->save();

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
