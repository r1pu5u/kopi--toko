<!DOCTYPE html>
<html>
<head>
  <title></title>
  <!-- icon -->
    <link rel="stylesheet" type="text/css" href="assets/css/flaticon.css">

    <!-- Bootstrap core CSS -->
    <link href="http://<?= BASEHOST; ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://<?= BASEHOST; ?>/public/assets/css/style.css" rel="stylesheet">
</head>
<body>
  <!-- container -->
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
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2 lonjong" id="cari-produk-pembelian" type="search" placeholder="Search" aria-label="Search">
          </form>
        </div>
      </div>
    </nav>
    <!-- akhir navbar -->
    <!-- mulai jumbotron -->
    <div class="jumbotron jumbotron-fluid" style="background-image: url(http://<?= BASEURL.'assets/img/'.$data['utility']['bacground_jumbotron']; ?>);">
        <div class="container">
            <h1 class="display-4"><?= $data['utility']['title_jubotron']; ?></h1>
            <!-- <?php var_dump($data['utility']); ?> -->
            <center>
            <a class="btn btn-primary lonjong" href="/public/account/register">JOIN US</a>
            </center>
        </div>
    </div>
    <!-- akhir jumbotron -->
    <!-- card -->
    <div class="container">
        <ul>
        <?php foreach ($data['produk'] as $prdk): ?>
      <li class="booking-card laporan-pokok-class" data-kategori="<?= $prdk['kategori']; ?>" style="background-image: url(http://<?= BASEURL.'assets/img/'.$prdk['images']; ?>)">
        <div class="book-container">
          
        </div>
        <div class="informations-container">
          <h2 class="title ll"><?= $prdk['nama_produk']; ?></h2>
          <p class="sub-title"><?= $prdk['kategori']; ?></p>
          <p class="price"><svg class="icon" style="width:24px;height:24px" viewBox="0 0 24 24">
        <path fill="currentColor" d="M3,6H21V18H3V6M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M7,8A2,2 0 0,1 5,10V14A2,2 0 0,1 7,16H17A2,2 0 0,1 19,14V10A2,2 0 0,1 17,8H7Z" />
    </svg>12 K</p>
          <div class="more-information">
            <div class="info-and-date-container">
              <div class="box info">
                <svg class="icon" style="width:24px;height:24px" viewBox="0 0 24 24">
          <path fill="currentColor" d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z" />
      </svg>
                <p>Parc des expositions à NANTES</p>
              </div>
              <div class="box date">
                <svg class="icon" style="width:24px;height:24px" viewBox="0 0 24 24">
          <path fill="currentColor" d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z" />
      </svg>
                <p>Samedi 1er février 2020</p>
              </div>
            </div>
            <p class="disclaimer"><?= $prdk['keterangan']; ?></p>
            </div>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
</div>

    <!-- akhir jumbotron -->
  <script src="http://<?= BASEHOST; ?>/public/assets/js/jquery.js"></script>
    <script>
        window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="http://<?= BASEHOST; ?>/public/assets/js/script1.js"></script>
    <script src="http://<?= BASEHOST; ?>/public/assets/js/vendor/popper.min.js"></script>
    <script src="http://<?= BASEHOST; ?>/public/assets/js/bootstrap.min.js"></script>
</body>
</html>