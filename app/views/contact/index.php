<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- icon -->
    <link rel="stylesheet" type="text/css" href="http://<?= BASEHOST; ?>/public/assets/css/flaticon.css">

    <!-- Bootstrap core CSS -->
    <link href="http://<?= BASEHOST; ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://<?= BASEHOST; ?>/public/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- /.container -->
    <!-- mulai navbaer -->

    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link garis-bawah active borderbutt" href="#">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link garis-bawah borderbutt" href="/public/about">About</a>
            <a class="nav-item nav-link garis-bawah borderbutt" href="/public/contact">Contact</a>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Kategori
                </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <option class="dropdown-item kategori-home">All</option>
                <?php foreach ($data['kategories'] as $kategori): ?>
                <option class="dropdown-item kategori-home"><?= $kategori['kategori']; ?></option>
                <?php endforeach; ?>
              </div>
        </li>
      </div>
    </nav>
    <!-- akhir navbar -->

    <!-- mulai jumbotron -->
    <div class="jumbotron jumbotron-fluid"  style="background-image: url(http://<?= BASEURL.'assets/img/'.$data['utility']['bacground_jumbotron']; ?>);">
        <div class="container">
            <h1 class="display-4"><?= $data['utility']['title_jubotron']; ?></h1>
        </div>
    </div>

    <!-- akhir jumbotron -->
    <div class="container">
        <section class="contact">
            <h2>Lorem ipsum dolor sit amet.</h2><br>
            <h4>Contact us with social media</h4>
            <div class="row justify-content-center">
                <div class="col-7">
                    <figure class="figure">
                        <img src="http://<?= BASEHOST; ?>/public/assets/img/002-facebook.png" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                    </figure>
                    <figure class="figure">
                        <img src="http://<?= BASEHOST; ?>/public/assets/img/006-linkedin.png" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                    </figure>
                    <figure class="figure">
                        <img src="http://<?= BASEHOST; ?>/public/assets/img/003-whatsapp.png" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                    </figure>
                    <figure class="figure">
                        <img src="http://<?= BASEHOST; ?>/public/assets/img/001-instagram-sketched.png" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                    </figure>
                    <figure class="figure">
                        <img src="http://<?= BASEHOST; ?>/public/assets/img/004-twitter.png" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                    </figure>
                </div>

            </div>
            <div class="form-contact">
                <h1>Or Contact With Form</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-8">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="nama" class=" form-control-label">Nama  :</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="nama" name="nama" placeholder="Nama" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="email" class=" form-control-label">Email :</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="email" id="email" name="email" placeholder="Example@email.com" class="form-control">
                                <small class="help-block form-text"></small>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="pesan" class="form-control-label">Pesan    :</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea name="pesan" id="pesan" rows="9" placeholder="Masukan Pesan" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <button type="submit" class="botton-kirim btn-primary">kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </section>
        <div class="j"></div>

    </div>
    
    <script src="http://<?= BASEHOST; ?>/public/assets/js/jquery.js"></script>
    <script>
        window.jQuery || document.write('<script src="http://<?= BASEHOST; ?>/public/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="http://<?= BASEHOST; ?>/public/assets/js/script.js"></script>
    <script src="http://<?= BASEHOST; ?>/public/assets/js/vendor/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
</body>

</html>