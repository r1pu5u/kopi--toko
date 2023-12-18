<?php 

class Pembayaran_model {
	private $table = 'transaksi';
   	private $db;
	
	public function __construct() {
       		$this->db = new Database;
	}

	public function bayar_pembayaran($totalHarga, $idProduct, $jumlahProduct) {
		$query = "SELECT id, username FROM user WHERE username=:username";
		$this->db->query($query);
		$this->db->bind('username', $_SESSION["username"]);
		$user = $this->db->single();
		$date = date("Y-m-d");
		$id_kwitansi = substr(str_shuffle("0123456789"), 0, 15);
		$idPrdk = explode(",", $idProduct);
		$jmlPrdk = explode(",", $jumlahProduct);
		$idJmlPrdk = base64_encode(json_encode(array_combine($idPrdk, $jmlPrdk)));

		$query = "INSERT INTO ".$this->table." (id, tanggal, id_kwitansi, id_product, jumlah, user, total_harga, ket_json, status)
			VALUES (NULL, :tanggal, :id_kwitansi, :id_product, :jumlah, :user, :total_harga, :ket_json, 'succes')";
		$this->db->query($query);
		$this->db->bind('tanggal', $date);
		$this->db->bind('id_kwitansi', $id_kwitansi);
		$this->db->bind('id_product', $idProduct);
		$this->db->bind('jumlah', $jumlahProduct);
		$this->db->bind('user', $user["id"]);
		$this->db->bind('total_harga', $totalHarga);
		$this->db->bind('ket_json', $idJmlPrdk);

		$this->db->execute();
		
		echo $this->db->rowCount();
		if($this->db->rowCount() > 0) {
			$_SESSION["id_kwitansi"] = $id_kwitansi;
			$_SESSION["id_product"] = $idProduct;
			$_SESSION["total_harga"] = $totalHarga;
			$_SESSION['jmlhprdk'] = $jumlahProduct;

			header('Location: /public/dashboard/nota_kwitansi');
		}
		
	}

	public function totalTerjual() {
		$query = "SELECT jumlah FROM ".$this->table." WHERE status='succes'";
		$this->db->query($query);
		$jumlahArr = $this->db->resultSet();
		$jml = [];

		foreach ($jumlahArr as $value) {
			foreach ($value as $val) {
				array_push($jml, explode(",",$val));
			}
		}

		$jamal = [];
		foreach (array_values($jml) as $isi) {
			foreach ($isi as $c) {
				if (isset($c)) {
					$jamal[] = $c;
				}
			}
		}

		return array_sum($jamal);
	}

	public function totalTerjualByID($id) {
		$query = "SELECT id_product, jumlah, ket_json FROM " . $this->table;
		$this->db->query($query);
		$jumlahArr = $this->db->resultSet();

		$ss = array_column($jumlahArr, 'jumlah');
		$dd = array_column($jumlahArr, 'id_product');
		$json = array_column($jumlahArr, 'ket_json');

		$aa = [];
		foreach ($json as $val) {
			$vv = base64_decode($val);
			$aa[] = json_decode($vv, true);
		}

		return array_sum(array_column($aa, $id));

	}

