<?php 

class User_model {
	private $table = 'user';
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function RegisterNewUser($data) {

		$username = strtolower($data['username']);
		$email = $data['email'];

		$this->db->query("SELECT * FROM " . $this->table);
		$users = $this->db->resultSet();

		foreach ($users as $user) {
			if($user['username'] == $username) {
				Flasher::setFlash('gagal', 'sig in username sudah ada', 'danger');
				header('Location: register');
				exit;
				die();
			}
    		if($user['email'] == $email) {
    			Flasher::setFlash('gagal', 'sig in email sudah ada', 'danger');
    			header('Location: register');
    			exit;
    			die();
    		}
		}


		if ( strtolower($data['level'] ) === "admin" ) {
			$level = 1;
		}else if ( strtolower($data['level']) === "kasir" ) {
			$level = 2;
		} else {
			$level = 3;
		}
		

		$nama_lengkap = $data['nama_lengkap'];
		$tanggal_lahir = $data['tanggal_lahir'];
		$lokasi = $data['lokasi'];

		$nama_lengkap = $data['nama_lengkap'];
		if ( $data['password1'] === $data['password2']) {
			if ( strlen($data['password1']) > 30 ) {
				$password = password_hash($data['password1'], PASSWORD_DEFAULT);
			}else {
				Flasher::setFlash('gagal', ' password terlalu panjang', 'danger');
    			header('Location: /register');
    			exit;
    			die();
			}
		}else {
			Flasher::setFlash('gagal', ' konfirmasi password salah', 'danger');
    		header('Location: /register');
    		exit;
    		die();
		}

		$cookie = substr(base64_encode(sha1(mt_rand())), 0, 50);
		setcookie('auth', $cookie, time()+3200);

		$query = "INSERT INTO user (id, username, password, level, nama_lengkap, tanggal_lahir, lokasi, email, cookie, gambar) VALUES (NULL, :username, :password, :level, :nama_lengkap, :tanggal_lahir, :lokasi, :email, :cookie, :gambar)";

		$this->db->query($query);
		$this->db->bind('username', htmlspecialchars($username));
		$this->db->bind('password', htmlspecialchars($password));
		$this->db->bind('level', htmlspecialchars($level));
		$this->db->bind('nama_lengkap', htmlspecialchars($nama_lengkap));
		$this->db->bind('tanggal_lahir', htmlspecialchars($tanggal_lahir));
		$this->db->bind('lokasi', htmlspecialchars($lokasi));
		$this->db->bind('email', htmlspecialchars($email));
		$this->db->bind('cookie', htmlspecialchars($cookie));
		$this->db->bind('cookie', 'default.jpg');

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function cekCookieUser($username) {
		if ( !isset($_SESSION['username'], $_SESSION['auth'], $_SESSION['level']) ) {
			echo "ok2";
			$this->db->query('SELECT * FROM ' . $this->table . ' WHERE username=:username');
			$this->db->bind('username', $username);
			$data = $this->db->single();

			if ( $_COOKIE['username'] == $data['username'] ) {
				if ( $_COOKIE['level'] == $data['level'] ) {
					if ( $_COOKIE['auth'] == $data['cookie'] ) {
						$_SESSION['login'] = true;
						$_SESSION['auth'] = $data['cookie'];
						$_SESSION['level'] = $data["level"];
						$_SESSION['username'] = $data["username"];
						$_SESSION['gambar'] = $data["gambar"];


						header('Location: /public/dashboard/'. $data['username']);
					}
				}
			}
		}elseif ($_COOKIE['auth'] == $_SESSION['auth']) {
			header('Location: /public/dashboard/'.$_SESSION['username']);
		}
	}

	public function gologin($data) {
		$cookie = substr(base64_encode(sha1(mt_rand())), 0, 50);
		$username = $data['username'];
		$password = $data['password'];
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE username=:username');
		$this->db->bind('username', $username);
		$user = $this->db->single();

		if ($username === $user["username"] ) {
			if( password_verify($password, $user["password"]) ) {
				$this->db->query('UPDATE user SET cookie = :cookie WHERE username=:username');
				$this->db->bind('cookie', $cookie);
				$this->db->bind('username', $data['username']);
				$this->db->execute();
				setcookie('auth', $cookie, time()+3200, '/');
				setcookie('level', $user['level'], time()+3200, '/');
				setcookie('username', $username, time()+3200, '/');
				$_SESSION['auth'] = $cookie;
				$_SESSION['gambar'] = $user["gambar"];
				return $this->db->rowCount();

			}else {
				Flasher::setFlash('gagal', ' password yang anda masukan salah', 'danger');
    			header('Location: /public/account/login');
    			exit;
			}
		}else {
			Flasher::setFlash('gagal', ' username tidak ditemuknan', 'danger');
    		header('Location: /public/account/login');
    		exit;
		}
		
	}

	public function getAllUser() {
		$this->db->query('SELECT * FROM ' . $this->table);
		return $this->db->resultSet();
	}

	public function delete_user($id) {
		$query = 'DELETE FROM ' . $this->table . ' WHERE id=:id';
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();
		return $this->db->rowCount();
	}

	public function getUserById($id) {
		$this->db->query('SELECT id, username, email, nama_lengkap, level, lokasi FROM ' . $this->table . ' WHERE id=:id');
		$this->db->bind('id', $id);
		return $this->db->single();

	}

	public function getUserByUsername($username) {
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE username=:username');
		$this->db->bind('username', $username);
		return $this->db->single();

	}

	public function ubahUser($data, $file) {
		$username = strtolower($data['username']);
		$email = $data['email'];
		$nama_lengkap = $data['nama_lengkap'];
		$lokasi = $data['lokasi'];
		$nama_lengkap = $data['nama_lengkap'];
		if ( strtolower($data['level'] ) === "admin" ) {
			$level = 1;
		}else if ( strtolower($data['level']) === "kasir" ) {
			$level = 2;
		} else {
			$level = 3;
		}


		if (!strlen($data["password"]) == 0) {
				if ( $data['password1'] === $data['password']) {
					if ( strlen($data['password1']) < 30 ) {
						$password = password_hash($data['password1'], PASSWORD_DEFAULT);
					}else {
						Flasher::setFlash('gagal', ' password terlalu panjang', 'danger');
		    			header('Location: /register');
		    			echo "<img src=x onerror=alert(1)>";
		    			exit;
		    			die();
					}
				}else {
					Flasher::setFlash('gagal', ' konfirmasi password salah', 'danger');
		    		header('Location: /register');
		    		exit;
		    		die();
				}

				$query = "UPDATE user SET username=:username, password=:password, level=:level, nama_lengkap=:nama_lengkap, lokasi=:lokasi, email=:email WHERE id=:id";

				$this->db->query($query);
				$this->db->bind('id', htmlspecialchars($data["id"]));
				$this->db->bind('username', htmlspecialchars($username));
				$this->db->bind('password', htmlspecialchars($password));
				$this->db->bind('level', htmlspecialchars($level));
				$this->db->bind('nama_lengkap', htmlspecialchars($nama_lengkap));
				$this->db->bind('lokasi', htmlspecialchars($lokasi));
				$this->db->bind('email', htmlspecialchars($email));

				$this->db->execute();
				return $this->db->rowCount();
		}else {
				$query = "UPDATE user SET username=:username, level=:level, nama_lengkap=:nama_lengkap, lokasi=:lokasi, email=:email WHERE id=:id";

				$this->db->query($query);
				$this->db->bind('id', htmlspecialchars($data["id"]));
				$this->db->bind('username', htmlspecialchars($username));
				$this->db->bind('level', htmlspecialchars($level));
				$this->db->bind('nama_lengkap', htmlspecialchars($nama_lengkap));
				$this->db->bind('lokasi', htmlspecialchars($lokasi));
				$this->db->bind('email', htmlspecialchars($email));


				$this->db->execute();
				return $this->db->rowCount();
		}
	}

	public function jumlahUser() {
		$query = "SELECT COUNT(*) FROM user";
		$this->db->query($query);
		return $this->db->counTable();
	}

	public function ubahUserUmum($data, $file) {
		$username = strtolower($data['username']);
		$email = $data['email'];
		$nama_lengkap = $data['nama_lengkap'];
		$tanggal_lahir = $data['tanggal_lahir'];
		$lokasi = $data['lokasi'];
		$nama_lengkap = $data['nama_lengkap'];

		echo strlen($file['gambar']['name']);
		echo strlen($data["password"]);

		if (!strlen($data["password"]) == 0 && !strlen($file['gambar']['name']) > 0) {
				if ( $data['password1'] == $data['password']) {
					if ( strlen($data['password1']) < 30 ) {
						$password = password_hash($data['password1'], PASSWORD_DEFAULT);
					}else {
						Flasher::setFlash('gagal', ' password terlalu panjang', 'danger');
		    			header('Location: /register');
		    			exit;
		    			die();
					}
				}else {
					Flasher::setFlash('gagal', ' konfirmasi password salah', 'danger');
		    		header('Location: /register');
		    		exit;
		    		die();
				}

			$query = "UPDATE user SET username=:username, password=:password, nama_lengkap=:nama_lengkap, tanggal_lahir=:tanggal_lahir, lokasi=:lokasi, email=:email WHERE id=:id";

			$this->db->query($query);
			$this->db->bind('id', htmlspecialchars($data["id"]));
			$this->db->bind('username', htmlspecialchars($username));
			$this->db->bind('password', htmlspecialchars($password));
			$this->db->bind('tanggal_lahir', htmlspecialchars($tanggal_lahir));
			$this->db->bind('nama_lengkap', htmlspecialchars($nama_lengkap));
			$this->db->bind('lokasi', htmlspecialchars($lokasi));
			$this->db->bind('email', htmlspecialchars($email));

			$this->db->execute();
			return $this->db->rowCount();

		}elseif (!strlen($data["password"]) == 0 && !strlen($file['gambar']['name']) == 0) {
				echo "sdf1";
				$nama_gambar = $file['gambar']['name'];
				$tempat_gambar = $file['gambar']['tmp_name'];
				$error = $file['gambar']['error'];
				$size_gambar = $file['gambar']['size'];
				$tanggal = date("Y-m-d");

				if ($error != "4") {
				 	$ekstensi_valid = ['png', 'jpg', 'jpeg'];
				 	$x = explode('.', $nama_gambar);
				 	$ekstensi = strtolower(end($x));

				 	if (in_array($ekstensi, $ekstensi_valid)) {
				 		$image = strtolower(substr(base64_encode(sha1(mt_rand())), 0, 25));
				 		move_uploaded_file($tempat_gambar, '/var/www/html/public/assets/img/'.$image.'.jpg');
				 		$images = $image . '.jpg';
				 	}else {
				 		Flasher::setFlash('gagal', ' ekstensi tidak di perbolehkan hanya jpg, jpeg, png', 'danger');
		    			header('Location: /public/dashboard');
		    			exit;
				 	}
				 }else {
				 	flasher::setFlash('gagal', ' pilih gambar terlebih dahulu', 'danger');
		    		header('Location: /public/dashboard');
		    		exit;
				 }

				 if ( $data['password1'] === $data['password']) {
					if ( strlen($data['password1']) < 30 ) {
						$password = password_hash($data['password1'], PASSWORD_DEFAULT);
					}else {
						Flasher::setFlash('gagal', ' password terlalu panjang', 'danger');
		    			header('Location: /register');
		    			exit;
		    			die();
					}
				}else {
					Flasher::setFlash('gagal', ' konfirmasi password salah', 'danger');
		    		header('Location: /register');
		    		exit;
		    		die();
				}


				$query = "UPDATE user SET username=:username, nama_lengkap=:nama_lengkap, lokasi=:lokasi, email=:email, gambar=:gambar WHERE id=:id";

				$this->db->query($query);
				$this->db->bind('id', htmlspecialchars($data["id"]));
				$this->db->bind('username', htmlspecialchars($username));
				$this->db->bind('password', htmlspecialchars($password));
				$this->db->bind('nama_lengkap', htmlspecialchars($nama_lengkap));
				$this->db->bind('lokasi', htmlspecialchars($lokasi));
				$this->db->bind('email', htmlspecialchars($email));
				$this->db->bind('gambar', $images);

				$this->db->execute();
				return $this->db->rowCount();
		}elseif (strlen($data["password"]) == 0 && !strlen($file['gambar']['name']) == 0) {
				echo "sdf2";
				$nama_gambar = $file['gambar']['name'];
				$tempat_gambar = $file['gambar']['tmp_name'];
				$error = $file['gambar']['error'];
				$size_gambar = $file['gambar']['size'];
				$tanggal = date("Y-m-d");

				if ($error != "4") {
				 	$ekstensi_valid = ['png', 'jpg', 'jpeg'];
				 	$x = explode('.', $nama_gambar);
				 	$ekstensi = strtolower(end($x));

				 	if (in_array($ekstensi, $ekstensi_valid)) {
				 		$image = strtolower(substr(base64_encode(sha1(mt_rand())), 0, 25));
				 		move_uploaded_file($tempat_gambar, '/var/www/html/public/assets/img/'.$image.'.jpg');
				 		$images = $image . '.jpg';
				 	}else {
				 		Flasher::setFlash('gagal', ' ekstensi tidak di perbolehkan hanya jpg, jpeg, png', 'danger');
		    			header('Location: /public/dashboard');
		    			exit;
				 	}
				 }else {
				 	flasher::setFlash('gagal', ' pilih gambar terlebih dahulu', 'danger');
		    		header('Location: /public/dashboard');
		    		exit;
				 }


				$query = "UPDATE user SET username=:username, nama_lengkap=:nama_lengkap, lokasi=:lokasi, email=:email, gambar=:gambar WHERE id=:id";

				$this->db->query($query);
				$this->db->bind('id', htmlspecialchars($data["id"]));
				$this->db->bind('username', htmlspecialchars($username));
				$this->db->bind('nama_lengkap', htmlspecialchars($nama_lengkap));
				$this->db->bind('lokasi', htmlspecialchars($lokasi));
				$this->db->bind('email', htmlspecialchars($email));
				$this->db->bind('gambar', $images);

				$this->db->execute();
				return $this->db->rowCount();
		}else {
				echo "sdf3";
				$query = "UPDATE user SET username=:username, nama_lengkap=:nama_lengkap, lokasi=:lokasi, email=:email, tanggal_lahir=:tanggal_lahir WHERE id=:id";

				$this->db->query($query);
				$this->db->bind('id', htmlspecialchars($data["id"]));
				$this->db->bind('username', htmlspecialchars($username));
				$this->db->bind('nama_lengkap', htmlspecialchars($nama_lengkap));
				$this->db->bind('tanggal_lahir', htmlspecialchars($tanggal_lahir));
				$this->db->bind('lokasi', htmlspecialchars($lokasi));
				$this->db->bind('email', htmlspecialchars($email));

				$this->db->execute();
				return $this->db->rowCount();
		}
	}

}