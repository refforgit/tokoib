<?php
// script untuk memanggil fungsi php pg_connect untuk koneksi ke postgresql
$conn = pg_connect("host=ec2-54-235-66-24.compute-1.amazonaws.com port=5432 dbname=d8ig8ica3tatsa user='cfohoabinecfoa'
password='aec261c1978f6fa27bf7eb4dd625847f7ba7522e2e957dadc1aeb4f6904221f4'");
//disini nama database saya adalah nama_database
$result = pg_prepare($conn, "my_query", 'SELECT * FROM mahasiswa');
// disini saya membuat table dengan nama mahasiswa
$result = pg_execute($conn, "my_query",array());
echo "<table border='1px'>
<tr><td> nim</td>
<td> nama</td></tr>
";
// kolom yang ada di table mahasiswa saya hanya ada 2 yaitu nim dan nama
while ($row = pg_fetch_assoc($result))
{
echo "<tr>";
echo "<td>".$row['nim']."</td>";
echo "<td>".$row['nama']."</td>";
echo "</tr>";
}
echo "</table>";
?>

