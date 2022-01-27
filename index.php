<?php 
session_start();
// if (!$_SESSION["login"]) {
// 	header("Location: login.php");
// 	exit;
// }

require 'function.php';
$players = query("SELECT * FROM  pemain");

// tombol cari ditekan
if (isset($_POST["cari"])) {
	$players = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Halaman Admin</title>

	<style>
		.loader{
			width: 100px;
			position: absolute;
			top: 125px;
			left: 220px;
			z-index: -1;
			display: none;
			
		}
	</style>


	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/script.js"></script>

</head>
<body>

<a href="logout.php">Logout</a>


<h1>Daftar Pemain Bola</h1>

<a href="tambah.php">Tambah Data Pemain</a>
<br></br>

<form action="" method="POST">
	
	<input type="text" name="keyword" size="30" autofocus="" placeholder="masukkan keyword pencarian" autocomplete="off" id="keyword">
	<button type="submit" name="cari" id="tombol-cari">Cari</button>


	<img src="img/loader.gif" class="loader">

</form>
<br>
<div id="container">
<table border="1" cellpadding="10" cellspacing="0">
	<tr>
		<th>No.</th>
		<th>Aksi</th>
		<th>Gambar</th>
		<th>Nama</th>
		<th>Nomor</th>
		<th>Usia</th>
		<th>Club</th>
	</tr>

	<?php $i = 1; ?>
	<?php foreach( $players as $row ) : ?>
	<tr>
		<td><?= $i; ?></td>
		<td>
			<a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> ||
			<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?');">Hapus</a>
		</td>
		<td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
		<td><?= $row["nama"]; ?></td>
		<td><?= $row["nomor"]; ?></td>
		<td><?= $row["usia"]; ?></td>
		<td><?= $row["club"]; ?></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>


</table>
</div>

</body>
</html>