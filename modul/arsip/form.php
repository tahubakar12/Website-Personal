<?php
	//panggil function.php untuk upload File
	include "config/function.php";

//Uji klik tombol edit/hapus
	if(isset($_GET['hal']))
	{
		
		if($_GET['hal'] == "edit")
		{ 
				//tampilkan data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT 
								tbl_arsip.*,
								tbl_pengirim_document.nama_pengirim_document, 
								tbl_pengirim_document.no_hp
							FROM
								tbl_arsip, tbl_pengirim_document
							WHERE
								tbl_arsip.id_pengirim = tbl_pengirim_document.id_pengirim_document 
								and tbl_arsip.id_arsip='$_GET[id]'");
								
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//jika data ditemukan 
				$vno_document = $data['no_document'];
				$vtanggal_dikirim = $data['tanggal_dikirim'];
				$vtanggal_diterima = $data['tanggal_diterima'];
				$vperihal = $data['perihal'];
				$vid_pengirim = $data['id_pengirim'];
				$vnama_pengirim_document = $data['nama_pengirim_document'];
				$vfile = $data['file'];
			}
		}
		elseif($_GET['hal'] == 'hapus')
		{
			$hapus = mysqli_query($koneksi, "DELETE FROM tbl_arsip WHERE id_arsip='$_GET[id]'");
				if($hapus){
					echo "<script>
							alert('Hapus Data Sukses');
							document.location='?halaman=arsip';
						</script>";
		}
	}
	}

	//uji jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		
		//penujian apakah data akan diedit
		if(@$_GET['hal'] == "edit"){
			//perintah edit data
			//ubah data 
			
			//cek apakah user pilih file/gambar atau tidak
				if($_FILES['file']['error'] === 4){
					$file = $vfile;
				}else{
					$file = upload();
				}
				
				$ubah = mysqli_query($koneksi, "UPDATE tbl_arsip SET 
																	no_document 		= '$_POST[no_document]',
																	tanggal_dikirim	 	= '$_POST[tanggal_dikirim]',
																	tanggal_diterima 	= '$_POST[tanggal_diterima]',
																	perihal 			= '$_POST[perihal]',
																	id_pengirim 		= '$_POST[id_pengirim]',
																	file 				= '$file'
																	where id_arsip 		= '$_GET[id]' ");
				if($ubah)
					
				{
					echo "<script>
							alert('Ubah Data Sukses');
							document.location='?halaman=arsip';
						</script>";
				}
				else
				{
					echo "<script>
							alert('Ubah Data Gagal');
							document.location='?halaman=arsip';
						</script>";
				}
		}
		
		else
		{
				//perintah simpan data baru
				//simpan data 
				$file = upload();
				$simpan = mysqli_query($koneksi, "INSERT INTO tbl_arsip VALUES ('', '$_POST[no_document]', 
																						'$_POST[tanggal_dikirim]', 
																						'$_POST[tanggal_diterima]', 
																						'$_POST[perihal]',
																						'$_POST[id_pengirim]',
																						'$file' )	");
				if($simpan)
				{
					echo "<script>
							alert('Simpan Data Sukses');
							document.location='?halaman=arsip';
						</script>";
				}else
				{
					echo "<script>
							alert('Simpan Data Gagal');
							document.location='?halaman=arsip';
						</script>";
				}
		}	
	
	}

	

?>



<div class="card mt-3">
  <div class="card-header bg-info text-white ">
    From Data Arsip Dokumen
  </div>
  <div class="card-body">
		<form method="post" action="" enctype="multipart/form-data" >
	  <div class="form-group">
		<label for="no_document" class="form-label">No Document</label>
		<input type="text" class="form-control" id="no_document" name="no_document" value="<?=@$vno_document?>">
	  </div>
	   <div class="form-group">
		<label for="tanggal_dikirim" class="form-label">Tanggal Dikirim</label>
		<input type="date" class="form-control" id="tanggal_dikirim" name="tanggal_dikirim" value="<?=@$vtanggal_dikirim?>">
	  </div>
	  <div class="form-group">
		<label for="tanggal_diterima" class="form-label">Tanggal Diterima</label>
		<input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" value="<?=@$vtanggal_diterima?>">
	  </div>
	   <div class="form-group">
		<label for="perihal" class="form-label">Perihal</label>
		<input type="text" class="form-control" id="perihal" name="perihal" value="<?=@$vperihal?>">
	  </div>
	  
	  <div class="form-group">
		<label for="id_pengirim">Pengirim Document</label>
		<select class="form-control" name="id_pengirim"> 
			<option value="<?=@$vid_pengirim?>"><?=@$vnama_pengirim_document?></option>
			<?php
				$tampil = mysqli_query($koneksi, "SELECT * from tbl_pengirim_document order by nama_pengirim_document asc");
				while($data = mysqli_fetch_array($tampil)){
					echo "<option value = '$data[id_pengirim_document]'> $data[nama_pengirim_document]
						</option> ";
				}
				
			?>
		</select>
	  </div>
	  
	   <div class="form-group mb-2">
		<label for="file" class="form-label">File</label>
		<input type="file" class="form-control" id="file" name="file" value="<?=@$vfile?>">
	  </div>
	  <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
	  <button type="reset" name="bbatal" class="btn btn-danger">Batal</button>
	</form>
  </div>
</div>