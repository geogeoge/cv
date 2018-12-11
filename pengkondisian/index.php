<?php
include 'koneksi.php';

?>
<form method="POST">
	<hr>
	<center>Conversi APP lama ke APP Baru</center>
	<br>
	Fungsi nya untuk melihat akun app lama sudah sama belum dengan akun APP baru
	<input type="Submit" name="test_account" value="Test Account">
	<br>
	<br>
	Jika Sudah sama tinggal klik tombol ini untuk mengeksekusi konversi app lama ke app baru
	<input type="Submit" name="eksekusi" value="Execute">
	<hr>
</form>
<form method="GET">
	<hr>
	<center>Penyesuain Data Dari Axcel</center>
	<br>
	
	<input type="text" name="tabel_sementara" placeholder="Tabel Sementara" value="<?php echo $_GET['tabel_sementara'];?>">
	<br>
	<input type="text" name="table_penyesuaian" placeholder="Tabel Penyesuaian" value="<?php echo $_GET['table_penyesuaian'];?>">
	<br>
	<input type="text" name="pemisah_tanggal" placeholder="Pemisah Tanggal" value="<?php echo $_GET['pemisah_tanggal'];?>">
	<br>
	<input type="text" name="tahun" placeholder="Tahun" value="<?php echo $_GET['tahun'];?>">
	<br>
	<input type="text" name="mulai_no_transaksi" placeholder="Start no_transaksi" value="<?php echo $_GET['mulai_no_transaksi'];?>">
	<br>
	<input type="Submit" name="submit" value="Post">
</form>
<form method="POST">
	<br>
	Menghapus data yang tidak ada keterangannya
	<input type="Submit" name="hapus_data_tidak_penting" value="Tekan Sini">
	<br>
	<br>
	Menulis ulang id sementara 
	<input type="Submit" name="menulis_ulang_id_sementara" value="Tekan Sini">
	<br>
	<br>
	Fungsi untuk menambah 2 field "No_transaksi" dan "Tanggal"
	<input type="Submit" name="tambah_2_field" value="Tekan Sini">
	<br>
	<br>
	Menginput data yang tidak ada Tanggal
	<input type="Submit" name="input_tanggal_kosong" value="Tekan Sini">
	<br>
	<br>
	Membuat Tanggal
	<input type="Submit" name="membuat_tanggal" value="Tekan Sini">
	<br>
	<br>
	Membuat No Transaksi
	<input type="Submit" name="membuat_no_transaksi" value="Tekan Sini">
	<hr>
</form>
<form method="POST">
	<hr>
	<center>Proses Eksekusi</center>
	<br>
	Terjemahkan Account
	<input type="Submit" name="cek_table" value="Terjemahkan">
	<br>
	<br>
	Test Debit Kredit
	<input type="Submit" name="cek_debit_kredit" value="CEK DEBIT KREDIT">
	<br>
	<br>
	Eksekusi Pindah Account
	<input type="Submit" name="eksekusi_pindah_account" value="Execute">
	<hr>
</form>
<?php
if(isset($_POST['test_account'])){
	?>
	<table border="1">
		<tr>
			<td>No</td>
			<td>ID Lama</td>
			<td>Akun Lama</td>
			<td>ID Baru</td>
		</tr>
	<?php
	$no = 0;
	$query_account_lama = mysqli_query($koneksi_lama,"SELECT * FROM `account`");
	while($data_account_lama = mysqli_fetch_array($query_account_lama)){
		$no_account = $data_account_lama['no_account'];
		$nama_account = $data_account_lama['nama_account'];

		$query_account_baru = mysqli_query($koneksi_baru,"SELECT * FROM `account` WHERE nama_account='$nama_account'");
		$data_account_baru = mysqli_fetch_array($query_account_baru);
		$id_account = $data_account_baru['id_account'];
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $no_account;?></td>
			<td><?php echo $nama_account;?></td>
			<td><?php echo $id_account;?></td>
		</tr>
		<?php
		$no++;
	}
	?>
	</table>
	<?php
}

