<?php
if($this->session->userdata('userID')) {
	setlocale (LC_TIME, 'id_ID');
	if(!isset($item)) {
		echo "<p>Ada yang salah dengan halaman ini.</p>";
	} else {
			$id			= $item['id'];
			$gambar		= $item['gambar'];
			$laporan 	= $item['laporan'];
			$lokasi		= $item['lokasi'];
			$latitude	= $item['latitude'];
			$longitude	= $item['longitude'];
			$nama		= $item['nama'];
			$waktu		= $item['waktu'];
			$kategori	= $item['kategori'];
			$vote		= $item['vote'];
			$resolved	= $item['resolved'];

			$status 	= $resolved;
	}

?>
<div class="row">
	<div class="large-6 columns">
		<!-- <img class="foto" src=<?php echo $x->gambar; ?> > -->
		
		<div id="map">
			
		</div>

	</div>
	<div class="large-6 columns">
		<h4>Informasi</h4>
		<p id="laporan"><?php echo $laporan ?></p>

		<h4>Lokasi</h4>
		<p><?php echo $lokasi; ?></p>

		<h4>Nama Pelapor</h4>
		<p><?php echo $nama; ?></p>
		
		<h4>Kategori</h4>
		<p><?php echo $kategori; ?></p>

		<p><em>Dilaporkan pada <?php echo strftime("%A, %e %B %Y, %H:%M", strtotime($waktu)); ?> WIB.</em></p>

		<h4>Status</h4>
		<div class="status">
			<?php
				$color = "#000";
				$ikon_status = "";
				$teks_status = "";
				$fa_icon = "fa-star";
				if($status == 0) {
					$fa_icon = "fa-star-o";
					$color = "#111";
					$ikon_status = "Belimbing putih";
					$teks_status = "Belum masuk dalam daftar pekerjaan.";
				} else
				if($status == 1) {
					$color = "#999";
					$ikon_status = "Belimbing abu-abu";
					$teks_status = "Sudah masuk dalam daftar pekerjaan, pekerjaan belum dimulai.";
				} else
				if($status == 2) {
					$color = "#FFE357";
					$ikon_status = "Belimbing kuning";
					$teks_status = "Sedang dikerjakan dan belum selesai.";
				} else
				if($status == 3) {
					$color = "#FF0A47";
					$ikon_status = "Belimbing merah";
					$teks_status = "Pernah dikerjakan dan statusnya terbengkalai.";
				} else
				if($status == 4) {
					$color = "#2FCC24";
					$ikon_status = "Belimbing hijau";
					$teks_status = "Pekerjaan telah selesai. :)";
				}
			?>
			<i class="fa <?php echo $fa_icon;?> status-icon" style="color:<?php echo $color;?>;" title="<?php echo $ikon_status; ?>">

			</i>
			<p class="teks-status"><?php echo $teks_status;?></p>
		</div>
		<p id="latitude"><?php echo $latitude; ?></p>
		<p id="longitude"><?php echo $longitude; ?></p>
	</div>
</div>
<?php
}
?>