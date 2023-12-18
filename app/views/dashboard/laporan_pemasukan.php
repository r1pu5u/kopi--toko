<?php 
    use Carbon\Carbon;
    $date = Carbon::now()->locale('id');
 ?>
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
                            <ol class="breadcrumb ml-auto">
                            </ol>
                            <a href="" target="_blank"
                                class="btn btn-danger d-none d-md-block pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light fas fa-file-pdf" id="laporan-pdf"> Generate To PDF</a>
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
               <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Produk</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-success"><?= $data['jml_produk']; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total User</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash2"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-purple"><?= $data['jml_user']; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Terjual</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash3"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-info"><?= $data['jml_terjual']; ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Basic Table</h3>
                            <div class="col-md-3 col-sm-4 col-xs-6 ml-auto">
                                    <select class="form-control row border-top" id="laporan-pokok">
                                        <option data-tanggal="<?= substr(Carbon::now()->locale('id')->toISOString('Y-m'), 0,7); ?>">
                                            <?= Carbon::now()->locale('id')->isoFormat('MMMM YYYY', 'Do MMMM'); ?>
                                        </option>
                                        <option data-tanggal="<?= substr(Carbon::now()->subMonth()->locale('id')->toISOString('Y-m'), 0,7); ?>">
                                            <?= Carbon::now()->subMonth()->locale('id')->isoFormat('MMMM YYYY', 'Do MMMM'); ?>
                                        </option>
                                        <option data-tanggal="<?= substr(Carbon::now()->subMonth(2)->locale('id')->toISOString('Y-m'), 0,7); ?>">
                                            <?= Carbon::now()->subMonth(2)->locale('id')->isoFormat('MMMM YYYY', 'Do MMMM'); ?>
                                        </option>
                                        <option data-tanggal="<?= substr(Carbon::now()->subMonth(3)->locale('id')->toISOString('Y-m'), 0,7); ?>">
                                            <?= Carbon::now()->subMonth(3)->locale('id')->isoFormat('MMMM YYYY', 'Do MMMM'); ?>
                                        </option>
                                        <option data-tanggal="<?= substr(Carbon::now()->subMonth(4)->locale('id')->toISOString('Y-m'), 0,7); ?>">
                                            <?= Carbon::now()->subMonth(4)->locale('id')->isoFormat('MMMM YYYY', 'Do MMMM'); ?>
                                        </option>
                                    </select>
                                </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody id='666'>
                                        <tr>
                                            <td>Modal Awal</td>
                                            <td><?= rupiah($data['toko']['modal'].'000'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Hasil penjualan</td>
                                            <td><?= rupiah($data['untung']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Pembelian Stok</td>
                                            <td><?= rupiah($data['keluar']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Laba Bersih</td>
                                            <td><?= $data['laba']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6 ml-auto">
                    <select class="form-control row border-top" id='laporan-produk'>
                        <option data-tanggal="<?= substr(Carbon::now()->locale('id')->toISOString('Y-m'), 0,7); ?>">
                            <?= Carbon::now()->locale('id')->isoFormat('MMMM YYYY', 'Do MMMM'); ?>
                        </option>
                        <option data-tanggal="<?= substr(Carbon::now()->subMonth()->locale('id')->toISOString('Y-m'), 0,7); ?>">
                            <?= Carbon::now()->subMonth()->locale('id')->isoFormat('MMMM YYYY', 'Do MMMM'); ?>
                        </option>
                        <option data-tanggal="<?= substr(Carbon::now()->subMonth(2)->locale('id')->toISOString('Y-m'), 0,7); ?>">
                            <?= Carbon::now()->subMonth(2)->locale('id')->isoFormat('MMMM YYYY', 'Do MMMM'); ?>
                        </option>
                        <option data-tanggal="<?= substr(Carbon::now()->subMonth(3)->locale('id')->toISOString('Y-m'), 0,7); ?>">
                            <?= Carbon::now()->subMonth(3)->locale('id')->isoFormat('MMMM YYYY', 'Do MMMM'); ?>
                        </option>
                       <option data-tanggal="<?= substr(Carbon::now()->subMonth(4)->locale('id')->toISOString('Y-m'), 0,7); ?>">
                            <?= Carbon::now()->subMonth(4)->locale('id')->isoFormat('MMMM YYYY', 'Do MMMM'); ?>
                        </option>
                    </select>
                </div><br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Basic Table</h3>
                            <div class="col-md-3 col-sm-4 col-xs-6 ml-auto">
                                <select class="form-control row border-top" id="kategori-laporan">
                                    <option>All</option>
                                    <?php foreach ($data['kategori'] as $kategori): ?>
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
                                            <th class="border-top-0">Total Terjual</th>
                                            <th class="border-top-0">Hasil</th>
                                        </tr>
                                    </thead>
				    <tbody id='laporan-produk-penjualan'>
					<?php $i = 1; ?>
					<?php foreach($data['hasil'] as $prdk): ?>
                    <tr class="laporan-pokok-class" data-kategori="<?= $prdk['kategori']; ?>">
						<td><?= $i; ?></td>
						<td><?= $prdk['nama_produk'];  ?></td>
						<td><?= $prdk['kategori'];  ?></td>
						<td><?= $prdk['harga']; ?></td>
						<td><?= $prdk['totalTerjual']; ?></td>
                        <td><?= rupiah($prdk['harga'] * $prdk['totalTerjual']); ?></td>
					</tr>
					<?php $i++; ?>
					<?php endforeach; ?>
                                    </tbody>
                                </table>
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
