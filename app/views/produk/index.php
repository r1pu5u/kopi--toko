<!DOCTYPE html>
<html>
<head>
	<title>produk</title>
</head>
<body>
	<h1>produk</h1>

	<?php foreach($data['prdk'] as $prdk) : ?>
		<ul>
			<li><?= $prdk['nama_produk']; ?></li>
			<li><?= $prdk['kategori']; ?></li>
			<li><?= $prdk['keterangan']; ?></li>
		</ul>
	<?php endforeach ?>
</body>
</html>