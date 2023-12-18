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
                        <ol class="breadcrumb ml-auto">
                            </ol>
                            <a href="" data-toggle="modal" data-target="#MasukKeranjang" class="btn btn-danger ddd d-none d-md-block pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Masukan ke kranjang</a>
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
                <div class="col-md-3 col-sm-4 col-xs-6 ml-auto">
                    <select class="form-control row border-top" id="kategori-laporan">
                        <option>All</option>
                           <?php foreach ($data['kategories'] as $kategori): ?>
                            <option><?= $kategori['kategori']; ?></option>
                           <?php endforeach; ?>
                     </select>
                </div>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <link rel="stylesheet" href="http://<?= BASEHOST; ?>/public/checklist/style.css">
                <style type="text/css">
                    .checked {
                        background-color: red;
                        border-radius: 15px;
                    }
                    .jumlah {
                        width: 40px;
                    }
                    .tambah {
                        text-align: center;
		              }
        		    .tambahh {
                        text-align: center;
                        margin-top: 4px !important; 
        		    }
        		    .kurangg {	
            			text-align: center;
            			margin-top: 4px !important;
        		    }  	 
        		    .kurang {
            			background-color: red;
            			border-radius: 4px;
            			color: white;
            			width: 24px;
            			height: 24px;
            			text-align: center;
        		   }
                    .tmbhh {
                        background-color: red;
                        border-radius: 4px;
                        color: white;
                        width: 24px;
                        height: 24px;
                        text-align: center;
                    }
		      </style>
                <div class="wrapper">

                    <div class="cards" id='laporan-produk-penjualan'>

		<?php foreach($data["produk"] as $produk): ?>

                        <div class="checkeble laporan-pokok-class" data-kategori="<?= $produk['kategori']; ?>">

                		    <figure class="card" id="<?= $produk['id']; ?>">

                			     <img src="http://<?= BASEHOST;  ?>/public/assets/img/<?= $produk['images']; ?>" />

                			<figcaption class="ll"><?= $produk['nama_produk']; ?></figcaption>

                        </figure>
                        
                    </div>
		<?php endforeach; ?>
                    

                    </div>
                </div>


                <div class="modal fade pebelians" id="MasukKeranjang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Pilih Pembaelanjaan</h5>
                            <button type="button" class="close" id="closeBeli" data-dismiss="modal" aria-label="Close">
                              <span id="ccs" aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
			  <form class="form-horizontal form-material" method="POST" action="http://<?= BASEURL; ?>/dashboard/bayar_pembelian" enctype="multipart/form-data">
                                    <table class="table" id="penjual">
                                        <thead>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Tamabah</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Kurang</th>
                                        </thead>
                                        <tbody id="pilihan">
                                            
                                        </tbody>
                                    <p>Total harga: <div class="total"></div></p>
                                    </table>
                                    <input type="hidden" id="csrf_token" name="csrf_token">
                                    
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Tambah Kategori</button>
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
