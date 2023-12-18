<?php 

class Utility_model {
	private $table = 'utility';
   	private $db;
	
	public function __construct() {
       		$this->db = new Database;
	}

	public function get_utility() {
		$query = "SELECT * FROM utility WHERE id=1";
		$this->db->query($query);
		return $this->db->single();
	}

	public function ubah_utility($data, $gambar) {
		$nama_gambar = $gambar['gambar']['name'];
		$tempat_gambar = $gambar['gambar']['tmp_name'];
		$error = $gambar['gambar']['error'];
		$size_gambar = $gambar['gambar']['size'];
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
		 	Flasher::setFlash('gagal', ' pilih gambar terlebih dahulu', 'danger');
    		header('Location: /public/dashboard');
    		exit;
		 }


		$query = "UPDATE utility SET title=:title, title_jubotro=:title_jubotro, bacground_jumbotron=:bacground_jumbotron, on_off_role=:on_off_role, color_navba=:color_navbar WHERE id=1";
		$this->db->query($query);
		$this->db->bind('nama_cabang', htmlspecialchars($data['title']));
		$this->db->bind('title_jubotro', htmlspecialchars($data['title_jubotro']));
		$this->db->bind('bacground_jumbotron', $images);
		$this->db->bind('on_off_role', htmlspecialchars($data['on_off_role']));
		$this->db->bind('color_navba', htmlspecialchars($data['color_navba']));

		$this->db->execute();

		return $this->db->rowCount();
	}
}