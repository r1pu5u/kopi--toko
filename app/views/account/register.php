<!DOCTYPE html>
<html>
<head>
  <title></title>
  <!-- icon -->
    <link rel="stylesheet" type="text/css" href="assets/css/flaticon.css">

    <!-- Bootstrap core CSS -->
    <link href="http://<?= BASEHOST; ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://<?= BASEHOST; ?>/public/assets/css/style-account.css" rel="stylesheet">
</head>
<body>
  <!-- container -->
    <!-- mulai navbaer -->

      	<div class="container">
  		<div class="row justify-content-center">
  			<div class="col col-lg-7 register">
  				<h2>Register</h2>
		  		<form action="tambah_user" method="POST">
				  <div class="form-row">
				    <div class="form-group col-md-6">
				      <input type="text" class="form-control formulir" id="username" name="username" placeholder="Username">
				    </div>
				    <div class="form-group col-md-6">
				      <input type="email" name="email" class="form-control formulir" id="email" placeholder="email">
				    </div>
				  </div>
				  <div class="form-group">
				    <input type="text" class="form-control formulir" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap">
				  </div>
				  <div class="form-group">
				    <input type="password" class="form-control formulir" id="password1" name="password1" placeholder="Masukan Password">
				  </div>
				  <div class="form-group">
				    <input type="password" class="form-control formulir" id="password2" name="password2" placeholder="Konfirmasi Password">
				  </div>
				  <div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="lokasi">Lokasi</label>
				      <input type="text" class="form-control formulir" name="lokasi" id="lokasi">
				    </div>
				    <?php if ($data['on_off_role'] == 'on'): ?>
				    	<?= '<div class="form-group col-md-2">
				      	<label for="level">Level</label>
				      	<select id="level" name="level" class="form-control level">
				        	<option selected>User</option>
				        	<option>Admin</option>
				        	<option>Kasir</option>
				      	</select>'; ?>
				    <?php endif ?>
				    </div>
				    <div class="form-group col-md-4">
				      <label for="inputZip">Tgl Lahir</label>
				      <input type="date" class="form-control formulir" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tgl Lahir">
				    </div>
				  </div>
				  <button type="submit" class="btn btn-primary formulir">Sign in</button>
				</form>
				<?php Flasher::flash(); ?>
			</div>
		</div>
	</div>

    <!-- akhir jumbotron -->
  <script src="http://<?= BASEHOST; ?>/public/assets/js/jquery.js"></script>
    <script>
        window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="http://<?= BASEHOST; ?>/public/assets/js/script1.js"></script>
    <script src="http://<?= BASEHOST; ?>/public/assets/js/vendor/popper.min.js"></script>
    <script src="http://<?= BASEHOST; ?>/public/dist/js/bootstrap.min.js"></script>
</body>
</html>