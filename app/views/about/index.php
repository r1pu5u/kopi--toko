<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <title>Starter Template for Bootstrap</title>
    <!-- icon -->
    <link rel="stylesheet" type="text/css" href="http://<?= BASEHOST; ?>/public/assets/css/flaticon.css">

    <!-- Bootstrap core CSS -->
    <link href="http://<?= BASEHOST; ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://<?= BASEHOST; ?>/public/assets/css/style.css" rel="stylesheet">

</head>

<body>

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
      </div>
    </nav>
    <!-- akhir navbar -->

    <!-- mulai jumbotron -->
    <div class="jumbotron jumbotron-fluid" style="background-image: url(http://<?= BASEURL.'assets/img/'.$data['utility']['bacground_jumbotron']; ?>);">
        <div class="container">
            <h1 class="display-4"><?= $data['utility']['title_jubotron']; ?></h1>
        </div>
    </div>

    <div class="container about">
        <div class="row working-space">
            <div class="col-7 about-1">
                <h3>about</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita dignissimos nesciunt dicta natus tenetur veniam placeat corporis dolorum optio reiciendis, pariatur repellat libero quisquam laboriosam totam quaerat! Repellat, nemo minima? Lorem ipsum
                    dolor sit amet consectetur adipisicing elit. Adipisci consectetur illo cum? Laudantium eius architecto porro, esse, molestias quasi minima repellendus neque possimus, tempora saepe repudiandae sequi mollitia voluptate labore!
                </p>
            </div>
            <div class="col-5 about-2">
                <div class="jarak"></div>
            </div>
            <div class="col-5 about-3">
                <div class="jarak"></div>
            </div>
            <div class="col-7 about-4">
                <h3>visi</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita dignissimos nesciunt dicta natus tenetur veniam placeat corporis dolorum optio reiciendis, pariatur repellat libero quisquam laboriosam totam quaerat! Repellat, nemo minima? Lorem ipsum
                    dolor sit amet consectetur adipisicing elit. Adipisci consectetur illo cum? Laudantium eius architecto porro, esse, molestias quasi minima repellendus neque possimus, tempora saepe repudiandae sequi mollitia voluptate labore!
                </p>
            </div>
            <div class="col-7 about-5">
                <h3>misi</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita dignissimos nesciunt dicta natus tenetur veniam placeat corporis dolorum optio reiciendis, pariatur repellat libero quisquam laboriosam totam quaerat! Repellat, nemo minima? Lorem ipsum
                    dolor sit amet consectetur adipisicing elit. Adipisci consectetur illo cum? Laudantium eius architecto porro, esse, molestias quasi minima repellendus neque possimus, tempora saepe repudiandae sequi mollitia voluptate labore!
                </p>
            </div>
            <div class="col-5 about-7">
                <div class="jarak"></div>
            </div>

        </div>
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