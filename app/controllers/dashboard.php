<?php 
class Dashboard Extends Controller {
	public function index() {

		$data['hasil'] = [];
		$data['jml_produk'] = [];
		$data['jml_user'] = [];
		$data['jml_terjual'] = [];

		$data['hasil'] = $this->model('Pembayaran_model')->hasilPenjualan("", 10);
		$data['jml_produk'] = $this->model('Produk_model')->jumlahProduk();
		$data['jml_user'] = $this->model('user_model')->jumlahUser();
		$data['jml_terjual'] = $this->model('Pembayaran_model')->totalTerjual();
		
		$d = $_SESSION['level'];
		$data['hide'] = 'display :none;';
		$this->model('csrf_model')->tokenCsrf();

		if ($d == 1) {

			$this->view('template-dashboard/header');
			$this->view('dashboard/index', $data);
			$this->view('template-dashboard/footer');
		}elseif ($d == 2) {
			$this->view('template-dashboard/header_kasir', $data);
			$this->view('dashboard/index', $data);
			$this->view('template-dashboard/footer');
		}elseif ($d == 3) {
			$this->view('template-dashboard/header_user', $data);
			$this->view('dashboard/index', $data);
			$this->view('template-dashboard/footer');
		}else {
			header('Location: /public/account');
		}
		
	}

	public function produk() {
		$data["produk"] = $this->model('Produk_model')->getAllProduk();
		$data['cari'] = 'id="cari-produk-pembelian"';
		$data['kategories'] = $this->model('kategori_model')->getkategori();
		$d = $_SESSION['level'];

		if ($d == 1) {
			$this->view('template-dashboard/header', $data);
			$this->view('dashboard/produk', $data);
			$this->view('template-dashboard/footer');
		}elseif ($d == 2) {
			$this->view('template-dashboard/header_kasir', $data);
			$this->view('dashboard/produk', $data);
			$this->view('template-dashboard/footer');
		}else {
			header('Location :/public/dashboard');
		}
	}

	public function tambah_produk() {
		$data['hide'] = 'display :none;';
		$data = $this->model('kategori_model')->getkategori();

		$d = $_SESSION['level'];

		if ($d == 1) {
			$this->view('template-dashboard/header', $data);
			$this->view('dashboard/tambah_produk', $data);
			$this->view('template-dashboard/footer');
		}elseif ($d == 2) {
			$this->view('template-dashboard/header_kasir', $data);
			$this->view('dashboard/tambah_produk', $data);
			$this->view('template-dashboard/footer');
		}else {
			header('Location :/public/dashboard');
		}
	}

	public function buat_produk() {
		$d = $_SESSION['level'];

		if ($d == 1 || $d == 2) {
			if ($this->model('Produk_model')->buatProdukBaru($_POST, $_FILES) > 0) {
				header('Location: /public/dashboard/produk');
				exit;
			}
		}
	}

	public function hapus_produk($id) {
		$d = $_SESSION['level'];

		if ($d == 1 || $d == 2) {
			if ($this->model('Produk_model')->delete_produk($id) > 0) {
				header('Location: /public/dashboard/produk');
				exit;
			}
		}
	}

	public function getubah() {
		echo json_encode($this->model('Produk_model')->getProdukById($_POST['id']));
	}

	public function get_pembebelian() {
		$d = $_SESSION['level'];

		if ($d == 1 || $d == 2) {
			if (isset($_POST['IDs'])) {
				$IDs = implode(",", json_decode($_POST['IDs']));
				$IDs = preg_replace("/[^0-9, -]/", "", $IDs);
				$IDs = preg_replace("/\s+/", "", $IDs);
				if (!strlen($IDs) == 0) {
					echo json_encode($this->model('Produk_model')->getProduksById($IDs));	
				}
			}
		}
	}

	public function ubah_produk() {
		$d = $_SESSION['level'];

		if ($d == 1 || $d == 2) {
			if ($this->model('Produk_model')->ubahProduk($_POST, $_FILES) > 0) {
				header('Location: /public/dashboard/produk');
				exit;
			}
		}else {
			header('Location: /public/dashboard');
		}
	}

