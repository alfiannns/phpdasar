<?php  
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");



function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}



function tambah($data){
	global $conn;
	$nama = htmlspecialchars($data["nama"]);
	$nim = htmlspecialchars($data["nomor"]);
	$email = htmlspecialchars($data["usia"]);
	$jurusan = htmlspecialchars($data["club"]);

	// upload gambar
	$gambar = upload();
	if (!$gambar) {
		return false;
	}


	$query = "INSERT INTO pemain VALUES('', '$nama', '$nomor', '$usia', '$club', '$gambar')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function upload(){

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah ada gambar yang di upload
	if ($error === 4 ) {
		echo "<script>
				alert('Pilih gambar terlebih dahulu!');
			</script>";

		return false;
	}


	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			</script>";
		return false;

	}


	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000) {
		echo "<script>
				alert('Ukuran gambar terlalu besar!');
			</script>";
		return false;
	}

	// lolos pengecekan, gambar siap di upload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar; 

	move_uploaded_file($tmpName, 'img/'. $namaFileBaru);

	return $namaFileBaru;




}







function hapus($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM pemain WHERE id = $id");
	return mysqli_affected_rows($conn);
}


function ubah($data){
	global $conn;

	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$nim = htmlspecialchars($data["nomor"]);
	$email = htmlspecialchars($data["usia"]);
	$jurusan = htmlspecialchars($data["club"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	//cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	}else {
		$gambar = upload();

	}
	

	$query = "UPDATE pemain SET
				nama = '$nama',
				nomor = '$nomor',
				usia = '$usia',
				club = '$club'
				WHERE id = $id
				";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function cari($keyword){
	$query = "SELECT * FROM pemain 
					WHERE 
					nama LIKE '%$keyword%' OR
					nomor LIKE '%$keyword%' OR
					usia LIKE '%$keyword%' OR
					club LIKE '%$keyword%' 
					";

	return query($query);
}



// function registrasi($data){
// 	global $conn;

// 	$username = strtolower(stripcslashes($data["username"]));
// 	$password = mysqli_real_escape_string($conn,$data["password"]);
// 	$password2 = mysqli_real_escape_string($conn,$data["password2"]);


// 	// username sudah ada atau belum
// 	$result = mysqli_query($conn, "SELECT username FROM user WHERE username='$username'");
// 	if (mysqli_fetch_assoc($result)) {
// 		echo "<script>
// 				alert('Username sudah terdaftar!');
// 			</script>";
// 		return false;
// 	}

// 	// cek konfirmasi password
// 	if ($password !== $password2) {
// 		echo "<script>
// 				alert('Konfirmasi password tidak sesuai!');
// 				</script>";

// 		return false;
// 	}

// 	// enkripsi password
// 	$password = password_hash($password, PASSWORD_DEFAULT);


// 	// tambahkan user baru ke database
// 	mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

// 	return mysqli_affected_rows($conn);




	
// }








?>