<?php
// script untuk memanggil fungsi php pg_connect untuk koneksi ke postgresql
$conn = pg_connect("host=ec2-54-235-66-24.compute-1.amazonaws.com port=5432 dbname=d8ig8ica3tatsa user='cfohoabinecfoa'
password='dd'");
//disini nama database saya adalah nama_database
$result = pg_prepare($conn, "my_query", 'SELECT * FROM berita');
// disini saya membuat table dengan nama mahasiswa
$result = pg_execute($conn, "my_query",array());
echo "<table border='1px'>
<tr><td> idberita</td>
<td> tanggal</td></tr>
";
// kolom yang ada di table mahasiswa saya hanya ada 2 yaitu nim dan nama
while ($row = pg_fetch_assoc($result))
{
echo "<tr>";
echo "<td>".$row['idberita']."</td>";
echo "<td>".$row['tanggal']."</td>";
echo "</tr>";
}
echo "</table>";
?>

