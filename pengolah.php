<?php
define("TIMEZ", "SET time_zone = '+07:00';");

if($_POST)
{
	if( isset($_FILES["berkas"]) )
	{
		$allowedExts = array("jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["berkas"]["name"]);
		$extension = strtolower(end($temp));
		if ((($_FILES["berkas"]["type"] == "image/jpeg")
		|| ($_FILES["berkas"]["type"] == "image/jpg")
		|| ($_FILES["berkas"]["type"] == "image/pjpeg")
		|| ($_FILES["berkas"]["type"] == "image/x-png")
		|| ($_FILES["berkas"]["type"] == "image/png"))
		&& ($_FILES["berkas"]["size"] < 1024*1024*15)
		&& in_array($extension, $allowedExts)
		&& ($_FILES["berkas"]["error"] < 1))
		{
			$konek = mysqli_connect("mysql.idhostinger.com","u708248129_kita","sampahbanget","u708248129_labs");
			$lap = $_POST["laporan"];
			$lok = $_POST["lokasi"];
			$nam = $_POST["nama"];
			awas_serangan_badak($lap, $lok, $nam);
			$konek->query(TIMEZ);
			$konek->query("INSERT INTO laporan (laporan, lokasi, nama) VALUES('$lap', '$lok', '$nam');");

			$nomor = ($konek->query("SELECT id FROM laporan ORDER BY id DESC LIMIT 1;")->fetch_object()->id);
			$gambar = "data/img/". $nomor.".".$extension;
			$tgambar = "data/img/". $nomor."t.".$extension;

			$konek->query("UPDATE laporan SET gambar = '$gambar' WHERE id=$nomor;");
			$konek->close();
			// gawe gambar thumbnail
			cilikke($_FILES["berkas"]["tmp_name"], $gambar, 720);
			cilikke($gambar, $tgambar, 300);
			die("<script>window.location=''</script>");
		}else
		{
			die("<script>alert('upload gagal. tidak ada gambar yang dikirim. mohon ulangi..'); history.back()</script>");
		}
	}elseif (isset($_POST['base64'])) {
		$konek = new mysqli("mysql.idhostinger.com","u708248129_kita","sampahbanget","u708248129_labs");
		$lap = $_POST["laporan"];
		$lok = $_POST["lokasi"];
		$nam = $_POST["nama"];
		awas_serangan_badak($lap, $lok, $nam);
		$konek->query(TIMEZ);
		$konek->query("INSERT INTO laporan (laporan, lokasi, nama) VALUES('$lap', '$lok', '$nam');");

		$nomor = ($konek->query("SELECT id FROM laporan ORDER BY id DESC LIMIT 1;")->fetch_object()->id);
		$extension = 'jpg';
		$gambar = "data/img/". $nomor.".".$extension;
		$tgambar = "data/img/". $nomor."t.".$extension;

		$konek->query("UPDATE laporan SET gambar = '$gambar' WHERE id=$nomor;");
		$konek->close();
		// gawe gambar thumbnail
		$namagambar = 'data/img/tempe.jpg';
		file_put_contents($namagambar, base64_decode($_POST['base64']));
		cilikke($namagambar, $gambar, 720);
		cilikke($gambar, $tgambar, 300);
		die('laporan berhasil terkirim :)');
	}else
	{
		die('laporan tidak terkirim karena tidak ada gambar');
	}
}

if( isset($_GET["dari"]) )
{
	$sql = new mysqli("mysql.idhostinger.com","u708248129_kita","sampahbanget","u708248129_labs");
	$st = $_GET["dari"]-1;
	$lm = $_GET["sebanyak"];
	$sql->query(TIMEZ);
	if(isset($_GET["sort"])) {
		$newdata = $sql->query("SELECT * FROM laporan ORDER BY vote DESC LIMIT $lm OFFSET $st");
	} else {
		$newdata = $sql->query("SELECT * FROM laporan ORDER BY waktu DESC LIMIT $lm OFFSET $st");
	}
	setlocale (LC_TIME, 'id_ID');
	$json = array();
	while( $x = $newdata->fetch_object() ) array_push($json, array('id'=>$x->id, 'gambar'=>$x->gambar, 'informasi'=>$x->laporan, 'lokasi'=>$x->lokasi, 'nama'=>$x->nama, 'vote'=>$x->vote, 'waktu'=>strftime("%A, %e %B %Y, %H:%M", strtotime($x->waktu)).' WIB'  ));
	$sql->close();
	die(json_encode($json));
}

if( isset($_GET["id"])) {
	$id = $_GET["id"];
	$sql = mysqli_connect("mysql.idhostinger.com","u708248129_kita","sampahbanget","u708248129_labs");
	$newdata = $sql->query("SELECT * FROM laporan WHERE id=$id")->fetch_object()->vote;
	$sql->close();
}

if( isset($_GET["get-data-size"]) ) {
	$sql = mysqli_connect("mysql.idhostinger.com","u708248129_kita","sampahbanget","u708248129_labs");
	$newdata = $sql->query("SELECT * FROM laporan ORDER BY id DESC");
	echo $newdata->num_rows;
	$sql->close();
	die();
}

if( isset($_GET["request-view"])) {
	$id = $_GET["request-view"];
	$sql = mysqli_connect("mysql.idhostinger.com","u708248129_kita","sampahbanget","u708248129_labs");
	$newdata = $sql->query("SELECT vote FROM laporan WHERE id=$id")->fetch_object()->vote;
	$sql->close();
	echo $newdata; die();
}

function cilikke($src, $dest, $new_width) {
	/* read the source image */
	$info = getimagesize($src);
	$mime = $info["mime"];
	if( $mime == 'image/jpeg' ) $source_image = imagecreatefromjpeg($src);
	elseif( $mime == 'image/png' ) $source_image = imagecreatefrompng($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	$new_height = floor($height * ($new_width / $width));
	if($new_width < $width && $new_height < $height)
	{
		$virtual_image = imagecreatetruecolor($new_width, $new_height);	
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		imagejpeg($virtual_image, $dest);
	}else
		copy($src, $dest);
}

#irfan edits
// fetch from database
$sql = mysqli_connect("mysql.idhostinger.com","u708248129_kita","sampahbanget","u708248129_labs");
$sql->query(TIMEZ);
$GLOBALS["kabehdata"] = $sql->query("SELECT * From laporan ORDER BY id DESC");


function daftarkan() {
	setlocale (LC_TIME, 'id_ID');
	while( $x = $GLOBALS["kabehdata"]->fetch_object() ) : ?>
		<li class="sortable">
			<figure>
				<a href="" data-reveal-id=<?php echo $modal_name.$x->id; ?> >
					<div>
						<img src=<?php $pt = strrpos($x->gambar,'.'); echo substr_replace($x->gambar,'t',$pt,0) ?> class="thumbnails">
					</div>
					<figcaption>
						<ul>
							<li><i class="fa fa-map-marker"></i><?php echo $x->lokasi; ?></li>
							<li><i class="fa fa-eye"></i> <span class="voting"><?php echo $x->vote; ?></span> </li>
							<li><i class="fa fa-calendar-o"></i><?php echo strftime("%A, %e %B %Y, %H:%M", strtotime($x->waktu)); ?></li>
							<li class="id"><?php echo $x->id; ?></li>
						</ul>
					</figcaption>
				</a>
			</figure>
		</li>
	<?php endwhile; 
}

function tampilkan_laporan() {
	$sql = mysqli_connect("mysql.idhostinger.com","u708248129_kita","sampahbanget","u708248129_labs");
	$sql->query(TIMEZ);
	$newdata = $sql->query("SELECT * FROM laporan ORDER BY id DESC");

	setlocale (LC_TIME, 'id_ID');
	while( $x = $newdata->fetch_object() ) : ?>
		<div id=<?php echo "\"".$x->id."\"" ?> class="reveal-modal large">
			<div class="large-6 columns">
				<img class="revealed" src="" >
				<p><em>Dilaporkan pada <?php echo strftime("%A, %e %B %Y, %H:%M", strtotime($x->waktu)); ?> WIB.</em></p>
			</div>

			<div class="large-6 columns">
				<h4>Informasi</h4>
				<p><?php echo $x->laporan; ?></p>

				<h4>Lokasi</h4>
				<p><?php echo $x->lokasi; ?></p>

				<h4>Nama Pelapor</h4>
				<p><?php echo $x->nama; ?></p>
			</div>
			<a class="close-reveal-modal">&#215;</a>
		</div>

	<?php endwhile;
}

function awas_serangan_badak(&$aa, &$bb, &$cc)
{
	$aa = htmlspecialchars($aa);
	$bb = htmlspecialchars($bb);
	$cc = htmlspecialchars($cc);

	$aa = str_ireplace("delete", "", $aa);
	$bb = str_ireplace("delete", "", $bb);
	$cc = str_ireplace("delete", "", $cc);
	
	$aa = str_ireplace("insert", "", $aa);
	$bb = str_ireplace("insert", "", $bb);
	$cc = str_ireplace("insert", "", $cc);

	$aa = str_ireplace("select", "", $aa);
	$bb = str_ireplace("select", "", $bb);
	$cc = str_ireplace("select", "", $cc);

	$aa = str_ireplace("update", "", $aa);
	$bb = str_ireplace("update", "", $bb);
	$cc = str_ireplace("update", "", $cc);
}

?>