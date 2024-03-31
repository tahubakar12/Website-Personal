<?php
session_start();
include "config/koneksi.php";

//password diamankan dengan enskripsi kriptografi md5
@$pass = md5($_POST['password']);

//mysqli_escape_string fungsinya mengamankan karakter aneh yang diinputkan user

@$email = mysqli_escape_string($koneksi, $_POST['email']);
@$password = mysqli_escape_string($koneksi, $pass);

$login = mysqli_query($koneksi, "SELECT * from tbl_user WHERE email='$email' and password = '$password' ");

$data = mysqli_fetch_array($login);
if($data)
{
	$_SESSION['id_user'] = $data['id_user'];
	$_SESSION['email'] = $data['email'];
	header('location:admin.php');
}
else
{
	echo "<script>
		alert('Maaf, Login GAGAL, pastikan email dan password anda Benar..!');
		document.location='index.php';
		</script>";
}


?>