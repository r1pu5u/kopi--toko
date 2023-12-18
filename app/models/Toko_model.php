<?php
class Toko_model {
	private $table = 'profil_toko';
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function ubah_toko($data) {
		$query = "UPDATE ".$this->table." SET nama_cabang=:nama_cabang, contact=:contact, alamat=:alamat, modal=:modal, deskripsi=:deskripsi WHERE id=1";
		$this->db->query($query);
		$this->db->bind('nama_cabang', htmlspecialchars($data['nama_cabang']));
		$this->db->bind('contact', htmlspecialchars(intval($data['contact'])));
		$this->db->bind('alamat', htmlspecialchars($data['alamat']));
		$this->db->bind('modal', htmlspecialchars($data['modal']));
		$this->db->bind('deskripsi', htmlspecialchars($data['deskripsi']));

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function getInfoToko() {
		$query = "SELECT * FROM ".$this->table." WHERE id=1";
		$this->db->query($query);
		return $this->db->single();
	}
}
