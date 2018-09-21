<?php
namespace controller;
require_once('view/LayoutView.php');
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');

class LoginController{

  private $layoutView;
  private $loginView;
  private $dateTimeView;
  
  public function __construct() {
    $this->layoutView = new \view\LayoutView();
    $this->loginView = new \view\LoginView();
    $this->dateTimeView = new \view\DateTimeView();
  }

  public function response(){
    
    if ($this->loginView->checkUserAuthentication()){
      $isLoggedIn = true;
    } else {
      $isLoggedIn = false;
    }
    $this->layoutView->render($isLoggedIn, $this->loginView, $this->dateTimeView);
    
  }
  

}