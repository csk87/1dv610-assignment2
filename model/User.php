<?php
namespace model;

class User{

  private $username;
  private $password;
  
  public function setUsername(string $newUsername){
  
    $this->username = $newUsername;
  
  }

  public function getUsername () {
    return $this->username; 
  }

}