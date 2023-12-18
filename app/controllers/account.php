<?php 

class Account Extends Controller {
	public function index() {
		if (isset($_COOKIE['level'], $_COOKIE['username'], $_COOKIE['level'])) {
			echo "ok";
			if ( $this->model('user_model')->cekCookieUser($_COOKIE['username']) > 0 ) {
				header('Location: /public/dashboard' . $_COOKIE['username']);
			}
		}
		$this->view('account/login');
	}

	public function register() {
		$data['utility'] = $this->model('Utility_model')->get_utility();
		if (isset($_COOKIE['level']) && isset($_COOKIE['username']) && isset($_COOKIE['auth']) ) {
			$cek = $this->model('user_model')->cekCookieUser($_COOKIE['username']);
			if ( $cek > 0 ) {
				header('Location: /public/dashboard' . $_COOKIE['username']);
			}
		}
		$this->view('account/register', $data);
	}

	public function login() {
		if (isset($_COOKIE['level'], $_COOKIE['username'], $_COOKIE['level'])) {
			$cek = $this->model('user_model')->cekCookieUser($_COOKIE['username']);
			if ( $cek > 0 ) {
				header('Location: /public/dashboard' . $_COOKIE['username']);
			}
		}
		$this->view('account/login');
	}

	public function cek_login() {
		if ( $this->model('user_model')->gologin($_POST) > 0 ) {
			setcookie('username', $_POST["username"], time()+3200);
			$_SESSION["username"] = $_POST["username"];
			$_SESSION['auth'] = $_COOKIE['auth'];
			$_SESSION['level'] = $_COOKIE['level'];
			header('Location: /public/dashboard/' . $_POST["username"]);
			exit;
		}
	}

	public function tambah_user() {
		if ($this->model('user_model')->RegisterNewUser($_POST) > 0) {
			setcookie('username', $_POST["username"], time()+3200);
			setcookie('level', $_POST["level"], time()+3200);
			$_SESSION["login"] = $_POST["username"];
			header('Location: /public/dashboard/' . $_POST["username"]);
			exit;
		}else {
			Flasher::setFlash('gagal', 'ditambahkan', 'danger');
			header('Location: account/register');
			exit;
		}
	}

}