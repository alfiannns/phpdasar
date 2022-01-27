<?php 
// session_start();
// if (!$_SESSION["login"]) {
// 	header("Location: login.php");
// 	exit;
// } 

require 'function.php';

// ambil data di url
$id = $_GET["id"];
//query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM pemain WHERE id = $id")[0];



// cek apakah tombol submit sudah ditekan  atau belum
if(isset($_POST["submit"])){
	
	// cek apakah data berhasil diubah atau tidak
	if (ubah($_POST)>0) {
		echo "
		<script>
			alert('Data Berhasil Diubah');
			document.location.href = 'index.php';
		</script>

		";
	}else{
		echo "
		<script>
			alert('Data Gagal Diubah');
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
	<title>Ubah Data Pemain</title>
</head>
<body>

	<h1>Ubah Data Pemain</h1>


	<form action="" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
		<input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
		<ul>
			<li>
				<label for="nama">Nama :</label>
				<input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>">
			</li>
			<li>
				<label for="nomor">Nomor :</label>
				<input type="text" name="nomor" id="nomor" required value="<?= $mhs["nomor"]; ?>">
			</li>
			<li>
				<label for="usia">Usia :</label>
				<input type="text" name="usia" id="usia" required value="<?= $mhs["usia"]; ?>">
			</li>
			<li>
				<label for="club">Club :</label>
				<input type="text" name="club" id="club" required value="<?= $mhs["club"]; ?>">
			</li>
			<li>
				<label for="gambar">Gambar :</label><br>
				<img src="img/<?= $mhs['gambar']; ?>" width="50"><br>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="submit">Ubah Data</button>
			</li>
		</ul>



	</form>



</body>
</html>