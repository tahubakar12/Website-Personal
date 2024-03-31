<?php

	@$halaman = $_GET['halaman'];
	
	if($halaman == "pengirim")
	{
		//tampilkan Halaman pengirim
		//echo "Tampil Halaman Modul Pengirim";
		include "modul/pengirim/pengirim.php";
	}		
	elseif($halaman == "arsip")
	{
		//tampilkan halaman surat
		if(@$_GET['hal'] == "tambahdata" || @$_GET['hal'] == "edit" || @$_GET['hal'] == "hapus"){
			include "modul/arsip/form.php";
		}else{
			include "modul/arsip/data.php";
		}
	}
	else
	{
		//echo "Tampil Halaman Home";
		include "modul/home.php";
	}
		
?>