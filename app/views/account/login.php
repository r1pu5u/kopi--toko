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
  			<div class="col col-lg-5 register">
  				<h2>Login</h2>
		  		<form action="http://<?= BASEHOST; ?>/public/account/cek_login" method="POST">
				  <div class="form-group">
				    <input type="text" class="form-control formulir" id="username" name="username" placeholder="Masukan Username">
				  </div>
				  <div class="form-group">
				    <input type="password" class="form-control formulir" id="password" name="password" placeholder="Masukan Password">
				  </div>
				  <button type="submit" class="btn btn-primary formulir">Login</button>
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