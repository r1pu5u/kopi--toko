 <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">Tambah Produk</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ml-auto">
                            </ol>
                            <a href="" data-toggle="modal" data-target="#BuatKategori"
                                class="btn btn-danger  d-none d-md-block pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Tambah Kategori</a>
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
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-10 col-xlg-10 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" method="POST" action="/public/dashboard/ubah_setting" enctype="multipart/form-data">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Judul Laman Web</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="title" placeholder="Judul Web" value="<?= $data['utility']['title']; ?>" 
                                                class="form-control p-0 border-0"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">BackGround Jumbotron</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="file" placeholder="30"
                                                class="form-control p-0 border-0" name="background_jumbotron"
                                                id="example-email">
                                        </div>
                                    </div>
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['token']; ?>">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Slogan Jumbotron</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <textarea rows="5" name="title_jubotron" class="form-control p-0 border-0"><?= $data['utility']['title_jubotron']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Role Register On</label>
                                        <div class="col-md-12 p-0">
                                            <input type="radio" placeholder="30"
                                                class="" name="on_off_role"
                                                id="example-email" value="on">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Role Register Off</label>
                                        <div class="col-md-12 p-0">
                                            <input type="radio" placeholder="30" name="on_off_role"
                                                id="example-email" value="off">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-7 p-0">Warna Navbar</label>
                                        <div class="col-md-12 p-0">
                                            <select name="color_navbar" class="form-control p-0 border-0">
                                                <option value="red">Red</option>
                                                <option value="blue">Blue</option>
                                                <option value="black">Black</option>
                                                <option value="white">White</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Ubah Setting</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="BuatKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Kategori</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal form-material" method="POST" action="tambah_kategori" enctype="multipart/form-data">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Kategori</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="kategori" id="kategori" placeholder="Kategori"
                                                class="form-control p-0 border-0"> </div>
                                    </div>
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
                    <!-- Column -->
                </div>
                <!-- Row -->
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