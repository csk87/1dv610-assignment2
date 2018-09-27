<?php
namespace view;
require_once('view/DateTimeView.php');

class LayoutView {

  public function render($isLoggedIn, $message, $htmlView, DateTimeView $dtv) {
    //session_start();
    echo ' <!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
        
              ' . $htmlView . '
              
              ' . $dtv->show() . '
          </div>
        </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '
      '. $this->setNavigation() . '
      <h2>Not logged in</h2>
      ';
    }
  }

  private function setNavigation(){
    if(isset($_GET['register'])){
      return  '<a href="?">Back to login</a>';
    } else {
     return '<a href="?register">Register a new user</a>';
    }
  }

}
