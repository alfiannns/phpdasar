<?php
// session_start();
// if (!$_SESSION["login"]) {
// 	header("Location: login.php");
// 	exit;
// } 

require 'function.php';

// cek apakah tombol submit sudah ditekan  atau belum
if(isset($_POST["submit"])){

	
	// cek apakah data berhasil ditambahkan atau tidak
	if (tambah($_POST)>0) {
		echo "
		<script>
			alert('Data Berhasil Ditambahkan');
			document.location.href = 'index.php';
		</script>

		";
	}else{
		echo "
		<script>
			alert('Data Gagal Ditambahkan');
			document.location.href = 'index.php';
		</script>
		";
	}
	
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tambah Data Pemain</title>
</head>
<body>

	<h1>Tambah Pemain</h1>


	<form action="" method="POST" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="nama">Nama :</label>
				<input type="text" name="nama" id="nama" required>
			</li>
			<li>
				<label for="nomor">Nomor :</label>
				<input type="text" name="nomor" id="nomor" required>
			</li>
			<li>
				<label for="usia">Usia :</label>
				<input type="text" name="usia" id="usia" required>
			</li>
			<li>
				<label for="club">Club :</label>
				<input type="text" name="club" id="club" required>
			</li>
			<li>
				<label for="gambar">Gambar :</label>
				<input type="file" name="gambar" id="gambar" required>
			</li>
			<li>
				<button type="submit" name="submit">Tambah Data</button>
			</li>
		</ul>



	</form>



</body>
</html>