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
    
    if($this->loginView->tryToLogin()){
      if($this->loginView->getUsernameInput() == ''){
        $this->message = 'Username is missing';
      } else if($this->loginView->getPasswordInput() == ''){
        $this->message = 'Password is missing';
      } else if($this->loginView->getUsernameInput() !== $this->userModel->getUsername() || $this->loginView->getPasswordInput() !== $this->userModel->getPassword()){
        $this->message = 'Wrong name or password';
      }
      else {
        $this->message = 'Welcome';
        $this->isLoggedIn = true;
      }
    }
    $this->layoutView->render($this->isLoggedIn, $this->message, $this->loginView, $this->dateTimeView); 
  }


  public function validateFormInput(){
    if (!$this->loginView->getUsernameInput()){
      $this->message = 'Username not set';
    } 
  }

}