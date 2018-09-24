<?php

namespace model;

class User{

  private $username;
  private $password;
  private $loginStatus = false;

  public function __construct($username, $password){
    $this->username = $username; 
    $this->password = $password; 
  }
  
  public function getUsername() {
    return $this->username; 
  }

  public function getPassword(){
    return $this->password; 
  }
}
