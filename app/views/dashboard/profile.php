<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">Profile page</h4>
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
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="http://<?= BASEHOST; ?>/public/panel/plugins/images/large/img1.jpg">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="" id="gUpload">
                                            <img src="http://<?= BASEHOST; ?>/public/assets/img/<?= $data['user']['gambar']; ?>" class="thumb-lg img-circle" alt="img" id='cgambar'>
                                        </a>
                                        <h4 class="text-white mt-2"><?= $data['user']['username']; ?></h4>
                                        <h5 class="text-white mt-2"><?= $data['user']['email']; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box mt-5 d-md-flex">
                                <div class="col-md-4 col-sm-4 text-center">
                                    <h1></h1>
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <h1><?= $data['user']['id']; ?></h1>
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <h1></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <style>
                        #gambarHidenUpload {
                            display: none;
                        }
                    </style>
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" method="POST" action="ubah_profile" enctype="multipart/form-data">
                                    <input type="hidden" id="id" name="id" value="<?= $data['user']['id']; ?>">
                                    <input type="file" id="gambarHidenUpload" name="gambar">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Nama Lengkap</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?= $data['user']['nama_lengkap']; ?>" placeholder="Nama Lengakap"
                                                class="form-control p-0 border-0"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Username</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="Username"
                                                class="form-control p-0 border-0" value="<?= $data['user']['username']; ?>" name="username"
                                                id="username">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" value="<?= $data['user']['email']; ?>" name="email" id="email" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Tanggal Lahir</label>
                                        <div class="col-sm-12 border-bottom">
                                            <input type="date"  value="<?= $data['user']['tanggal_lahir']; ?>" name="tanggal_lahir" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Lokasi</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text"  value="<?= $data['user']['lokasi']; ?>" name="lokasi" id="lokasi" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['token']; ?>">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" name="password" placeholder="Password" id="password" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" name="password1" id="password1" placeholder="Verify Password" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Ubah Profile</button>
                                        </div>
                                    </div>
                                </form>
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