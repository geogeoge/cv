<?php
class select {
  function select_data_kas_kecil_where($tanggal_awal, $tanggal_akhir) {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM data_temp WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND ekstra = 'kas_kecil'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_data_kas_kecil_in() {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT sum(nominal) as jumlah FROM data_temp WHERE in_out = 'i' AND ekstra = 'kas_kecil'");
    $tampil=mysqli_fetch_array($query);
    $jumlah=$tampil['jumlah'];
    return $jumlah;
  }

  function select_data_kas_kecil_out() {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT sum(nominal) as jumlah FROM data_temp WHERE in_out='o' AND ekstra = 'kas_kecil'");
    $tampil=mysqli_fetch_array($query);
    $jumlah=$tampil['jumlah'];
    return $jumlah;
  }
}

class insert {
	function posting($keterangan, $debit, $kredit, $nominal, $tanggal, $ekstra) {
		include "../../koneksi/koneksi.php";

		$pecah_tanggal = explode("-", $tanggal);
		$tanggal_gabung = implode("", $pecah_tanggal);

		$query_pencarian_dihari_yang_sama = mysqli_query($koneksi,"SELECT * FROM data_transaksi WHERE no_transaksi like '%$tanggal_gabung%' ORDER BY no_transaksi DESC");
		$jumlah_pencarian_dihari_yang_sama = mysqli_num_rows($query_pencarian_dihari_yang_sama);
		if($jumlah_pencarian_dihari_yang_sama>=1){
		  $data_pencarian_dihari_yang_sama = mysqli_fetch_array($query_pencarian_dihari_yang_sama);

		  $no_transaksi_terakhir = $data_pencarian_dihari_yang_sama['no_transaksi'];
		  $pecah_no_transaksi_terakhir = explode(".", $no_transaksi_terakhir);
		  $id_pecah_no_transaksi_terakhir = $pecah_no_transaksi_terakhir['1'];
		  $id_pecah_no_transaksi_terakhir = $id_pecah_no_transaksi_terakhir + 1;

		  if($id_pecah_no_transaksi_terakhir<=9){
		    $id_pecah_no_transaksi_terakhir = "0".$id_pecah_no_transaksi_terakhir;
		  }

		  $no_transaksi = $tanggal_gabung.".".$id_pecah_no_transaksi_terakhir;
		} else {
		  $no_transaksi = $tanggal_gabung.".00";
		}

		$printah_debit = mysqli_query($koneksi,"INSERT INTO `data_transaksi`(`no_transaksi`, `tanggal`, `keterangan`, `nominal`, `id_account`, `DK`, `id_temp`) VALUES ('$no_transaksi', '$tanggal', '$keterangan', '$nominal', '$debit', 'D', '$ekstra')");
		$printah_kredit = mysqli_query($koneksi,"INSERT INTO `data_transaksi`(`no_transaksi`, `tanggal`, `keterangan`, `nominal`, `id_account`, `DK`, `id_temp`) VALUES ('$no_transaksi', '$tanggal', '$keterangan', '$nominal', '$kredit', 'K', '$ekstra')");
	}

	function insert_kas_masuk(){
    	include "../../koneksi/koneksi.php";

    	$tanggal = $_POST['tanggal'];
    	$keterangan = $_POST['keterangan'];
    	$nominal = $_POST['nominal'];
    	$id_account = "67";
    	$account_bank_bri = "68";
    	$in_out = "i";
    	$status = "sudah";
    	$ekstra = "kas_kecil";

    	$insert_data_temp = mysqli_query($koneksi,"INSERT INTO `data_temp`(`tanggal`, `keterangan`, `nominal`, `id_account`, `in_out`, `status`, `ekstra`) VALUES ('$tanggal', '$keterangan', '$nominal', '$id_account', '$in_out', '$status', '$ekstra')");

    	$query_data_temp = mysqli_query($koneksi,"SELECT * FROM `data_temp` ORDER BY id_temp DESC LIMIT 1");
    	$data_temp = mysqli_fetch_array($query_data_temp);
    	$id_temp = $data_temp['id_temp'];

    	$this->posting($keterangan, $id_account, $account_bank_bri, $nominal, $tanggal, $id_temp);
	}

	function insert_kas_keluar(){
    	include "../../koneksi/koneksi.php";
    	$tanggal = $_POST['tanggal'];
    	$keterangan = $_POST['keterangan'];
    	$nominal = $_POST['nominal'];
    	$id_account = "67";
    	$in_out = "o";
    	$in_out_data_kas = "o";
    	$status = "belum";
    	$ekstra = "kas_kecil";

    	$perintah = mysqli_query($koneksi,"INSERT INTO `data_temp`(`tanggal`, `keterangan`, `nominal`, `id_account`, `in_out`, `status`, `ekstra`) VALUES ('$tanggal', '$keterangan', '$nominal', '$id_account', '$in_out', '$status', '$ekstra')");

    	$query_data_temp = mysqli_query($koneksi,"SELECT * FROM `data_temp` ORDER BY id_temp DESC LIMIT 1");
    	$data_temp = mysqli_fetch_array($query_data_temp);
    	$id_temp = $data_temp['id_temp'];

	}
}

class delete {
	function batal_posting() {    
		include "../../koneksi/koneksi.php";

		$id_temp = $_POST['id_temp'];

		$delete_data_temp = mysqli_query($koneksi,"DELETE FROM `data_temp` WHERE `id_temp`='$id_temp'");
		$delete_data_transaksi = mysqli_query($koneksi,"DELETE FROM `data_transaksi` WHERE `id_temp`='$id_temp'");
	}
}

$select = new select;
$insert = new insert;
$delete = new delete;
?>