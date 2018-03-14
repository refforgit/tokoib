<?php
/* Candralab Ecommerce v2.0
 * http://www.candra.web.id/
 * Candra adi putra <candraadiputra@gmail.com>
 * last edit: 15 okt 2013
 */
//cek_akses_langsung();
?>
<section class="main-content">

	<div class="row" align="center">
		<div class="span9">
<?php $id = $_GET['idberita'];
include('inc/config.php');
	$result = pg_prepare($conn, "my_query", " SELECT * from berita where idberita='$id'");
	$query = pg_execute($conn, "my_query",array());
$no = 1;
//proses menampilkan data
$rows = pg_fetch_assoc($query);
?>

   
        <h2 align="center"> 
        	<?php echo $rows['judul']?></strong></h2>
        	 <span class="label label-success" ><?php echo $rows['tanggal']; ?></span>
        	 <br/>
    <?php
	if (!empty($rows['gambar'])) {
		echo "<img src='upload/berita/" . $rows['gambar'] . "' />";
	}
?>	
	
   
    
      
     
      <p> 
      <?php $rows['isi'] ?>
        </p>
      
		
		</div>
<?php
include('inc/sidebar-front.php');
?>
	</div>
</section>		


