<?php
session_start();
if(isset($_POST)){
include ('../inc/config.php');
include('../inc/function.php');
$email = $_POST['email'];
$password = $_POST['password'];
$result = pg_prepare($conn, "my_queryl", "select  * from pelanggan
  where email='$email' and password='$password'");
// disini saya membuat table dengan nama mahasiswa
$query = pg_execute($conn, "my_queryl",array());
$hasil = pg_fetch_assoc($query);

if (!empty($hasil)) {
	$_SESSION['email'] = $hasil['$email'];
		$_SESSION['nama'] = $hasil['nama'];
	$_SESSION['idpelanggan'] = $hasil['idpelanggan'];
//memanggil status login 
	update_status_login("1",$_SESSION['idpelanggan']);
	header("Location:../index.php?mod=user&pg=profil");

} else {
	header("Location:../index.php?mod=user&pg=register&loginerror=1");
}
}
?>

