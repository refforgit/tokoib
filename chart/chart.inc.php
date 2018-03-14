<?php
/* Candralab Ecommerce v2.0
 * http://www.candra.web.id/
 * Candra adi putra <candraadiputra@gmail.com>
 * last edit: 15 okt 2013
 */?>
<?php
function kd_transaksi() {
$conn = pg_connect("host=ec2-54-235-66-24.compute-1.amazonaws.com port=5432 dbname=d8ig8ica3tatsa user='cfohoabinecfoa'
password='aec261c1978f6fa27bf7eb4dd625847f7ba7522e2e957dadc1aeb4f6904221f4'") or die('Could not connect: ' . pg_last_error()); 
$qu = pg_query($conn, "select noinvoice FROM invoice ORDER BY noinvoice desc limit 1");
$liatk = pg_fetch_assoc($qu);
$xc = $liatk['noinvoice'];
	if ($xc == '')
		$kode = "T00001";
	else {
		$jum = substr($xc, 1, 6);
		$jum++;
		if ($jum <= 9)
			$kode = "T0000" . $jum;
		elseif ($jum <= 99)
			$kode = "T000" . $jum;
		elseif ($jum <= 999)
			$kode = "T00" . $jum;
		elseif ($jum <= 9999)
			$kode = "T0" . $jum;
		elseif ($jum <= 99999)
			$kode = "T" . $jum;
		else
			die("Kode pemesanan melebihi batas");
	}
	return $kode;
}

function writeShoppingchart() {
	$chart = $_SESSION['chart'];
	if (!$chart) {
		return '<p>Anda belum membeli apapun</p>';
	} else {
		// Parse the chart session variable
		$items = explode(',', $chart);
		$s = (count($items) > 1) ? 's' : '';
		return '<h3>Ada <a href="index.php?mod=chart&pg=chart">' . count($items) . ' barang' . $s . ' di chart</a></h3>';
	}
}

function chartNotification() {
	$chart = $_SESSION['chart'];
	if (!$chart) {
		return '0';
	} else {
		// Parse the chart session variable
		$items = explode(',', $chart);

		return count($items);
	}
}

function getQty() {
	$chart = $_SESSION['chart'];
	if (!$chart) {
		return 0;
	} else {
		// Parse the chart session variable
		$items = explode(',', $chart);
		$s = (count($items) > 1) ? 's' : '';
		return count($items);
	}
}

function showchart() {

	$chart = $_SESSION['chart'];
//	print_r($chart);
	if ($chart) {
		$items = explode(',', $chart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		$output[] = "<table class=\"table table-striped \">";
		$output[] = "<th><td>Nama</td><td> Harga</td><td>jumlah</td><td>subtotal</td><td>Aksi</td></th>";
		$output[] = '<form action="index.php?mod=chart&pg=chart&action=update" method="post" id="chart">';
		$no = 1;
		foreach ($contents as $id => $qty) {
		include('inc/config.php');
			
			$qu = pg_query($conn, "SELECT produk.*,stok.harga_jual from produk,stok WHERE produk.idproduk = stok.idproduk and produk.idproduk = '$id'");
			$row = pg_fetch_object($qu);
			$output[] = '<tr><td>' . $no . '</td>';
		
			$output[] = '<td><img src=\'upload/produk/' .$row->foto ;
			
			$output[] = '\' width=\'128px\' height=\'128px\'><br> '.$row->nama_produk. 
			
			'</td><td>' . format_rupiah($row -> harga_jual) . '</td>';
			$output[] = '<td><input type="text" class="input-mini" name="qty' . $id . '" value="' . $qty . '"  /></td>';

			$output[] = '<td>Rp.' . format_rupiah($row -> harga_jual * $qty) . '</td>';
			$total += $row -> harga_jual * $qty;

			$output[] = '<td><a href="index.php?mod=chart&pg=chart&action=delete&id=' . $id . '" class="btn btn-danger">Hapus</a></td></tr>';
			$no++;
		}
		$output[] = "</table>";
		$qty = getQty();

		$output[] = '<h3>Total	Transaksi	: ' . format_rupiah($total) . '</h3>';

		$_SESSION['totalbayar'] = $total;
		$output[] = '<button type="submit" class=\'btn btn-primary\'>Update cart</button>';
		$output[] = '</form>';
		$output[] ='<a href=\'chart/chart_action.php\' class=\'btn btn-primary\'>Check out</a>';
	} else {
		$output[] = '<p>Keranjang belanja masih kosong.</p>';
	}
	return join('', $output);
}

function insertToDB($kd_transaksi, $idpelanggan, $totalbayar) {

	$chart = $_SESSION['chart'];
	if ($chart) {
		$items = explode(',', $chart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		$tgl = date('d-M-Y');
		$conn = pg_connect("host=ec2-54-235-66-24.compute-1.amazonaws.com port=5432 dbname=d8ig8ica3tatsa user='cfohoabinecfoa'
password='aec261c1978f6fa27bf7eb4dd625847f7ba7522e2e957dadc1aeb4f6904221f4'") or die('Could not connect: ' . pg_last_error()); 
		$qins=pg_query($conn, "insert into invoice (noinvoice,tanggal,totalbayar,idpelanggan) 
		values( '$kd_transaksi', '$tgl','$totalbayar','$idpelanggan')") or die(pg_result_error());
		//echo "SQL transaksi:".$sql_transaksi;
		foreach ($contents as $id => $qty) {

			$sql = "insert into transaksi(noinvoice,idproduk,jumlah)
			values('$kd_transaksi','$id','$qty')";
			//		echo "SQL transaksi:".$sql;
			$result = pg_query($conn, $sql) or die(pg_result_error());
		}
	} else {
		$output[] = '<p>Keranjang belanja masih kosong.</p>';
	}

}
?>