	public function users() {
		$data["users"] = $this->model('user_model')->getAllUser();
		$data['cari'] = 'id="cari-produk-pembelian"';
		$d = $_SESSION['level'];

		if ($d == 1) {
			$this->view('template-dashboard/header', $data);
			$this->view('dashboard/users', $data);
			$this->view('template-dashboard/footer');
		}else {
			header('Location: /public/dashboard');
		}
	}

	public function hapus_user($id) {
		$d = $_SESSION['level'];

		if ($d == 1) {
			if ($this->model('user_model')->delete_user($id) > 0) {
				header('Location: /public/dashboard/');
				exit;
			}
		}else {
			header('Location: /public/dashboard');
		}
	}

	public function getuser() {
		$d = $_SESSION['level'];

		if ($d == 1) {
			echo json_encode($this->model('user_model')->getUserById($_POST['id']));
		}else {
			header('Location: /public/dashboard');
		}
	}

	public function ubah_user() {
		$d = $_SESSION['level'];

		if ($d == 1) {
			if ($this->model('user_model')->ubahUser($_POST, $_FILES) > 0) {
				header('Location: /public/dashboard/');
				exit;
			}
		}else {
			header('Location: /public/dashboard');
		}
	}

	public function logout() {
		$_SESSION = [];
		$_COOKIE = [];
		session_unset();
		session_destroy();
		setcookie('auth', NULL, time()-3600, '/');
		setcookie('username', NULL, time()-3600, '/');
		setcookie('level', NULL, time()-3600, '/');
		setcookie( 'username', '', FALSE, -1, '/', '.'.$_SERVER['SERVER_NAME'] );
		setcookie( 'level', '', FALSE, -1, '/', '.'.$_SERVER['SERVER_NAME'] );
		setcookie( 'auth', '', FALSE, -1, '/', '.'.$_SERVER['SERVER_NAME'] );
		unset($_COOKIE['username']);
		unset($_COOKIE['level']);
		unset($_COOKIE['auth']);
		unset($_COOKIE);
		$_COOKIE['auth'] = "";
		$_COOKIE['username'] = "";
		$_COOKIE['level'] = "";
		array_shift($_COOKIE);
		array_shift($_COOKIE);
		array_shift($_COOKIE);
		array_shift($_COOKIE);
		array_shift($_COOKIE);
		
		if (count($_COOKIE) == 0 && count($_SESSION) == 0) {
			echo '<script src="http://'.BASEHOST.'/public/assets/js/jquery.js"></script><script>$(function() {$.cookie("auth", null, {path: "/"})});</script>';
		}

		header('Location: /public/account');
	}

	public function profile() {
		$data['hide'] = 'display :none;';
		$data["user"] = $this->model('user_model')->getUserByUsername($_SESSION['username']);
		$d = $_SESSION['level'];

		if ($d == 1) {
			$this->view('template-dashboard/header', $data);
			$this->view('dashboard/profile', $data);
			$this->view('template-dashboard/footer');
		}elseif ($d == 2) {
			$this->view('template-dashboard/header_kasir', $data);
			$this->view('dashboard/profile', $data);
			$this->view('template-dashboard/footer');
		}elseif ($d == 3) {
			$this->view('template-dashboard/header_user', $data);
			$this->view('dashboard/profile', $data);
			$this->view('template-dashboard/footer');
		}
	}

	public function tambah_kategori() {
		$d = $_SESSION['level'];

		if ($d == 1 || $d == 2) {
			if ($this->model('kategori_model')->buat_kategori($_POST) > 0) {
				header('Location: /public/dashboard/buat_produk');
			}
		}else {
			header('Location: /public/dashboard');	
		}
	}

	public function ubah_profile() {
		$d = $_SESSION['level'];

		if ($d == 1 || $d == 2) {
			$anti_idor = $this->model('user_model')->getUserByUsername($_SESSION['username']);
			if ($anti_idor['id'] === $_POST['id']) {
				if ( $this->model('user_model')->ubahUserUmum($_POST, $_FILES) > 0 ) {
					header('Location: /public/dashboard/profile');
				}
			}
		}
	}

