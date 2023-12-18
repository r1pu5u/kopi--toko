<?php 

$mpdf = new \Mpdf\Mpdf();
$html = 
'<!DOCTYPE html>
<html>
<head>
	<title>Laporan Keuangan</title>
	<link rel="stylesheet" type="text/css" href="http://'.BASEURL.'assets/css/print.css">
</head>
<body>
<h2 align="center">Laporan Penjualan<h2>
<table border="1" cellpadding="10" cellspacing="0" width="100%">
	<thead>
	<tr>
		<th>Laporan</th>
		<th>Nominal</th>
	</tr>
	</thead>
	<tbody>';

$html .= "<tr><td>Modal Awal</td><td>" . rupiah($data['toko']['modal'].'000') ."</td></tr>";
$html .= "<tr><td>Hasil penjualan</td><td>" . rupiah($data['untung']. '000') ."</td></tr>";
$html .= "<tr><td>Pembelian Stok</td><td>" . rupiah($data['keluar']) ."</td></tr>";
$html .= "<tr><td>Laba Bersih</td><td>" . $data['laba'] ."</td></tr>";

$html .= 
'</tbody>
</table><br><br>
<table border="1" cellpadding="10" cellspacing="0" width="100%">
	<thead>
	<tr>
		<th>#</th>
		<th>Nama Produk</th>
		<th>Kategori</th>
		<th>Harga</th>
		<th>Total</th>
		<th>Hasil</th>
	</tr>
	</thead>
	<tbody>';

$i = 1;
foreach ($data['hasil'] as $prdk) {
	$html .= 
	'<tr>
		<td>'.$i.'</td>
		<td>'.$prdk['nama_produk'].'</td>
		<td>'.$prdk['kategori'].'</td>
		<td>'.$prdk['harga'].'</td>
		<td>'.$prdk['totalTerjual'].'</td>
		<td>'.rupiah($prdk['harga'] * $prdk['totalTerjual']. '000').'</td>
	</tr>';
	$i++;
}

$html .= 
'</tbody>
</table>
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output('laporan-penjualan.pdf', 'I');