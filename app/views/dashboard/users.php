<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">users</h4>
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
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Nama Lengakap</th>
                                            <th class="border-top-0">Username</th>
                                            <th class="border-top-0">Role</th>
                                            <th class="border-top-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data["users"] as $user): ?>
                                        <tr class="laporan-pokok-class" >
                                            <td><?= $i; ?></td>
                                            <td class="ll"><?= $user["nama_lengkap"]; ?></td>
                                            <td>@<?= $user["username"]; ?></td>
                                            <td><?php if ($user["level"]==1) {echo 'admin';}elseif ($user["level"]==2) {echo 'kasir';}else{echo 'user';} ?></td>
                                            <td><a class="fas fa-edit btn btn-primary ubahUser" data-toggle="modal" data-target="#ubahUser" data-id="<?= $user['id']; ?>" href=""></a>  |  <a class="fas fa-trash-alt btn btn-danger" href="http://<?= BASEHOST; ?>/public/dashboard/hapus_user/<?= $user['id']; ?>"></td>
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
                    <div class="modal fade" id="ubahUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Ubah User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal form-material" method="POST" action="ubah_user" enctype="multipart/form-data">
                                    <input type="hidden" id="id-user" name="id">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Nama Lengkap</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengakap"
                                                class="form-control p-0 border-0"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Username</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="Username"
                                                class="form-control p-0 border-0" name="username"
                                                id="username">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" name="email" id="email" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <label class="col-sm-12">Role</label>
                                        <div class="col-sm-12 border-bottom">
                                            <select name="level" id="level" class="form-control p-0 border-0">
                                                    <option>Admin</option>
                                                    <option>Kasir</option>
                                                    <option>User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Lokasi</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="lokasi" id="lokasi" class="form-control p-0 border-0">
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
                                            <button type="submit" class="btn btn-success">Ubah User</button>
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