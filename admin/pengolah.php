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
			$lat = $_POST["latitude"];
			$lon = $_POST["longitude"];
			$nam = $_POST["nama"];
			$kat = $_POST["kategori"];
			awas_serangan_badak($lap, $lok, $lat, $lon, $nam, $kat);

			$konek->query(TIMEZ);
			$konek->query("INSERT INTO laporan (laporan, lokasi, latitude, longitude, nama, kategori) VALUES('$lap', '$lok', '$lat', '$lon', '$nam', '$kat');");
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
			die("<script>alert('Upload gagal karena tidak ada gambar yang dikirim. Mohon ulangi.'); history.back()</script>");
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

function get_meta() {
	setlocale (LC_TIME, 'id_ID');
	if( isset($_GET["id"])) {
		$id = $_GET["id"];
		$sql = mysqli_connect("mysql.idhostinger.com","u708248129_kita","sampahbanget","u708248129_labs");
		$newdata = $sql->query("SELECT * FROM laporan WHERE id=$id");
		$sql->close();

		$x = $newdata->fetch_object();
		?>
	<meta property="og:title" content="Facilicare Depok | Rincian Kerusakan" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content=<?php echo "\"http://www.facilicare.org/item.php?id=".$x->id."\""; ?> />
	<meta property="og:image" content=<?php $pt = strrpos($x->gambar,'.'); echo "\"".substr_replace($x->gambar,'t',$pt,0)."\""; ?> />
	<meta property="og:description" content=<?php echo "\"".$x->laporan." ".$x->lokasi."\"";?> />
		<?php
	}
}


function daftarkan() {
	setlocale (LC_TIME, 'id_ID');
	while( $x = $GLOBALS["kabehdata"]->fetch_object() ) : ?>
		<li class="sortable"
>			<figure>
				<a href="<?php echo "http://www.facilicare.org/item.php?id=".$x->id; ?>">
					<div>
						<img src=<?php $pt = strrpos($x->gambar,'.'); echo substr_replace($x->gambar,'t',$pt,0) ?> class="thumbnails">
					</div>
					<figcaption>
						<ul>
							<li><i class="fa fa-map-marker"></i><?php echo $x->lokasi; ?></li>
							<li><i class="fa fa-eye"></i> <span class="voting"><?php echo $x->vote; ?></span> </li>
							<li><i class="fa fa-calendar-o"></i><?php echo strftime("%A, %e %B %Y, %H:%M", strtotime($x->waktu)); ?></li>
							<li class="id" hidden><?php echo $x->id; ?></li>
						</ul>
					</figcaption>
				</a>
			</figure>
		</li>
	<?php endwhile; 
}

function awas_serangan_badak(&$aa, &$bb, &$cc, &$dd, &$ee, &$ff)
{
	$aa = htmlspecialchars($aa);
	$bb = htmlspecialchars($bb);
	$cc = htmlspecialchars($cc);
	$dd = htmlspecialchars($dd);
	$ee = htmlspecialchars($ee);
	$ff = htmlspecialchars($ff);

	$aa = str_ireplace("delete", "", $aa);
	$bb = str_ireplace("delete", "", $bb);
	$cc = str_ireplace("delete", "", $cc);
	$dd = str_ireplace("delete", "", $dd);
	$ee = str_ireplace("delete", "", $ee);
	$ff = str_ireplace("delete", "", $ff);
	
	$aa = str_ireplace("insert", "", $aa);
	$bb = str_ireplace("insert", "", $bb);
	$cc = str_ireplace("insert", "", $cc);
	$dd = str_ireplace("insert", "", $dd);
	$ee = str_ireplace("insert", "", $ee);
	$ff = str_ireplace("insert", "", $ff);

	$aa = str_ireplace("select", "", $aa);
	$bb = str_ireplace("select", "", $bb);
	$cc = str_ireplace("select", "", $cc);
	$dd = str_ireplace("select", "", $dd);
	$ee = str_ireplace("select", "", $ee);
	$ff = str_ireplace("select", "", $ff);

	$aa = str_ireplace("update", "", $aa);
	$bb = str_ireplace("update", "", $bb);
	$cc = str_ireplace("update", "", $cc);
	$dd = str_ireplace("update", "", $dd);
	$ee = str_ireplace("update", "", $ee);
	$ff = str_ireplace("update", "", $ff);
}

?>	