	public function pembelian() {
		$data["produk"] = $this->model('Produk_model')->getAllProduk();
		$data['kategories'] = $this->model('kategori_model')->getkategori();
		$data['cari'] = 'id="cari-produk-pembelian"';

		$d = $_SESSION['level'];

		if ($d == 1) {
			$this->view('template-dashboard/header', $data);
			$this->view('dashboard/pembelian', $data);
			$this->view('template-dashboard/footer');
		}elseif ($d == 2) {
			$this->view('template-dashboard/header_kasir', $data);
			$this->view('dashboard/pembelian', $data);
			$this->view('template-dashboard/footer');
		}
	}

	public function bayar_pembelian() {
		$idkeys = array();
		foreach($_POST as $idkey=>$value) {
			array_push($idkeys, $idkey);
		}	
		$IdKeys = implode(',', $idkeys);
		$IdKeys = preg_replace("/[^0-9, -]/", "", $IdKeys);
		$IdKeys = preg_replace("/\s+/", "", $IdKeys);
		$IdKeys = substr_replace($IdKeys, "", -1);
		$jumlahIdKeys = explode(",", $IdKeys);
		$jumlahIdKeys = count($jumlahIdKeys);

		if (!strlen($IdKeys) == 0) {
			$getProduk = $this->model('Produk_model')->getProduksById($IdKeys);
			$IdDariDB = [];
			$HargaArr = [];
			foreach($getProduk as $prdk) {
				array_push($IdDariDB, $prdk["id"]);
				array_push($HargaArr, $prdk["harga"]);
			}
			
			$IdDariDB = implode(',', $IdDariDB);
			$jumlahs = [];
			if($IdDariDB == $IdKeys) {
				$arrJumlah = array_slice($_POST,0,count($_POST)-1);
				if(count($arrJumlah) == $jumlahIdKeys) {
					foreach($arrJumlah as $key=>$jumlah) {
						if((is_int($jumlah) || ctype_digit($jumlah)) && (int)$jumlah > 0) {
							array_push($jumlahs, $jumlah);
							$totalHarga = 0;
							foreach($jumlahs as $k=>$v) {
								$totalHarga += $v*$HargaArr[$k];	
							}
						}else {
							die('ojo gowo min ro huruf');
						}	
					}		
				}
			

				if(!strlen($totalHarga) == 0 || !is_null($totalHarga)) {
					$arrJumlah = implode(",", $arrJumlah);
					$this->model('Pembayaran_model')->bayar_pembayaran($totalHarga,	$IdDariDB, $arrJumlah);
				}

				
			}

			
		}
	}

	public function profile_toko() {
		$data['hide'] = 'display :none;';
		$data['toko'] = $this->model('Toko_model')->getInfoToko();

		$d = $_SESSION['level'];

		if ($d == 1) {
			$this->view('template-dashboard/header', $data);
			$this->view('dashboard/profile_toko', $data);
			$this->view('template-dashboard/footer');
		}
	}

	public function transaksi_stok() {
		$d = $_SESSION['level'];

		if ($d == 1 || $d == 2) {
		if (isset($_POST['tanggal'])) {
			if (strlen($_POST['tanggal']) == 7) {
				$tanggal = preg_replace("/[^0-9- -]/", "", $_POST['tanggal']);
				// $data['stok'] = $this->model('Stok_model')->stok_tanggal($tanggal);
				// $data['bayar'] = $this->model('Pembayaran_model')->hasilPenjualan($tanggal, null);
				// $data['toko'] = $this->model('Toko_model')->getInfoToko();

				$data['hasil'] = $this->model('Pembayaran_model')->hasilPenjualan($tanggal, null);
				$data['toko'] = $this->model('Toko_model')->getInfoToko();
				$data['stok'] = $this->model('Stok_model')->stok_bulanan($tanggal);

				echo json_encode($data);
			}
		}
		}
	}

