<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>Facilicare Beta | Laporkan Kerusakan</title>

	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/vendor/custom.modernizr.js"></script>
</head>

<body>
	<div class="row">
		<div class="large-4 columns">
			<h1 class="title"><a href="index.php">Facilicare</a></h1>
		</div>
		<div class="large-8 columns">
			<nav>
				<ul class="navigasi">
					<li><a href="index.php">Pendapa</a></li>
					<li><a href="" class="active">Laporkan</a></li>
					<li><a href="daftar.php">Lihat Daftar</a></li>
				</ul>
			</nav>
		</div>
	</div>

	<div class="row">
		<div class="large-12 columns">
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
			<div class="row">
				<div class="large-12 columns">
				<form action="daftar.php" method="post" enctype="multipart/form-data" id="form-laporan">
					<label for="pilih-foto">Upload Foto</label>
					<input type="file" class="expand panel" id="pilih-foto" name="berkas">

					<label for="info">Informasi</label>
					<textarea name="laporan" id="laporan" placeholder="Informasi tentang kerusakan"></textarea>

					<label for="lokasi">Lokasi</label>
					<input type="text" name="lokasi" id="lokasi" placeholder="Lokasi kerusakan">
					
					<label for="nama">Nama Pelapor</label>
					<input type="text" name="nama" id="nama" placeholder="Nama pelapor">
					
					<label for="laporkan">Laporkan</label>
					<input type="submit" value="Laporkan" class="expand button" id="laporkan">
				</form>
				</div>
			</div>
		</div>
		<div class="large-6 columns">
			<p>Laporkan kerusakan fasilitas umum di sekitar anda. Laporan anda akan sangat berguna bagi kepentingan bersama dan pemerintah dapat segera memperbaikinya.</p>

			<p>Kerusakan yang anda laporkan akan kami simpan di database server kami. Pemerintah dan masyarakat umum dapat dengan bebas mengakses foto dan informasi kerusakan yang anda laporkan.</p>
		</div>
	</div>
	<div class="row footer">
		<div class="large-12 columns">
			<hr>
			<p>Copyright &copy; Project Laporkan Fasilitas Umum. <br>By Coder Hutan Studio</p>
		</div>
	</div>
	<!--<script>
	document.write('<script src=' + ('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') + '.js><\/script>')
	</script>-->
	<script src="js/vendor/jquery.js"></script>
	<script src="js/foundation.min.js"></script>

	<script>
		$(document).foundation();
	</script>
</body>
</html>
