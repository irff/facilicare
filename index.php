<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>Facilicare Beta</title>

	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="icon-fonts/css/font-awesome.min.css">
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
					<li><a href="" class="active">Pendapa</a></li>
					<li><a href="laporkan.php">Laporkan</a></li>
					<li><a href="daftar.php">Lihat Daftar</a></li>
				</ul>
				<ul class="navigasi-mobile">
					<li><a href="" class="active" title="Pendapa"><i class="fa fa-home fa-2x"></i></a></li>
					<li><a href="laporkan.php" title="Laporkan"><i class="fa fa-cloud-upload fa-2x"></i></a></li>
					<li><a href="daftar.php" title="Lihat Daftar Laporan"><i class="fa fa-file-text-o fa-2x"></i></a></li>
				</ul>
			</nav>
		</div>
	</div>

	<div class="row">
		<div class="large-12 columns">
			<hr>
		</div>
	</div>

	<div class="row main-menu">
		<div class="large-6 columns centered">
			<a href="laporkan.php" class="large button expand">Laporkan Kerusakan</a>
		</div>
		<div class="large-6 columns centered">
			<a href="daftar.php" class="large button expand">Lihat Daftar Kerusakan</a>
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