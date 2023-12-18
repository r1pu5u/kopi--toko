<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">PRODUK</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Basic Table</h3>
                            <div class="col-md-3 col-sm-4 col-xs-6 ml-auto">
                                <select class="form-control row border-top" id="kategori-laporan">
                                    <option>All</option>
                                    <?php foreach ($data['kategories'] as $kategori): ?>
                                        <option><?= $kategori['kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                </div>
                                <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Nama Produk</th>
                                            <th class="border-top-0">Kategori</th>
                                            <th class="border-top-0">Harga</th>
					    <th class="border-top-0">Aksi</th>
						<th class="border-top-0">Add Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody id='laporan-produk-penjualan'>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data["produk"] as $prdk): ?>
                                        <tr class="laporan-pokok-class" data-kategori="<?= $prdk['kategori']; ?>">
                                            <td><?= $i; ?></td>
                                            <td class="ll"><?= $prdk["nama_produk"]; ?></td>
                                            <td><?= $prdk["kategori"]; ?></td>
                                            <td><?= $prdk["harga"]; ?> K</td>
					    <td><a class="fas fa-edit btn btn-primary modalUbah" data-toggle="modal" data-target="#exampleModalCenter" data-id="<?= $prdk['id']; ?>" href=""></a>  |  <a class="fas fa-trash-alt btn btn-danger" href="hapus_produk/<?= $prdk['id']; ?>"></td>
						<td><a class="fas fa-cart-plus addstok" data-toggle="modal" data-target="#tambahStok" data-id="<?= $prdk['id']; ?>" href=""></a></td>
                                        </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Produk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal form-material" method="POST" action="ubah_produk" enctype="multipart/form-data">
                                    <input type="hidden" id="id" name="id">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Nama Produk</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="nama_produk" id="nama-produk" placeholder="Nama Produk"
                                                class="form-control p-0 border-0"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">harga awla</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="30"
                                                class="form-control p-0 border-0" name="harga_awal"
                                                id="harga_awal">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">harga</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="30"
                                                class="form-control p-0 border-0" name="harga"
                                                id="harga">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Stok Awal</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="stok_awal" id="stok_awal" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <label class="col-sm-12">kategori</label>
                                        <div class="col-sm-12 border-bottom">
                                            <select name="kategori" id="kategori" class="form-control p-0 border-0">
                                                <?php foreach ($data["kategories"] as $kategori) : ?>
                                                    <option><?= $kategori['kategori']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">gambar</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="file" name="gambar" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['token']; ?>">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Keterangan</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <textarea rows="5" name="keterangan" id="keterangan" class="form-control p-0 border-0"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Ubah Produk</button>
                                        </div>
                                    </div>
                                </form>
                          </div>
                          <div class="modal-footer">
                          </div>
                        </div>
                      </div>
		    </div>
		
		 <div class="modal fade" id="tambahStok" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Stok</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
			  <div class="modal-body">
				<form method="POST" action="/public/dashboard/tambah_stok">
				
				  <div class="form-group mb-4">	
                                        <label class="col-md-12 p-0">Tambah Stok</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="jumlah" class="form-control p-0 border-0">
                                        </div>
                                    </div>
				<input type="hidden" name="id" id="id-stok">
				</div>                            
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Tambah Stok</button>
                                        </div>
                                    </div>
                                </form>
                          </div>
                          <div class="modal-footer">
                          </div>
                        </div>
                      </div>
                    </div>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
