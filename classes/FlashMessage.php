<?php 

class FlashMessage {
	
	public static function sessionStart() {
		session_start();
	}

	public function setMessage($name, $message) {
		$_SESSION[$name] = $message;
	}

	public function getMessage($name) {
		if (isset($_SESSION[$name])) {
			echo '<div class="alert alert-'.$name.' text-dark" role="alert">'.$_SESSION[$name].'</div>';
			unset ($_SESSION[$name]);
		}		
	}


}

 ?>