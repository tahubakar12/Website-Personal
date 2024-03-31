<?php

	//koneksi database

	//identitas sarver
	$server 	= "localhost"; //Nama server
	$user		= "root"; //username database server
	$pass		= ""; //password database server
	$database 	= "arsipdokumen"; //Nama Database
	
	//koneksi database
	$koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));
	
	
?>