<?php

// script untuk memanggil fungsi php pg_connect untuk koneksi ke postgresql
$conn = pg_connect("host=ec2-54-235-66-24.compute-1.amazonaws.com port=5432 dbname=d8ig8ica3tatsa user='cfohoabinecfoa'
password='aec261c1978f6fa27bf7eb4dd625847f7ba7522e2e957dadc1aeb4f6904221f4'") or die('Could not connect: ' . pg_last_error()); 
//disini nama database saya adalah nama_database

?>

