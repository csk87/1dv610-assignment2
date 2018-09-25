<?php
namespace controller;
require_once('view/LayoutView.php');
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');

class LoginController{

  private $layoutView;
  private $loginView;
  private $dateTimeView;
  private $userModel; 
  private $isLoggedIn = false;
  private $message = '';
  
  public function __construct(\view\LayoutView $layoutView, \view\LoginView $loginView, \view\DateTimeView $dateTimeView, \model\User $userModel) {
    $this->layoutView = $layoutView;
    $this->loginView = $loginView;
    $this->dateTimeView = $dateTimeView;
    $this->userModel = $userModel;
  }

  public function response(){
    
    // om man redan är inloggad (session redan satt)
    if($this->loginView->sessionExist()){
      $this->isLoggedIn = true;

      //om man klickar på logga ut 
      if($this->loginView->tryToLogout()){ // logout knappen är klickad
        $this->message = 'Bye bye!';
        $this->isLoggedIn = false; 
        $this->loginView->removeCurrentSession();
      }
     
    }

    // om vi försöker logga in och det inte finns någon session satt. 
    else if($this->loginView->tryToLogin()){

      //validerar input fälten
      if($this->loginView->getUsernameInput() == ''){
        $this->message = 'Username is missing';
      } else if($this->loginView->getPasswordInput() == ''){
        $this->message = 'Password is missing';
      } else if($this->loginView->getUsernameInput() !== $this->userModel->getUsername() || $this->loginView->getPasswordInput() !== $this->userModel->getPassword()){
        $this->message = 'Wrong name or password';
      }

      //om alla fälten var korret ifyllda
      else {
        $this->loginView->setSessionName();
        $this->message = 'Welcome';
        $this->isLoggedIn = true;
      } 
    }
    $this->layoutView->render($this->isLoggedIn, $this->message, $this->loginView, $this->dateTimeView);  
  }

}