	public function nota_kwitansi() {
		if(isset($_SESSION['jmlhprdk'], $_SESSION['id_product'], $_SESSION['id_kwitansi'], $_SESSION['total_harga'])) {
			$data['produk'] = $this->model('Produk_model')->getProduksById($_SESSION["id_product"]);
			$data['jumlah'] = explode(",", $_SESSION['jmlhprdk']);

			$d = $_SESSION['level'];

			if ($d == 1) {
				$this->view('template-dashboard/header');
				$this->view('dashboard/nota_kwitansi', $data);
				$this->view('template-dashboard/footer');
			}elseif ($d == 2) {
				$this->view('template-dashboard/header_kasir');
				$this->view('dashboard/nota_kwitansi', $data);
				$this->view('template-dashboard/footer');
			}
		}
	}

	public function laporan_keuangan() {
		$tanggal = date("Y-m");
		$data['hasil'] = $this->model('Pembayaran_model')->hasilPenjualan($tanggal, null);
		$data['toko'] = $this->model('Toko_model')->getInfoToko();
		$rr = $this->model('Stok_model')->stok_bulanan($tanggal);
		$dd = [];
		foreach ($rr as $value) {
			$dd[] = $value['harga'] * $value['jumlah'];	
		}

		$data['jml_produk'] = $this->model('Produk_model')->jumlahProduk();
		$data['jml_user'] = $this->model('user_model')->jumlahUser();
		$data['jml_terjual'] = $this->model('Pembayaran_model')->totalTerjual();

		function rupiah($angaka) {
			$hasil = "Rp " . number_format($angaka,2,',','.');
			return $hasil;
		}
		$ds = $dd;
		$dd = array_sum($dd)."000";

		$data['keluar'] = $dd;

		$data['untung'] = [];
		foreach ($data['hasil'] as $value) {
			$data['untung'][] = $value['harga'] * $value['totalTerjual'];
		}

		$data['untung'] = array_sum($data['untung']);

		$data['laba'] = $data['untung'] - array_sum($ds);
		$data['laba'] = rupiah($data['laba'].'000');
		$data['kategori'] = $this->model('kategori_model')->getkategori();

		$d = $_SESSION['level'];

		if ($d == 1) {
			$this->view('template-dashboard/header');
			$this->view('dashboard/laporan_pemasukan', $data);
			$this->view('template-dashboard/footer');
		}elseif ($d == 2) {
			$this->view('template-dashboard/header_kasir');
			$this->view('dashboard/laporan_pemasukan', $data);
			$this->view('template-dashboard/footer');
		}else {
			header('Location: /public/dashboard');
		}
	}

	public function tambah_stok() {
		$d = $_SESSION['level'];

		if ($d == 1 || $d == 2) {
			if(isset($_POST['jumlah'], $_POST['id'])) {
				if($this->model('Stok_model')->add_stok($_POST) > 0) {
					header('Location: /public/dashboard/stok');	
				}
			}
		}
	}

	public function ubah_profile_toko() {
		$d = $_SESSION['level'];
		
		if ($d == 1) {
			if(isset($_POST['nama_cabang'], $_POST['alamat'], $_POST['modal'], $_POST['deskripsi'])) {
				if($this->model('Toko_model')->ubah_toko($_POST) > 0) {
					header('Location: /public/dashboard/profile_toko');				
				}
			}
		}else {
			header('Location: /public/dashboard');
		}
	}

	public function transaksi() {
		$jmlDataPerHalaman = 10;
		$jmlData = $this->model('Pembayaran_model')->jmlTransaksi();
		$jmlHalaman = ceil($jmlData / $jmlDataPerHalaman);
		$halamanAktif = ( isset($_GET['halaman']) ) ? $_GET['halaman'] : 1;
		$awalData = ( $jmlDataPerHalaman * $halamanAktif ) - $jmlDataPerHalaman;
		$tanggal = ( isset($_GET['tanggal']) ) ? $_GET['tanggal'] : date("Y-m");


		$data['transaksi'] =  $this->model('Pembayaran_model')->getTransaksi($tanggal, $awalData, $jmlDataPerHalaman);
		$data['hal'] = $jmlHalaman;
		$data['halAktif'] = $halamanAktif;
		$d = $_SESSION['level'];
		
		if ($d == 1) {
			$this->view('template-dashboard/header');
			$this->view('dashboard/transaksi', $data);
			$this->view('template-dashboard/footer');
		}elseif ($d == 2) {
			$this->view('template-dashboard/header_kasir');
			$this->view('dashboard/transaksi', $data);
			$this->view('template-dashboard/footer');
		}
	}

