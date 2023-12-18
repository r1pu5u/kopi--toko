<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">Basic Table</h4>
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
            <div class="container-fluid" id="content">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">NOTA KWITANSI</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Nama Produk</th>
                                            <th class="border-top-0">Kategori</th>
                                            <th class="border-top-0">Harga</th>
                                            <th class="border-top-0">Jumlah</th>
                                        </tr>
                                    </thead>
                				    <tbody>
                					<?php $i = 0; ?>
                					<?php foreach($data['produk'] as $produk): ?>
                                                        <tr>
                						<td><?= $produk["nama_produk"]; ?></td>
                						<td><?= $produk["kategori"]; ?></td>
                						<td>Rp. <?= $produk["harga"];  ?>.000</td>
                						<td><?= $data['jumlah'][$i]; ?></td>
                					</tr>
                					<?php $i++; ?>
                					<?php endforeach; ?>
                					<tr>
                						<td></td>
                						<td></td>
                						<td><h3>Rp. <?= $_SESSION['total_harga']; ?>.000</h3></td>
                					</tr>
                                    </tbody>
                                </table>
			                 </div>
            				<h4>ID KWITANSI : <?= $_SESSION['id_kwitansi']; ?><h4><br>
            				<button class="btn btn-success prindd fas fa-print" onclick="window.print()" >Print Now</button>
                        </div>
                    </div>
            	</div>
		<?php 
			unset($_SESSION['id_kwitansi']);
			unset($_SESSION['total_harga']);
		?>
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
