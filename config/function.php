<?php

//persiapan function untuk upload file/gambar
function upload()
{
	//deklarasi variabel kebutuhan
	$namafile = $_FILES['file']['name'];
	$ukuranfile = $_FILES['file']['size'];
	$error = $_FILES['file']['error'];
	$tmpname = $_FILES['file']['tmp_name'];
	
	
	//cek apakah yang diupload file/gambar
	$eksfilevalid = ['jpg', 'jpeg', 'png', 'pdf', 'word', 'doc', 'docx'];
	$eksfile = explode('.', $namafile);
	$eksfile = strtolower(end($eksfile));
	
	if(!in_array($eksfile, $eksfilevalid)){
		echo "<script> alert('Upload bukan File/Gambar..!') </script>";
		return false;
	}
	
	//cek jika ukuran file terlalu besar
	if($ukuranfile > 1000000){
		echo "<script> alert('Ukuran file terlalu besar..!') </script>";
		return false;
	}
	
	//Jika lolos pengecekan, file siap diopload
	//generate nama file baru
	
	$namafilebaru = uniqid();
	$namafilebaru .= '.';
	$namafilebaru .= $eksfile;
	
	move_uploaded_file($tmpname, 'file/'.$namafilebaru);
	return $namafilebaru;
	
}


?>