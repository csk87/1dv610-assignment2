<?php
namespace controller;
require_once('view/LayoutView.php');
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('model/User.php');

class LoginController{

  private $layoutView;
  private $loginView;
  private $dateTimeView;
  private $isLoggedIn = false;
  private $message = '';
  
  public function __construct(\view\LayoutView $layoutView, \view\LoginView $loginView, \view\DateTimeView $dateTimeView) {
    $this->layoutView = $layoutView;
    $this->loginView = $loginView;
    $this->dateTimeView = $dateTimeView;
  }

  public function response(){

    if($this->loginView->sessionExist()){ // om det finns session

      $this->isLoggedIn = true; //login-vyn
      $this->handleLogutRequest(); //logout knappen med unset-Session och Cookie

    } else if ($this->loginView->cookiesExist()){ // om det bara finns cookies, ingen session
      
      $this->setSessionCookie();
      $this->isLoggedIn = true; //login-vyn
      $this->message = 'Welcome back with cookie'; //meddelande
      $this->handleLogutRequest(); //logout knappen med unset-Session och Cookie
  
    }

    else if($this->loginView->tryToLogin()){ //annars behöver vi logga in med formuläret
      
      try {
        new \model\User($this->loginView->getUsernameInput(), $this->loginView->getPasswordInput()); 

        $this->message = 'Welcome'; 
        $this->isLoggedIn = true; 
        $this->handleKeepUserLoggedIn();
        $this->handleLogutRequest();
      } catch (\Exception $exception) { 
        $this->message = $exception->getMessage(); 
      } 
    } 
  
    $this->layoutView->render($this->isLoggedIn, $this->message, $this->loginView, $this->dateTimeView);  //vyn
  }


  private function handleLogutRequest(){
    if(!$this->loginView->tryToLogout()){ 
      return;
    }
    $this->message = 'Bye bye!';
    $this->isLoggedIn = false; 
    $this->loginView->removeCurrentCookies();
    $this->loginView->removeCurrentSession();
  }

  private function setSessionCookie() {
    $this->loginView->setSessionName($this->loginView->getUsernameInput());
  }


  private function handleKeepUserLoggedIn(){

    $this->setSessionCookie();

    if(!$this->loginView->keepLoggedIn()){ // om vi inte vill spara cookies
     return;
    } 
    $this->loginView->setCookies($this->loginView->getUsernameInput(), $this->loginView->getPasswordInput(), time() + 3600);
    $this->message .= ' and you will be remembered';
  }


  
}