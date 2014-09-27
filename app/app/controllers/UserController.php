<?php

class UserController extends BaseController{

  function editAction($params) {
    $user = $this->signedInUser();
    $firstName = $user->firstName;
    $lastName = $user->lastName;
    $email = $user->email;
    $profilePicturePath = $user->profilePicturePath;

    return $this->render("edit.html.haml", 
      array("firstName"=>$firstName,"lastName"=>$lastName,
        "email"=>$email, "profilePicturePath" => $profilePicturePath));
  }

  function saveAction($params) {
    $user = $this->signedInUser();
    $user->firstName = ($params["firstName"] == "")? $user->firstName : $params["firstName"];
    $user->lastName = ($params["lastName"] == "")? $user->lastName : $params["lastName"];
    $user->email = ($params["email"] == "")? $user->email : $params["email"];
    $user->profilePicturePath = $params["profilePicturePath"];
    $user->password = ($params["password"] == "")? $user->password : md5($params["password"]);
    $user->save();
    
    $this->addFlash("Your Info has been saved successfully!");
    return $this->redirect("User", "edit");

  }

  function logoutAction($params) {
    $_SESSION['userId'] = null;
    return $this->redirect("Site", "index");
  }

}
