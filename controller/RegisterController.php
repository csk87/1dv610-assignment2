<?php
namespace controller;
require_once('view/RegisterView.php');

class RegisterController{

  public function __construct(\view\RegisterView $registerView) {
    $this->registerView = $registerView;
  }

}