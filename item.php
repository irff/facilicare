<?php include 'pengolah.php'; ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>Facilicare Beta | Daftar Kerusakan</title>

	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/style.css"> 
	<link rel="stylesheet" href="icon-fonts/css/font-awesome.min.css">
	<script src="js/vendor/custom.modernizr.js"></script>
</head>
<body>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div class="row">
		<div class="large-4 columns">
			<h1 class="title"><a href="index.php">Facilicare</a></h1>
		</div>
		<div class="large-8 columns">
			<div class="large-12 small-12 small-centered large-centered columns">
				<nav>
					<ul class="navigasi">
						<li><a href="index.php">Pendapa</a></li>
						<li><a href="laporkan.php">Laporkan</a></li>
						<li><a href="daftar.php" class="active">Lihat Daftar</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="large-12 columns">
			<hr>
		</div>
	</div>

	<div class="row">
		<?php single(); ?>
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
	<script src="js/jquery.tinysort.min.js"></script>
	<script src="js/jquery.magicmove.js"></script>
	<script>


		$(document).foundation();

	</script>
</body>
</html>
