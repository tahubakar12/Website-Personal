<?php

	//uji jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		
		//penujian apakah data akan diedit
		if(@$_GET['hal'] == "edit"){
			//perintah edit data
			//ubah data 
				$ubah = mysqli_query($koneksi, "UPDATE tbl_pengirim_document SET 
																	nama_pengirim = '$_POST[nama_pengirim_document]',
																	alamat = '$_POST[alamat]',
																	no_hp = '$_POST[no_hp]',
																	email = '$_POST[email]'
																	where id_pengirim_document = '$_GET[id]' ");
				if($ubah)
					
				{
					echo "<script>
							alert('Ubah Data Sukses');
							document.location='?halaman=pengirim';
						</script>";
				}
				else
				{
					echo "<script>
							alert('Ubah Data Gagal');
							document.location='?halaman=pengirim';
						</script>";
				}
		}
		
		else
		{
				//perintah simpan data baru
				//simpan data 
				$simpan = mysqli_query($koneksi, "INSERT INTO tbl_pengirim_document VALUES ('', '$_POST[nama_pengirim_document]', 
																						'$_POST[alamat]', 
																						'$_POST[no_hp]', 
																						'$_POST[email]') ");
				if($simpan)
				{
					echo "<script>
							alert('Simpan Data Sukses');
							document.location='?halaman=pengirim';
						</script>";
				}else
				{
					echo "<script>
							alert('Simpan Data Gagal');
							document.location='?halaman=pengirim';
						</script>";
				}
		}	
	
	}

	//Uji tombol edit/hapus
	if(isset($_GET['hal']))
	{
		
		if($_GET['hal'] == "edit")
		{ 
				//tampilkan data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pengirim_document where id_pengirim='$_GET[id]'");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//jika data ditemukan 
				$vnama_pengirim = $data['nama_pengirim_document'];
				$valamat = $data['alamat'];
				$vno_hp = $data['no_hp'];
				$vemail = $data['email'];
			}
		}else{
				$hapus = mysqli_query($koneksi, "DELETE FROM tbl_pengirim_document WHERE id_pengirim_document='$_GET[id]'");
				if($hapus){
					echo "<script>
							alert('Hapus Data Sukses');
							document.location='?halaman=pengirim';
						</script>";
				}
		}
	}

?>



<div class="card mt-3">
  <div class="card-header bg-info text-white ">
    From Data Pengirim
  </div>
  <div class="card-body">
		<form method="post" action="">
	  <div class="form-group">
		<label for="nama_pengirim_document" class="form-label">Nama Pengirim</label>
		<input type="text" class="form-control" id="nama_pengirim_document" name="nama_pengirim_document" value="<?=@$vnama_pengirim_document?>">
	  </div>
	   <div class="form-group">
		<label for="alamat" class="form-label">Alamat</label>
		<input type="text" class="form-control" id="alamat" name="alamat" value="<?=@$valamat?>">
	  </div>
	   <div class="form-group">
		<label for="no_hp" class="form-label">No HP</label>
		<input type="text" class="form-control" id="no_hp" name="no_hp" value="<?=@$vno_hp?>">
	  </div>
	   <div class="form-group mb-2">
		<label for="email" class="form-label">Email</label>
		<input type="email" class="form-control" id="email" name="email" value="<?=@$vemail?>">
	  </div>
	  <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
	  <button type="reset" name="bbatal" class="btn btn-danger">Batal</button>
	</form>
  </div>
</div>

<div class="card mt-3">
  <div class="card-header bg-info text-white ">
    Data Pengirim
  </div>
  <div class="card-body">
		<table class="table table-borderd table-hovered tabel-striped">
			<tr>
				<th>No</th>
				<th>Nama Pengirim</th>
				<th>Alamat</th>
				<th>No HP</th>
				<th>Email</th>
				<th>Aksi</th>
			</tr>
			<?php
				$tampil = mysqli_query($koneksi, "SELECT * from tbl_pengirim_document order by id_pengirim_document desc");
				$no = 1;
				while($data =mysqli_fetch_array($tampil)) :
				
			?>
			<tr>
				<td><?=$no++?></td>
				<td><?=$data['nama_pengirim_document']?></td>
				<td><?=$data['alamat']?></td>
				<td><?=$data['no_hp']?></td>
				<td><?=$data['email']?></td>
				<td>
					<a href="?halaman=pengirim&hal=edit&id=<?=$data['id_pengirim_document']?>" class="btn btn-success" >Edit </a>
					<a href="?halaman=pengirim&hal=hapus&id=<?=$data['id_pengirim_document']?>" class="btn btn-danger" 
						onclick="return confirm('Apakah yakin ingin menghapus data ini?')" >Hapus </a>
				</td>
			</tr>
		<?php endwhile; ?>
		</table>
			
  </div>
</div>