if(isset($_POST['eksekusi'])){
	$jumlah_record = 0;
	$query_account_lama = mysqli_query($koneksi_lama,"SELECT * FROM `account`");
	while($data_account_lama = mysqli_fetch_array($query_account_lama)){
		$nama_account_lama = $data_account_lama['nama_account'];

		$query_account_baru = mysqli_query($koneksi_baru,"SELECT * FROM `account` WHERE nama_account='$nama_account_lama'");
		$data_account_baru = mysqli_fetch_array($query_account_baru);
		$id_account = $data_account_baru['id_account'];

		$query_table_lama = mysqli_query($koneksi_lama,"SELECT * FROM `$nama_account_lama`");
		while($data_table_lama = mysqli_fetch_array($query_table_lama)){
			$no_transaksi = $data_table_lama['no_transaksi'];
			$bukti_transaksi = $data_table_lama['bukti_transaksi'];
			$tanggal = $data_table_lama['tanggal'];
			$keterangan = $data_table_lama['keterangan'];
			$debit = $data_table_lama['debit'];
			$kredit = $data_table_lama['kredit'];

			if($debit>=1){
				$nominal = $debit;
				$DK="D";
			} else {
				$nominal = $kredit;
				$DK="K";
			}


			$proses_inputan = mysqli_query($koneksi_baru,"INSERT INTO `data_transaksi`(`no_transaksi`, `tanggal`, `keterangan`, `nominal`, `id_account`, `DK`) VALUES ('$no_transaksi', '$tanggal', '$keterangan', '$nominal', '$id_account', '$DK')");

			if($proses_inputan){
				$jumlah_record = $jumlah_record + 1;
			}
		}
	}

	echo "Jumlah Data Yang tersimpan :".$jumlah_record;
}

if(isset($_POST['tambah_2_field'])){
	$tabel_sementara = $_GET['tabel_sementara'];

	mysqli_query($koneksi_baru,"ALTER TABLE  `$tabel_sementara` ADD  `no_transaksi` VARCHAR( 225 ) NOT NULL AFTER  `COL 1` , ADD  `tanggal` DATE NOT NULL AFTER  `no_transaksi`");
	mysqli_query($koneksi_baru,"ALTER TABLE  `$tabel_sementara` ADD  `status` ENUM(  'belum',  'sudah' ) NOT NULL");
}

if(isset($_POST['hapus_data_tidak_penting'])){
	$tabel_sementara = $_GET['tabel_sementara'];

	$query=mysqli_query($koneksi_baru,"select * from `$tabel_sementara` where `COL 3` is null or `COL 3`=''");
	while($tampil=mysqli_fetch_array($query)){
		echo $id_sementara = $tampil['COL 1'];

		mysqli_query($koneksi_baru,"delete from `$tabel_sementara` where `COL 1`='$id_sementara'");
	}
}

if(isset($_POST['menulis_ulang_id_sementara'])){
	$tabel_sementara = $_GET['tabel_sementara'];

	$query=mysqli_query($koneksi_baru,"select * from `$tabel_sementara` order by `COL 1`");
	$id_sementara = 1;
	while($tampil=mysqli_fetch_array($query)){
		$col_1 = $tampil['COL 1'];

		mysqli_query($koneksi_baru,"UPDATE `$tabel_sementara` SET `COL 1`='$id_sementara' where `COL 1`='$col_1'");
		$id_sementara++;
	}
}

if(isset($_POST['input_tanggal_kosong'])){
	$tabel_sementara = $_GET['tabel_sementara'];

	$query=mysqli_query($koneksi_baru,"select * from `$tabel_sementara` where `COL 2`='' or `COL 2` is null");
	while($tampil=mysqli_fetch_array($query)){
		$id_sementara = $tampil['COL 1'];
		$id_sementara_sebelumnya = $id_sementara - 1;

		$query2=mysqli_query($koneksi_baru,"select * from `$tabel_sementara` where `COL 1`='$id_sementara_sebelumnya'");
		$tampil2=mysqli_fetch_array($query2);
		$tanggal_sementara=$tampil2['COL 2'];

		mysqli_query($koneksi_baru,"update `$tabel_sementara` set `COL 2`='$tanggal_sementara' where `COL 1`='$id_sementara'");
	}
}

