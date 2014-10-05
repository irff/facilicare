
<div class="row">
	<div class="large-12 columns">
		<?php if($success==1) { ?>
			<p><em>This post has been updated!</em></p>
		<?php } ?>
		<form action="<?=base_url()?>lapor/editlaporan/<?=$item['id']?>" method="post" id="form-laporan">
			<label for="info">Informasi</label>
			<textarea name="laporan" id="laporan"><?=$item['laporan']?></textarea>

			<label for="lokasi">Lokasi</label>
			<input type="text" name="lokasi" id="lokasi" value="<?=$item['lokasi']?>">
			
			<label for="nama">Nama Pelapor</label>
			<input type="text" name="nama" id="nama" value="<?=$item['nama']?>">
			
			<label for="kategori">Kategori</label>
			<input type="text" name="kategori" id="kategori" value="<?=$item['kategori']?>">
			
			<label for="resolved">Status</label>
			<input type="text" name="resolved" id="resolved" value="<?=$item['resolved']?>">
			<label for="edit">Edit post</label>
			<input type="submit" value="Edit Post" class="expand button" id="edit">
		</form>		
	</div>
</div>
