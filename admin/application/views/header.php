<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Facilicare Dashboard</title>
	<link rel="stylesheet" href="<?=base_url()?>css/foundation.min.css">
	<link rel="stylesheet" href="<?=base_url()?>css/style.css">
</head>
<body>
	<header>
		<div class="row">
			<div class="large-6 columns">
				<h1 class="title"><a href="">Facilicare Depok</a></h1>
			</div>
			<div class="large-6 columns">
				<div class="large-12 small-12 small-centered large-centered columns">
					<nav>
						<ul class="navigasi">
							<li><a href="">Pendapa</a></li>
							<li><a href="">Laporkan</a></li>
							<li><a href="" class="active">Lihat Daftar</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="large-12">
				<div class="login-info">
					<?php
					if($this->session->userdata('userID')) { ?>
						<p>You are logged in, <?=$this->session->userdata('username')?>!</p>
						<p><a href="<?=base_url()?>users/logout">Logout</a></p>
					<?php } else { ?>
						<p><a href="<?=base_url()?>users/login">Login</a></p>
					<?php } ?>
				</div>
			</div>
		</div>
	</header>
