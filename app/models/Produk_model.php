<?php 

class Produk_model {
	private $table = 'produk';
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function getAllProduk() {
		$this->db->query('SELECT * FROM ' . $this->table);
		return $this->db->resultSet();
	}

	public function getProdukById($id) {
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
		$this->db->bind('id', $id);
		return $this->db->single();

	}

	public function cariProduk($cari) {
		$query = "SELECT * FROM produk WHERE nama_produk LIKE :nama_produk";
		$this->db->query($query);
		$this->db->bind('nama_produk', "%$cari%");
		return $this->db->resultSet();
	}

	public function getProduksById($IDs) {
		$query ="SELECT id, nama_produk, harga, kategori FROM " . $this->table . " WHERE id IN (".$IDs.")";
		$this->db->query($query);
		return $this->db->resultSet();
	}

	public function buatProdukBaru($data, $gambar) {
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
		 	flasher::setFlash('gagal', ' pilih gambar terlebih dahulu', 'danger');
    		header('Location: /public/dashboard');
    		exit;
		 }


		$query = "INSERT INTO produk (id, nama_produk, kategori, stok_awal, images, harga_awal, harga, keterangan) VALUES (NULL, :nama_produk, :kategori, :stok_awal, :images, :harga_awal, :harga, :keterangan)";
		$this->db->query($query);
		$this->db->bind('nama_produk', htmlspecialchars($data["nama_produk"]));
		$this->db->bind('kategori', htmlspecialchars($data["kategori"]));
		$this->db->bind('stok_awal', htmlspecialchars($data["stok_awal"]));
		$this->db->bind('images', $images);
		$this->db->bind('harga_awal', htmlspecialchars($data["harga_awal"]));
		$this->db->bind('harga', htmlspecialchars($data["harga"]));
		$this->db->bind('keterangan', htmlspecialchars($data["keterangan"]));

		$this->db->execute();

		$query = "SELECT last_insert_id() as last_id";
		$this->db->query($query);
		$lastId = $this->db->single();
		$lastId = implode("", $lastId);

		$query = "INSERT INTO stok (id, tanggal, jumlah, harga, user) VALUES (:id, :tanggal, :jumlah, :harga, :user);INSERT INTO transaksi_stok (id, id_produk, jumlah, harga, user, tanggal) VALUES (NULL, :id, :jumlah, :harga, :user, :tanggal)";
		$this->db->query($query);
		$this->db->bind('id', $lastId);
		$this->db->bind('tanggal', $tanggal);
		$this->db->bind('jumlah', htmlspecialchars($data['stok_awal']));
		$this->db->bind('harga', htmlspecialchars($data['harga']));
		$this->db->bind('user', $_SESSION['username']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function delete_produk($id) {
		$query = 'DELETE FROM ' . $this->table . ' WHERE id=:id';
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();
		return $this->db->rowCount();
	}

	public function ubahProduk($data, $gambar) {
		$nama_gambar = $gambar['gambar']['name'];
		$tempat_gambar = $gambar['gambar']['tmp_name'];
		$error = $gambar['gambar']['error'];
		$size_gambar = $gambar['gambar']['size'];

		if ($error != "4") {
		 	$ekstensi_valid = ['png', 'jpg', 'jpeg'];
		 	$x = explode('.', $nama_gambar);
		 	$ekstensi = strtolower(end($x));

		 	if (in_array($ekstensi, $ekstensi_valid)) {
		 		$image = strtolower(substr(base64_encode(sha1(mt_rand())), 0, 25));
		 		move_uploaded_file($tempat_gambar, '/var/www/html/public/assets/img/'.$image.'.jpg');
		 		$images = $image . '.jpg';

		 		
		 		$query = "UPDATE produk SET nama_produk=:nama_produk, kategori=:kategori, stok_awal=:stok_awal, keterangan=:keterangan, harga=:harga, images=:images, harga_awal=:harga_awal WHERE id=:id";
				$this->db->query($query);
				$this->db->bind('id', htmlspecialchars($data["id"]));
				$this->db->bind('nama_produk', htmlspecialchars($data["nama_produk"]));
				$this->db->bind('kategori', htmlspecialchars($data["kategori"]));
				$this->db->bind('images', $images);
				$this->db->bind('stok_awal', htmlspecialchars($data["stok_awal"]));
				$this->db->bind('harga', htmlspecialchars($data["harga"]));
				$this->db->bind('harga_awal', htmlspecialchars($data["harga_awal"]));
				$this->db->bind('keterangan', htmlspecialchars($data["keterangan"]));

				$this->db->execute();
				return $this->db->rowCount();
		 	}else {
		 		Flasher::setFlash('gagal', ' ekstensi tidak di perbolehkan hanya jpg, jpeg, png', 'danger');
    			header('Location: /public/dashboard');
    			exit;
		 	}
		 }else {
		 	$query = "UPDATE produk SET nama_produk=:nama_produk, kategori=:kategori, stok_awal=:stok_awal, keterangan=:keterangan, harga=:harga, harga_awal=:harga_awal WHERE id=:id";
			$this->db->query($query);
			$this->db->bind('id', htmlspecialchars($data["id"]));
			$this->db->bind('nama_produk', htmlspecialchars($data["nama_produk"]));
			$this->db->bind('kategori', htmlspecialchars($data["kategori"]));
			$this->db->bind('stok_awal', htmlspecialchars($data["stok_awal"]));
			$this->db->bind('harga', htmlspecialchars($data["harga"]));
			$this->db->bind('harga_awal', htmlspecialchars($data["harga_awal"]));
			$this->db->bind('keterangan', htmlspecialchars($data["keterangan"]));

			$this->db->execute();
			return $this->db->rowCount();
		 }
	}

	public function jumlahProduk() {
		$query = "SELECT COUNT(*) FROM produk";
		$this->db->query($query);
		return $this->db->counTable();
	}

}