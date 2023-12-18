<?php 
    use Carbon\Carbon;
 ?>
<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">Transaksi</h4>
                        
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
            <style>
                .warna-succes {
                    color: green;
                    text-transform: uppercase;
                }
                .warna-void {
                    color: red;
                    text-transform: uppercase;
                }
            </style>
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Trnsaksi</h3>
                            <div class="col-md-3 col-sm-4 col-xs-6 ml-auto">
                                    <select class="form-control row border-top" id="tanggal-transaksi">
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
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">ID transaksi</th>
                                            <th class="border-top-0">Tanggal</th>
                                            <th class="border-top-0">Status</th>
                                            <th class="border-top-0">Detail</th>
                                            <th class="border-top-0">Batalkan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($data['transaksi'] as $transaksi): ?>
                                        <?php $tombol = ($transaksi['status'] == 'void') ? 'actived' : 'cencel' ;?>
                                        <?php $warna = ($transaksi['status'] == 'void') ? 'success' : 'danger' ;?>
                                        <tr>
                                            <td><?= $transaksi['id_kwitansi']; ?></td>
                                            <td><?= $transaksi['tanggal']; ?></td>
                                            <td class=" warna-<?= $transaksi['status']; ?>"><?= $transaksi['status']; ?></td>
                                            <td><a class="btn btn-primary ingfo" data-toggle="modal" data-jml="<?= $transaksi['jumlah'] ?>" data-idprdk="<?= $transaksi['id_product']; ?>" data-target="#infoTransaksi" href=""><i class="fas fa-eye"></i></a></td>
                                            <td><a class="btn btn-<?= $warna; ?>" href="/public/dashboard/batalkan_transaksi/<?= $transaksi['id']; ?>"><?= $tombol; ?></a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <center>
                                    <div class="">
                                        <?php if ($data['halAktif'] > 1): ?>
                                            <a id="ke-kiri" class="fas fa-arrow-left"  data-haktif="<?= $data['halAktif']; ?>" href=""></a>
                                        <?php endif; ?>
                                        <?php for ($i=1; $i <= $data['hal']; $i++): ?>
                                            <?php if($i == $data['halAktif']): ?>
                                                <a data-hal="<?= $i; ?>" href="" class="halaman" style="color: black; font-weight: bold;"><?= $i; ?></a>
                                            <?php else: ?>
                                                <a data-hal="<?= $i; ?>" href="" class="halaman"><?= $i; ?></a>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($data['halAktif'] < $data['hal']): ?>
                                            <a class="fas fa-arrow-right" id="ke-kanan" data-haktif="<?= $data['halAktif']; ?>" href=""></a>
                                        <?php endif; ?>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
                <div class="modal fade" id="infoTransaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Detail Transaksi</h5>
                            <button type="button" class="close" id="closeDetail" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                                <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">NamaProduk</th>
                                            <th class="border-top-0">Harga</th>
                                            <th class="border-top-0">jumlah</th>
                                            <th class="border-top-0">total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detail_transaksi">
                                        
                                        

                                    </tbody>
                                </table>
                            </div>
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