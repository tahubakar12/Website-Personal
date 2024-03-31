<?php
session_start();
//mengatasi jika user langsung masuk menggunkan link, tanpa login
if(empty($_SESSION['id_user']) or empty($_SESSION['email']))
{
	echo "<script>
		alert('Maaf, silahkan Login terlebih dahulu..!');
		document.location='index.php';
		</script>";
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <title> Arsip Document </title>
  </head>
  <body>
	<!--Awal Nav / Menu-->
	  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	  <div class="container">
		<a class="navbar-brand" href="?">ArsipDocument</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		  <li class="nav-item active">
			<a class="nav-link" href="?">Beranda <span class="sr-only"></span></a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="?halaman=pengirim">Data Pengirim</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="?halaman=arsip">Data Arsip</a>
		  </li>
		
		  
		</ul>

	  </div>
		

	</nav>
	<!-- Akhir Nav / Menu-->
	<!-- Awal Container	-->
	<div class="container">