	public function get_transaksi() {
		if (isset($_POST['IDs'])) {
			$IDs = $_POST['IDs'];
			$IDs = preg_replace("/[^0-9, -]/", "", $IDs);
			$IDs = preg_replace("/\s+/", "", $IDs);
			if (!strlen($IDs) == 0) {
				echo json_encode($this->model('Produk_model')->getProduksById($IDs));	
			}
		}
	}

	public function batalkan_transaksi($id) {
		$d = $_SESSION['level'];
		
		if ($d == 1 || $d == 2) {
			if ($this->model('Pembayaran_model')->ubah_status($id) > 0) {
				header('Location: /public/dashboard/transaksi');
				exit;
			}
		}
	}

	public function stok() {
		$data['stok'] = $this->model('Stok_model')->jumlah_stok();
		$data['hasil'] = $this->model('Pembayaran_model')->hasilPenjualan(null, null);
		$data['cari'] =  'id="cari-produk-pembelian"';
		$data['kategories'] = $this->model('kategori_model')->getkategori();

		$d = $_SESSION['level'];
		
		if ($d == 1) {
			$this->view('template-dashboard/header', $data);
			$this->view('dashboard/stok', $data);
			$this->view('template-dashboard/footer');
		}elseif ($d == 2) {
			$this->view('template-dashboard/header_kasir', $data);
			$this->view('dashboard/stok', $data);
			$this->view('template-dashboard/footer');
		}else {
			header('Location: /public/dashboard');
		}
	}

	public function setting() {
		$data['utility'] = $this->model('Utility_model')->get_utility();
		$data['hide'] = 'display :none;';
		$d = $_SESSION['level'];
		
		if ($d == 1) {
			$this->view('template-dashboard/header', $data);
			$this->view('dashboard/setting', $data);
			$this->view('template-dashboard/footer');
		}else {
			header('Location: /public/dashboard');
		}
	}

	public function ubah_setting() {
		$d = $_SESSION['level'];
		
		if ($d == 1) {
			if(isset($_POST['title_jubotron'], $_POST['title'])) {
				if($this->model('Utility_model')->ubah_utility($_POST, $_FILES) > 0) {
					header('Location: /public/dashboard/setting');				
				}
			}
		}else {
			header('Location: /public/dashboard');
		}
	}

	public function laporan_pdf($tanggal) {
		$data['hasil'] = $this->model('Pembayaran_model')->hasilPenjualan($tanggal, null);
		$data['toko'] = $this->model('Toko_model')->getInfoToko();
		$rr = $this->model('Stok_model')->stok_bulanan($tanggal);
		$dd = [];
		foreach ($rr as $value) {
			$dd[] = $value['harga'] * $value['jumlah'];	
		}

		// function rupiah($angaka) {
		// 	$hasil = "Rp " . number_format($angaka,2,',','.');
		// 	return $hasil;
		// }
		$ds = $dd;
		$dd = array_sum($dd)."000";

		$data['keluar'] = $dd;

		$data['untung'] = [];
		foreach ($data['hasil'] as $value) {
			$data['untung'][] = $value['harga'] * $value['totalTerjual'];
		}

		$data['untung'] = array_sum($data['untung']);

		$data['laba'] = $data['untung'] - array_sum($ds);
		$data['laba'] = rupiah($data['laba'].'000');
		$data['kategori'] = $this->model('kategori_model')->getkategori();

		$this->view('dashboard/pdf_report', $data);
	}

}
