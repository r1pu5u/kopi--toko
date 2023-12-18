<?php
class Stok_model {
	private $table = 'stok';
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function add_stok($stok) {
		$query = "SELECT id, jumlah FROM ".$this->table;
		$this->db->query($query);
		$jmlAwal = $this->db->resultSet();
		$len = count($jmlAwal);
		$tanggal = date("Y-m-d");

		$i = 0;
		foreach ($jmlAwal as $jml) {
			if($jml['id'] == $stok['id']) {
				$query = "SELECT (jumlah + :jml) as total FROM ".$this->table." WHERE id=:id";
				$this->db->query($query);
				$this->db->bind('id', $stok['id']);
				$this->db->bind('jml', $stok['jumlah']);
				$jumlah = $this->db->single();
				$jumlah = $jumlah['total'];
				
				$query = "SELECT id, stok_awal, harga FROM produk WHERE id=:id";
				$this->db->query($query);
				$this->db->bind('id', $stok['id']);
				$prdkByid = $this->db->single();


				$query = "UPDATE stok SET tanggal=:tanggal, jumlah=:jumlah, user=:user WHERE id=:id; 
						INSERT INTO transaksi_stok (id, id_produk, jumlah, harga, user, tanggal) VALUES (NULL, :id, :jml, :harga, :user, :tanggal)";
				$this->db->query($query);
				$this->db->bind('id', $stok['id']);
				$this->db->bind('tanggal', $tanggal);
				$this->db->bind('jumlah', $jumlah);
				$this->db->bind('user', $_SESSION['username']);
				$this->db->bind('jml', $stok['jumlah']);
				$this->db->bind('harga', $prdkByid['harga']);

				$this->db->execute();
				return $this->db->rowCount();
			}else if ($i == $len - 1) {
				$query = "SELECT id, stok_awal, harga FROM produk WHERE id=:id";
				$this->db->query($query);
				$this->db->bind('id', $stok['id']);
				$prdkByid = $this->db->single();
				$harga = $prdkByid['harga'];
				

				$query = "INSERT INTO ".$this->table." (id, tanggal, jumlah, harga, user) VALUES (:id, :tanggal, :jumlah, :harga, :user)";
				$this->db->query($query);
				$this->db->bind('id', $stok['id']);
				$this->db->bind('tanggal', $tanggal);
				$this->db->bind('jumlah', $stok['jumlah']);
				$this->db->bind('harga', $harga);
				$this->db->bind('user', $_SESSION['username']);
				$this->db->execute();

				return $this->db->rowCount();
			}
   		$i++;
		}
		
			
	}

	public function jumlah_stok() {
		$query = "SELECT t2.id, t1.nama_produk, t2.jumlah, t1.harga_awal, t1.kategori FROM produk t1 INNER JOIN stok t2 USING (id)";
		$this->db->query($query);
		$prdk = $this->db->resultSet();

		return $prdk;
	}

	public function stok_bulanan($tanggal) {
		if (strlen($tanggal) == 0) {
			$tanggal = date("Y-m");
			$query = "SELECT * FROM transaksi_stok WHERE tanggal LIKE '".$tanggal."%'";
			$this->db->query($query);
			return $this->db->resultSet();
		}else if (!strlen($tanggal) == 0) {
			$query = "SELECT * FROM transaksi_stok WHERE tanggal LIKE :tanggal";
			$this->db->query($query);
			$this->db->bind('tanggal', "$tanggal%");
			return $this->db->resultSet();
		}
	}

	public function stok_tanggal($tanggal) {
		$query = "SELECT * FROM transaksi_stok WHERE tanggal LIKE '".$tanggal."%'";
		$this->db->query($query);
		$arr['stok'] = $this->db->resultSet();

		return $arr;
	}
}
