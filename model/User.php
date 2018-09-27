<?php

namespace model;

class User{
  private $validUsername = 'Admin';
  private $validPassword = 'Password';
  
  public function __construct(string $username, string $password){
    $this->ErrorHandleMissingUsername($username); 
    $this->ErrorHandleMissingPassword($password); 
    $this->ErrorHandleMissingCredentials($username, $password);
  }
/*
  public function getUsername() {
    return $this->username; 
  }

  public function getPassword(){
    return $this->password; 
  }

*/
  private function ErrorHandleMissingUsername(string $username){
    if (empty($username)){
      throw new \Exception('Username is missing');
    }
  }

  private function ErrorHandleMissingPassword(string $password){
    if (empty($password)){
      throw new \Exception('Password is missing');
    }
  }

  private function ErrorHandleMissingCredentials(string $username, string $password){
    if($username !== $this->validUsername || $password !== $this->validPassword){
      throw new \Exception('Wrong name or password');
    }
  }

}
