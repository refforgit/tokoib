<?php
/* Candralab Ecommerce v2.0
 * http://www.candra.web.id/
 * Candra adi putra <candraadiputra@gmail.com>
 * last edit: 15 okt 2013
 */?>
		<div class="span3 col">
		<!--	<div class="block">
				<h4 class="title"><strong>Kategori</strong> </h4>
				<ul class="nav nav-list">
					<li class="nav-header">
					
					</li>
					<?php
					list_kategori(); 
					?>
				</ul>
			
				
		</div>-->
			<div class='block'>
					<h4 class="title"><strong>Latest</strong> News</h4>
				<ul class="nav nav-list below">
					<li class="nav-header">
				
					</li>
					<?php
					list_news(10); 
					?>
				</ul>
			</div>
			

			<div class="block">
				<h4 class="title"><strong>Random</strong> produk</h4>
			<?php	
			include('inc/config.php');
			$result = pg_prepare($conn, "my_query4", 'select produk.*,stok.*
			 from produk,stok
			 where produk.idproduk=stok.idstok OFFSET random() limit 5');
// disini saya membuat table dengan nama mahasiswa
			$query = pg_execute($conn, "my_query4",array());
			
$no = 1;
//proses menampilkan data
while($rows = pg_fetch_assoc($query)) {
?>

			
					<div class="product-box">
						<span class="sale_tag"></span>
						<a href="#">    <?php
						if (!empty($rows['foto'])) {
							echo "<img src='upload/produk/" . $rows['foto'] . "' />";
						}
					?>	</a>
						<br/>
						<a href="#" class="title"><?php echo $rows['nama_produk']?></a>
						<br/>
					
						<p class="price">
							<?php echo format_rupiah($rows['harga_jual'])?>
						</p>
						<p>
							<span class="label label-warning">Stok <?php echo   get_status_stok($rows['jumlah'])?></span>
						</p>
						<?php
						if(!empty($_SESSION['idpelanggan']) && ($rows['jumlah']>0)){ ?>
						<a href='index.php?mod=chart&pg=chart&action=add&id=<?php echo $rows['idproduk']?>' class='btn btn-warning'><i class='icon-shopping-cart icon-white'></i>Beli</a>
						<?php } ?>
					</div>
				</li>
		<?php } ?>
		
		
	