	public function hasilPenjualan($tanggal, $max) {
		if(strlen($tanggal) == 0 && strlen($max) == 0) {
			$query = "SELECT id_product, jumlah, ket_json FROM ".$this->table." WHERE status='succes'";
			$this->db->query($query);
			$jumlahArr = $this->db->resultSet();

			$ss = array_column($jumlahArr, 'jumlah');
			$dd = array_column($jumlahArr, 'id_product');
			$json = array_column($jumlahArr, 'ket_json');

			$aa = [];
			foreach ($json as $val) {
				$vv = base64_decode($val);
				$aa[] = json_decode($vv, true);
			}

			if (!empty($ss)) {
				$query = "SELECT * FROM produk WHERE id IN (".$ss.")";    
				$this->db->query($query);
				$produk = $this->db->resultSet();
			} else {
				// Handle the case when $ss is empty
				$produk = [];
			}

		}elseif (!strlen($tanggal) == 0 && strlen($max) == 0) {
			$query = "SELECT id_product, jumlah, ket_json FROM " . $this->table." WHERE tanggal LIKE :tanggal AND status='succes'";
			$this->db->query($query);
			$this->db->bind('tanggal', "$tanggal%");
			$jumlahArr = $this->db->resultSet();

			$dd = array_column($jumlahArr, 'id_product');
			$json = array_column($jumlahArr, 'ket_json');

			$ss = [];
			foreach($dd as $t) {
				array_push($ss, explode(",", $t));
			}
			
			function array_2d_to_1d ($input_array) {
			    $output_array = array();

			    for ($i = 0; $i < count($input_array); $i++) {
				      for ($j = 0; $j < count($input_array[$i]); $j++) {
				        $output_array[] = $input_array[$i][$j];
				      }
			    	}
			    return $output_array;
			}
			$ss = array_2d_to_1d($ss);
			$ss = array_unique($ss);
			$ss = implode(",", $ss);

			$aa = [];
			foreach ($json as $val) {
				$vv = base64_decode($val);
				$aa[] = json_decode($vv, true);
			}

			if (!empty($ss)) {
				$query = "SELECT * FROM produk WHERE id IN (".$ss.")";    
				$this->db->query($query);
				$produk = $this->db->resultSet();
			} else {
				// Handle the case when $ss is empty
				$produk = [];
			}

	
		
		}elseif (!strlen($tanggal) == 0 && !strlen($max) == 0) {
			$query = "SELECT id_product, jumlah, ket_json FROM ".$this->table." WHERE tanggal LIKE :tanggal AND status='succes' ORDER by id DESC LIMIT ".$max;
			$this->db->query($query);
			$this->db->bind('tanggal', "$tanggal%");
			$jumlahArr = $this->db->resultSet();

			
			$dd = array_column($jumlahArr, 'id_product');
			$json = array_column($jumlahArr, 'ket_json');

			$ss = [];
			foreach($dd as $t) {
				array_push($ss, explode(",", $t));
			}
			$ss = array_unique($ss);
			$ss = implode(",", $ss);
			

			$aa = [];
			foreach ($json as $val) {
				$vv = base64_decode($val);
				$aa[] = json_decode($vv, true);
			}

			if (!empty($ss)) {
				$query = "SELECT * FROM produk WHERE id IN (".$ss.")";    
				$this->db->query($query);
				$produk = $this->db->resultSet();
			} else {
				// Handle the case when $ss is empty
				$produk = [];
			}


		}else {
			$query = "SELECT id_product, jumlah, ket_json FROM ".$this->table." WHERE status='succes' ORDER BY id DESC LIMIT ".$max;
			$this->db->query($query);
			$jumlahArr = $this->db->resultSet();
			
			$dd = array_column($jumlahArr, 'id_product');
			$json = array_column($jumlahArr, 'ket_json');

			$ss = [];
			foreach($dd as $t) {
				array_push($ss, explode(",", $t));
			}

			$blok =[];
			array_walk_recursive($ss, function($val) use (&$blok) {
				$blok[] = $val;
			});

			$ss = array_unique($blok);
			$ss = implode(",", $blok);

			$aa = [];
			foreach ($json as $val) {
				$vv = base64_decode($val);
				$aa[] = json_decode($vv, true);
			}

			if (!empty($ss)) {
				$query = "SELECT * FROM produk WHERE id IN (".$ss.")";    
				$this->db->query($query);
				$produk = $this->db->resultSet();
			} else {
				// Handle the case when $ss is empty
				$produk = [];
			}
	
		
		}

		$ppp = [];
		foreach ($produk as $row) {
			$row["totalTerjual"] = array_sum(array_column($aa, $row["id"]));
			array_push($ppp, $row);
		}
		
		return $ppp;
	}

	public function jmlTransaksi() {
		$query = "SELECT COUNT(*) FROM transaksi";
		$this->db->query($query);
		return $this->db->counTable();
	}

	public function getTransaksi($tanggal, $awalData, $jmlDataHal) {
		$query = "SELECT * FROM transaksi WHERE tanggal LIKE :tanggal ORDER BY id DESC LIMIT :awalData, :jmlDataHal";
		$this->db->query($query);
		$this->db->bind('tanggal', "$tanggal%");
		$this->db->bind('awalData', $awalData);
		$this->db->bind('jmlDataHal', $jmlDataHal);
		return $this->db->resultSet();
	}

	public function ubah_status($id) {
		$query = "SELECT status FROM transaksi WHERE id=:id";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$status1 = $this->db->single();
		$status1 = implode("", $status1);

		if ($status1 == 'void') {
			$status = 'succes';
			$query ="UPDATE transaksi SET status=:status WHERE id=:id";
			$this->db->query($query);
			$this->db->bind('status', $status);
			$this->db->bind('id', $id);

			$this->db->execute();
			return $this->db->rowCount();
		}else {
			$status = 'void';
			$query ="UPDATE transaksi SET status=:status WHERE id=:id";
			$this->db->query($query);
			$this->db->bind('status', $status);
			$this->db->bind('id', $id);

			$this->db->execute();
			return $this->db->rowCount();
		}

		
	}

}
