<?php 

class Home extends Controller {
	public function index() {
		$data["produk"] = $this->model('Produk_model')->getAllProduk();
		$data['cari'] = 'id="cari-produk-pembelian"';
		$data['kategories'] = $this->model('kategori_model')->getkategori();
		$data['utility'] = $this->model('Utility_model')->get_utility();


		$this->view('home/index', $data);
	}
}