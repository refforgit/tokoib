<?php
/* Candralab Ecommerce v2.0
 * http://www.candra.web.id/
 * Candra adi putra <candraadiputra@gmail.com>
 * last edit: 15 okt 2013
 */
cek_status_login($_SESSION['idpelanggan']);
?>


<section class="main-content">
<a href='index.php?mod=chart&pg=invoice' class='btn btn-warning'>
		<i class='icon-arrow-left icon-white'></i>Back</a>
	<div class="row">
		<div class="span9">

	

	<h4 id="headings"> Detail Invoice dengan nomor <?=$_GET['id']?></h4>
	<!--<a href='index.php?mod=produk&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<table  class="table table-striped">
		
			<td><b>No </b></td><td><b>Gambar </b></td><td><b>Nama </b></td><td><b>harga satuan</b></td><td><b>Jumlah</b></td><td><b>Subtotal</b></td>
		
<?php
$id=$_GET['id'];
include ('inc/config.php');
$query="SELECT produk.*,transaksi.* ,stok.harga_jual
from produk,transaksi,stok 
where produk.idproduk=transaksi.idproduk
and produk.idproduk=stok.idproduk
and transaksi.noinvoice='$id'";

$result=pg_query($conn,$query) or die(pg_result_error());
$no=1;
//proses menampilkan data
$total=0;
while($rows=pg_fetch_object($result)){
$subtotal= $rows -> harga_jual* $rows -> jumlah;
$total+=$total+$subtotal;
			?>
			<tr>
				<td><?php echo $posisi+$no
				?></td>
			
				<td>
					<img src='upload/produk/<?=$rows ->foto ?>'  width='128px' height='128px' />
				</td>
					<td><?php echo $rows -> nama_produk; ?></td>
			<td><?php echo format_rupiah($rows -> harga_jual); ?></td>
			<td><?php echo $rows -> jumlah; ?></td>
			<td ><?php echo format_rupiah($subtotal); ?></td>
			<?php	$no++;
				}
			?>
<tr><td>Total</td><td colspan='6'  ><p class='pull-right'><?php echo format_rupiah($total);?></p></td></tr>
			
		
	</table>
			
</div>

<?php
include('inc/sidebar-front.php');
?>
	</div>
	
	
</section>
