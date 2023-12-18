<?php 

class About extends controller {
	public function index() {
		$data["produk"] = $this->model('Produk_model')->getAllProduk();
		$data['utility'] = $this->model('Utility_model')->get_utility();
		$data['kategories'] = $this->model('kategori_model')->getkategori();
		$data["produk"] = $this->model('Produk_model')->getAllProduk();

		$this->view('about/index', $data);
	}
	public function page() {
		$this->view('about/page');
	}
}