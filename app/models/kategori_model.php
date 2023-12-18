<?php 

class Kategori_model {
	private $table = 'kategori';
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function getkategori() {
		$this->db->query('SELECT * FROM kategori');
		return $this->db->resultSet();
	}

	public function buat_kategori($data) {
		$query = "INSERT INTO kategori (id, kategori) VALUES (NULL, :kategori)";
		$this->db->query($query);
		$this->db->bind('kategori', htmlspecialchars($data["kategori"]));

		$this->db->execute();
		return $this->db->rowCount();
	}
}