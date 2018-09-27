<?php

session_start();
//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/User.php');
require_once('controller/LoginController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//$user = new \model\User('Admin', 'Password');

$layoutView = new \view\LayoutView();
$loginView = new \view\LoginView();
$dateTimeView = new \view\DateTimeView();

$loginController = new \controller\LoginController($layoutView, $loginView, $dateTimeView); 
$loginController->response(); 

/*
//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();


$lv->render(false, $v, $dtv);
*/