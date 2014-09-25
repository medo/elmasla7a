<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mohamedfarghal
 * Date: 9/20/14
 * Time: 10:47 AM
 * To change this template use File | Settings | File Templates.
 */

class User extends BaseModel {

    function __construct() {
        parent::__construct("users");
    }

    public function setEmail($email)
    {
        $this->set("email", $email);
    }

    public function setName($name)
    {
        $this->set("name", $name);
    }

    public function setPassword($password)
    {
        $this->set("password", $password);
    }

    public function getPassword()
    {
        return $this->get("password");
    }

    public function getName()
    {
        return $this->get("name");
    }

    public function getId()
    {
        return $this->get("id");
    }


    public function getEmail()
    {
        return $this->get("email");
    }

}