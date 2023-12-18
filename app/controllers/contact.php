<?php 

class Contact extends controller
{
	
	public function index()
	{
		$data['utility'] = $this->model('Utility_model')->get_utility();
		$data["produk"] = $this->model('Produk_model')->getAllProduk();
		$data['kategories'] = $this->model('kategori_model')->getkategori();

		$this->view('contact/index', $data);
	}

	public function cari() {
			if (isset($_POST['cari'])) {
				json_encode($this->model('Produk_model')->cariProduk($_POST['cari']));
			}
		}
}