if(isset($_POST['membuat_tanggal'])){
	$tabel_sementara = $_GET['tabel_sementara'];
	$pemisah_tanggal = $_GET['pemisah_tanggal'];
	$tahun = $_GET['tahun'];

	$query=mysqli_query($koneksi_baru,"select * from `$tabel_sementara` where status='belum'");
	while($tampil=mysqli_fetch_array($query)){
		$id_sementara = $tampil['COL 1'];

		mysqli_query($koneksi_baru,"update `$tabel_sementara` set status='sudah' where `COL 1`='$id_sementara'");

		$tanggal_sementara = $tampil['COL 2'];
		$pecah_tanggal_sementara = explode($pemisah_tanggal, $tanggal_sementara);
		$bulan_sementara = $pecah_tanggal_sementara['1'];
		switch ($bulan_sementara) {
			case 'Jan':
				$bulan_angka = "01";
				break;

			case 'Feb':
				$bulan_angka = "02";
				break;

			case 'Mar':
				$bulan_angka = "03";
				break;

			case 'April':
				$bulan_angka = "04";
				break;

			case 'Apr':
				$bulan_angka = "04";
				break;

			case 'Mei':
				$bulan_angka = "05";
				break;
			
			case 'Jun':
				$bulan_angka = "06";
				break;

			case 'Jul':
				$bulan_angka = "07";
				break;

			case 'Agust':
				$bulan_angka = "08";
				break;

			case 'Aug':
				$bulan_angka = "08";
				break;

			case '08':
				$bulan_angka = "08";
				break;

			case 'Sep':
				$bulan_angka = "09";
				break;

			case '09':
				$bulan_angka = "09";
				break;

			case 'Okt':
				$bulan_angka = "10";
				break;

			case 'Oct':
				$bulan_angka = "10";
				break;

			case '10':
				$bulan_angka = "10";
				break;

			case 'Nop':
				$bulan_angka = "11";
				break;

			case 'Des':
				$bulan_angka = "12";
				break;

			case '12':
				$bulan_angka = "12";
				break;

			default:
				$bulan_angka = "";
				mysqli_query($koneksi_baru,"update `$tabel_sementara` set status='belum' where `COL 1`='$id_sementara'");
				break;
		}

		$tanggal = $tahun."-".$bulan_angka."-".$pecah_tanggal_sementara['0'];

		mysqli_query($koneksi_baru,"update `$tabel_sementara` set tanggal='$tanggal' where `COL 1`='$id_sementara'");
	}
}

if(isset($_POST['membuat_no_transaksi'])){
	$tabel_sementara = $_GET['tabel_sementara'];

	$query=mysqli_query($koneksi_baru,"select * from `$tabel_sementara`");
	while($tampil=mysqli_fetch_array($query)){
		$id_sementara = $tampil['COL 1'];
		$data_no_transaksi = $tampil['no_transaksi'];
		$tanggal = $tampil['tanggal'];
		$pecah_tanggal = explode("-", $tanggal);
		$tanggal_sambung = implode("", $pecah_tanggal);
		
		$query_sementara_lutfi = mysqli_query($koneksi_baru,"select * from `$tabel_sementara` where no_transaksi like '%$tanggal_sambung%' order by no_transaksi DESC limit 1");
		$data_query_sementara_lutfi = mysqli_fetch_array($query_sementara_lutfi);
		$jumlah_query_sementara_lutfi = mysqli_num_rows($query_sementara_lutfi);
		if($jumlah_query_sementara_lutfi>0){
			$data_no_transaksi_terakhir = $data_query_sementara_lutfi['no_transaksi'];
			$pecah_data_no_transaksi_terakhir = explode(".", $data_no_transaksi_terakhir);
			$id_tambahan = $pecah_data_no_transaksi_terakhir['1']+1;
			if($id_tambahan<10){
				$id_tambahan = "0".$id_tambahan;
			}
		} else {
			$id_tambahan = $_GET['mulai_no_transaksi'];
		}

		$no_transaksi = $tanggal_sambung.".".$id_tambahan;

		mysqli_query($koneksi_baru,"update `$tabel_sementara` set no_transaksi='$no_transaksi' where `COL 1`='$id_sementara'");
	}
}

if(isset($_POST['cek_table'])){
	?>
	<form method="POST">
		<input type="Submit" name="post" value="POST">
		<table border="1">
			<tr>
				<th>Kolom Table Sementara</th>
				<th>Account Baru</th>
				<th>Debit/Kredit</th>
			</tr>
		<?php
		$tabel_sementara = $_GET['tabel_sementara'];
		$table_penyesuaian = $_GET['table_penyesuaian'];

		$urutan = 0;
		$query_desc_table_sementara = mysqli_query($koneksi_baru,"DESC `$tabel_sementara`");
		while($data_desc_table_sementara = mysqli_fetch_array($query_desc_table_sementara)) {
			$query_table_sementara = mysqli_query($koneksi_baru,"SELECT * FROM `$tabel_sementara` limit 1");
			$data_table_sementara = mysqli_fetch_array($query_table_sementara);
			?>
			<tr>
				<td><input type="text" name=data_urutan_sementara[] value="<?php echo $data_table_sementara[$urutan];?>"></td>
				<td>
					<select name=data_id_account_baru[] required="required">
						<option selected="selected" disabled="disabled"></option>
						<option value="xxx"><b>Tidak Di Kasih</b></option>
						<?php
						$query_account = mysqli_query($koneksi_baru,"SELECT * FROM account");
						while($data_account = mysqli_fetch_array($query_account)){
							?>
							<option value="<?php echo $data_account['id_account'];?>"><?php echo $data_account['nama_account'];?></option>
							<?php
						}
						?>
					</select>
				</td>
				<td>
					<select name=data_dk[] required="required">
						<option selected="selected" disabled="disabled"></option>
						<option>debit</option>
						<option>kredit</option>
					</select>
				</td>
			</tr>
			<?php
			$urutan++;
		}
		?>
		</table>
	</form>
	<?php
}

