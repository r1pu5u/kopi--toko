<?php 
class Produk Extends Controller {
	public function index() {
		$data['prdk'] = $this->model('Produk_model')->getAllProduk();
		$this->view('produk/index', $data);
	}

	public function detail($id) {
		$data['prdk'] = $this->model('Produk_model')->getProdukById($id);
		$this->view('produk/detail', $data);
	}
}