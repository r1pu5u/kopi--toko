<?php 
class Csrf_model {
	public function tokenCsrf()
	{
		if ( !isset($_SESSION['token']) ) {
			$_SESSION['token'] = substr(base64_encode(sha1(mt_rand())), 0, 50);
		}

		return $_SESSION['token'];
	}
}