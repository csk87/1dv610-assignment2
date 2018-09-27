<?php
namespace view;

class RegisterView {
  private static $message = 'RegisterView::Message';
	private static $username = 'RegisterView::UserName';
  private static $password = 'RegisterView::Password';
  private static $passwordRepeat = 'RegisterView::PasswordRepeat';
  private static $registrationButton = 'RegisterView::Register';
  private $errorMessage ='';
  private $userNameInput = '';
  
  public function renderHTML(){
    $this->validateform();
    return '
      <h2>Register new user</h2>
      <form action ="?register" method="post" encypte=multipart/form-data">
        <fieldset>
          <legend>Register a new user - Write username and password</legend>
          <p id="' . self::$message . '"> '. $this->errorMessage . ' </p>
          <label for="' . self::$username . '">Username :</label>
          <input type="text" size="20" name="' . self::$username . '" id="' . self::$username . '" value="'. $this->userNameInput . '">
          <br>
          <label for="' . self::$password . '">Password  :</label>
          <input type="password" size="20" name="' . self::$password . '" id="' . self::$password . '" value="">
          <br>
          <label for="' . self::$passwordRepeat . '">Repeat password  :</label>
          <input type="password" size="20" name="' . self::$passwordRepeat . '" id="' . self::$passwordRepeat . '" value=""> 
          <br>
          <input id="submit" type="submit" name="'. self::$registrationButton .'" value="Register">
          <br>
        </fieldset>
      </form>
    ';
  }


  public function getUsernameInput(){
    if(isset($_POST[self::$username])){
			return $_POST[self::$username];
		} 
  }

  public function getPasswordInput(){
    if(isset($_POST[self::$password])){
			return $_POST[self::$password];
		} 
  }

  public function getPasswordRepeatInput(){
    if(isset($_POST[self::$passwordRepeat])){
			return $_POST[self::$passwordRepeat];
		} 
  }

  
  public function doRegistration(){
    return isset($_POST[self::$registrationButton]);
  }


  /**************TESTVALIDERING, TA BORT VID RELEASE************/

  public function validateForm(){
    if(!$this->doRegistration()){
      return;
    }
    if(!$this->getUsernameInput() && !$this->passwordIsValid()){

      $this->errorMessage = "Username has too few characters, at least 3 characters.<br> Password has too few characters, at least 6 characters.";

    } else if(!$this->usernameIsValid()){

      $this->errorMessage = "Username has too few characters, at least 3 characters.";

    } else if (!$this->passwordIsValid()){

      $this->errorMessage = "Password has too few characters, at least 6 characters.";

    } else if(!$this->passwordsMatch()){

      $this->errorMessage = "Passwords do not match.";

    } else if($this->ifInputCOntainsHTML()){

      $this->errorMessage = "Username contains invalid characters.";
    }

    $this->userNameInput = strip_tags($this->getUsernameInput());
   
  }

  private function usernameIsValid() : bool{
    return strlen($this->getUsernameInput()) > 2;
  }

  private function passwordIsValid() : bool{
    return strlen($this->getPasswordInput()) > 5;
  }

  private function passwordsMatch() : bool{
    return $this->getPasswordInput() == $this->getPasswordRepeatInput();
  }

  private function ifInputCOntainsHTML() : bool{
    return $this->getUsernameInput() != strip_tags($this->getUsernameInput());
  }

}