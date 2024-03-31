

<div class="card mt-3">
  <div class="card-header bg-info text-white ">
    Data Arsip
  </div>
  <div class="card-body">
	<a href="?halaman=arsip&hal=tambahdata" class="btn btn-info text-white mb-3" >Tambah Data</a>
		<table class="table table-borderd table-hovered tabel-striped">
			<tr>
				<th>No</th>
				<th>No Document</th>
				<th>Tanggal Dikirim</th>
				<th>Tanggal Diterima</th>
				<th>Perihal</th>
				<th>Pengirim</th>
				<th>No HP</th>
				<th>File</th>
				<th>Aksi</th>
			</tr>
			<?php
				$tampil = mysqli_query($koneksi, "
							SELECT 
								tbl_arsip.*,
								tbl_pengirim_document.nama_pengirim_document, tbl_pengirim_document.no_hp
							FROM
								tbl_arsip, tbl_pengirim_document
							WHERE
								tbl_arsip.id_pengirim = tbl_pengirim_document.id_pengirim_document
							
							");
				$no = 1;
				while($data =mysqli_fetch_array($tampil)) :
				
			?>
			<tr>
				<td><?=$no++?></td>
				<td><?=$data['no_document']?></td>
				<td><?=$data['tanggal_dikirim']?></td>
				<td><?=$data['tanggal_diterima']?></td>
				<td><?=$data['perihal']?></td>
				<td><?=$data['nama_pengirim_document']?></td>
				<td><?=$data['no_hp']?></td>
				<td>
					<?php
						//uji apakah file ada atau tidak
						if(empty($data['file'])){
							echo "";
						}else
					?>
						<a href="file/<?=$data['file']?>" target="$_blank"> Lihat File </a>
					<?php
					
					?>
				</td>
				<td>
					<a href="?halaman=arsip&hal=edit&id=<?=$data['id_arsip']?>" class="btn btn-success" >Edit </a>
					<a href="?halaman=arsip&hal=hapus&id=<?=$data['id_arsip']?>" class="btn btn-danger" 
						onclick="return confirm('Apakah yakin ingin menghapus data ini?')" >Hapus </a>
				</td>
			</tr>
		<?php endwhile; ?>
		</table>
			
  </div>
</div>