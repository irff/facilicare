<?php
if($this->session->userdata('userID')) {

	if(!isset($laporans)) {
		?>
			<p>Tidak ada laporan.</p>
		<?php
	} else {
		$no = $start + 1;
	?>
			<div class="row">
				<div class="large-12">
					<table>
						<thead>
							<tr>
								<td>No.</td>
								<td width="300">Laporan</td>
								<td width="120">Lokasi</td>
								<td width="120">Nama Pelapor</td>
								<td width="100">Waktu</td>
								<td width="100">Kategori</td>
								<td width="20">Status</td>
								<td>Aksi</td>
							</tr>
						</thead>
						<tbody>
	<?php
		foreach($laporans as $row) {
			$id			= $row['id'];
			$gambar		= $row['gambar'];
			$laporan 	= $row['laporan'];
			$lokasi		= $row['lokasi'];
			$latitude	= $row['latitude'];
			$longitude	= $row['longitude'];
			$nama		= $row['nama'];
			$waktu		= $row['waktu'];
			$kategori	= $row['kategori'];
			$vote		= $row['vote'];
			$resolved	= $row['resolved'];

			?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo substr($laporan, 0, 75)."..."; ?></td>
					<td><?php echo $lokasi; ?></td>
					<td><?php echo $nama; ?></td>
					<td><?php echo $waktu; ?></td>
					<td><?php echo $kategori; ?></td>
					<td><?php echo $resolved; ?></td>
					<td>
						<a href="<?=base_url()?>lapor/laporan/<?=$id?>">Lihat</a> | 
						<a href="<?=base_url()?>lapor/editlaporan/<?=$id?>">Edit</a> | 
						<a href="<?=base_url()?>lapor/deletelaporan/<?=$id?>">Hapus</a>
					</td>
				</tr>
			<?php
		}
	?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="pagination">
				<?=$pages?>
			</div>
	<?php
	}
}