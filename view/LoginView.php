<?php
namespace view;

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private static $sessionName = 'LoginView::SessionName';
	//private $message = ''; 

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($isLoggedIn, $message) {
		$username = $this->getUsernameInput();

		if(!$isLoggedIn){
			$response = $this->generateLoginFormHTML($message, $username);
		} else {
			$response = $this->generateLogoutButtonHTML($message);
		}
		return $response;

	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message, $username) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $username .'" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
	}


	public function getRegister(){
		if(isset($_GET["register"])){
			return true;
		}
	}

	public function getUsernameInput(){
		if(isset($_POST[self::$name])){
			return $_POST[self::$name];
		} else {
			return '';
		}	
	}

	public function getPasswordInput(){
		if(isset($_POST[self::$password])){
			return $_POST[self::$password];
		} else { 
			return '';
		}
	}

	public function tryToLogin(){
		return isset($_POST[self::$login]);
	}


	/* SESSIONS */
	public function getSessionName(){
		if(isset($_SESSION[self::$sessionName])){
			return $_SESSION[self::$sessionName];
		} 
	}

	public function setSessionName($userName) {
		$_SESSION[self::$sessionName] = $userName;
	}

	public function sessionExist(){
		if(isset($_SESSION[self::$sessionName])){
			return true;
		} else {
			return false;
		}
	}


	public function removeCurrentSession(){
		unset($_SESSION[self::$sessionName]);
	}


	public function tryToLogout(){
		return isset($_POST[self::$logout]);
	}

	public function keepLoggedIn(){

		if(isset($_POST[self::$keep])){
			return true;
		} else {
			return false;
		}

	}

	/* COOKIES */

	public function getCookieName() {
		if(isset($_COOKIE[self::$cookieName])){
			return $_COOKIE[self::$cookieName];
		}
	}

	public function getCookiePassword() {
		if(isset($_COOKIE[self::$cookiePassword])){
			return $_COOKIE[self::$cookiePassword];
		}
	}


	public function setCookies($username, $password, $cookieLifeTime){
		setcookie(self::$cookieName, $username, $cookieLifeTime);
		setcookie(self::$cookiePassword, md5($password), $cookieLifeTime);
	}

	public function removeCurrentCookies(){

		setcookie(self::$cookieName, '', time() - 3600);
    setcookie(self::$cookiePassword, '', time() - 3600);
		unset($_COOKIE[self::$cookieName]);
		unset($_COOKIE[self::$cookiePassword]);
	}

	public function cookiesExist(){
		if(isset($_COOKIE[self::$cookieName]) && isset($_COOKIE[self::$cookiePassword])){
			return true;
		} else {
			return false;
		}
	}


}