if(isset($_POST['post'])){
	$data_urutan_sementara = $_POST['data_urutan_sementara'];
	$table_penyesuaian = $_GET['table_penyesuaian'];
	$data_id_account_baru = $_POST['data_id_account_baru'];
	$data_dk = $_POST['data_dk'];

	for ($i=0; $i < count($data_urutan_sementara); $i++) {
		$urutan_sementara = $data_urutan_sementara[$i];
		$id_account_baru = $data_id_account_baru[$i];
		$dk = $data_dk[$i];

		// mysqli_query($koneksi_baru,"DELETE FROM `sementara_pengkondisian`");
		mysqli_query($koneksi_baru,"INSERT INTO `$table_penyesuaian`(`urutan_sementara`, `id_account_baru`, `dk`) VALUES ('$urutan_sementara', '$id_account_baru', '$dk')");
	}
}

if(isset($_POST['cek_debit_kredit'])){
	$tabel_sementara = $_GET['tabel_sementara'];
	$table_penyesuaian = $_GET['table_penyesuaian'];

	$total_debit = 0;
	$total_kredit = 0;
	$query_tabel_sementara = mysqli_query($koneksi_baru,"SELECT * FROM `$tabel_sementara`");
	while($data_tabel_sementara = mysqli_fetch_array($query_tabel_sementara)){

		$perulangan = 0;
		$query_table_penyesuaian = mysqli_query($koneksi_baru,"SELECT * FROM `$table_penyesuaian`");
		while($data_table_penyesuaian = mysqli_fetch_array($query_table_penyesuaian)){
			$id_pengkondisian = $data_table_penyesuaian['id_pengkondisian'];
			$urutan_sementara = $data_table_penyesuaian['urutan_sementara'];
			$id_account_baru = $data_table_penyesuaian['id_account_baru'];
			$dk = $data_table_penyesuaian['dk'];

			if(!($id_account_baru=="xxx")){
				if($dk=="debit"){
					$total_debit = $total_debit + $data_tabel_sementara[$perulangan];
				} else
				if($dk=="kredit"){
					$total_kredit = $total_kredit + $data_tabel_sementara[$perulangan];
				}
			}

			$perulangan++;
		}

	}
	echo "D : ".$total_debit."<br>K : ".$total_kredit;
	$selisih = $total_debit-$total_kredit;
	echo "<br>S : ".$selisih;
}

if(isset($_POST['eksekusi_pindah_account'])){
	$tabel_sementara = $_GET['tabel_sementara'];
	$table_penyesuaian = $_GET['table_penyesuaian'];

	$query_tabel_sementara = mysqli_query($koneksi_baru,"SELECT * FROM `$tabel_sementara`");
	while($data_tabel_sementara = mysqli_fetch_array($query_tabel_sementara)){
		$keterangan = $data_tabel_sementara['COL 3'];
		$no_transaksi = $data_tabel_sementara['no_transaksi'];
		$tanggal = $data_tabel_sementara['tanggal'];

		$perulangan = 0;
		$query_table_penyesuaian = mysqli_query($koneksi_baru,"SELECT * FROM `$table_penyesuaian`");
		while($data_table_penyesuaian = mysqli_fetch_array($query_table_penyesuaian)){
			$id_pengkondisian = $data_table_penyesuaian['id_pengkondisian'];
			$urutan_sementara = $data_table_penyesuaian['urutan_sementara'];
			$id_account_baru = $data_table_penyesuaian['id_account_baru'];
			$dk = $data_table_penyesuaian['dk'];

			if($dk=="debit"){
				$debit_kredit = "D";
			} else
			if($dk=="kredit"){
				$debit_kredit = "K";
			}

			$nominal = $data_tabel_sementara[$perulangan];

			if(!($id_account_baru=="xxx")){
				mysqli_query($koneksi_baru,"INSERT INTO `data_transaksi`(`no_transaksi`, `tanggal`, `keterangan`, `nominal`, `id_account`, `DK`) VALUES ('$no_transaksi', '$tanggal', '$keterangan', '$nominal', '$id_account_baru', '$debit_kredit')");
			}

			$perulangan++;
		}
	}

	mysqli_query($koneksi_baru,"DELETE FROM  `data_transaksi` WHERE  `nominal` =  '0'");
}
?>