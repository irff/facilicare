<?php
define("TIMEZ", "SET time_zone = '+07:00';");
define("KEY", "badakliar");
if($_POST)
{
	if($_POST["key"] != KEY) die();
	$uid = $_POST["uid"];
	$id = $_POST["id"];
	$inc = $_POST["inc"];
	$uid = $uid.'-'.$id;
	$konek = mysqli_connect("mysql.idhostinger.com","u708248129_kita","sampahbanget","u708248129_labs");
	$konek->query(TIMEZ);
	$konek->query("DELETE FROM voter WHERE NOW() - INTERVAL 10 MINUTE > lastvote");
	$isi = $konek->query("SELECT * FROM voter WHERE uid = '$uid'")->fetch_object();
	if($isi) die("barusan sudah nge-vote! -_-".$isi->uid);
	$konek->query("INSERT INTO voter (uid) VALUES('$uid');");
	$konek->query("UPDATE laporan SET vote = vote+($inc) WHERE id=$id;");
	$konek->close();
	die("success");
}
?>