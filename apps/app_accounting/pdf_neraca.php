<?php
include "session.php";
include "function.php";
include "../../koneksi/koneksi.php";
require('../asset/fpdf/fpdf.php');

$bulan_indonesia = array(
  '01' => 'Januari',
  '02' => 'Februari',
  '03' => 'Maret',
  '04' => 'April',
  '05' => 'Mei',
  '06' => 'Juni',
  '07' => 'Juli',
  '08' => 'Agustus',
  '09' => 'September',
  '10' => 'Oktober',
  '11' => 'November',
  '12' => 'Desember',
);

$tanggal_periode = date('Y-m-d');
if(isset($_GET['tanggal_periode'])){
  $tanggal_periode = $_GET['tanggal_periode'];
}

//untuk kebutuhan laba rugi
$tanggal_awal_yang_ditahan = "0000-00-00";
$tanggal_awal_bulan_berjalan = date('Y-', strtotime($tanggal_periode))."01-01";

$tanggal_akhir_yang_ditahan = date('Y-m-d', strtotime('-1 days', strtotime($tanggal_awal_bulan_berjalan)));
$tanggal_akhir_bulan_bejalan = $tanggal_periode;




$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetLineWidth(0);

$pdf->SetFont('Times','B',14);
$pdf->Cell(10,15,' ',0, 1, 'C');

$pdf->SetFont('Arial','B',14);
$pdf->Cell(190,5,'CV. CONNECTIS JATI INFORMATIKA',0, 0, 'C');
$pdf->Cell(0,6,'',0, 1, 'R');

$pdf->SetFont('Times','B',12);
$pdf->Cell(190,5,'Laporan Posisi Keuangan',0, 0, 'C');

$pdf->Ln();
$pdf->SetFont('Times','B',10);
$pdf->Cell(190,5,'Sampai '.date('d', strtotime($tanggal_periode))." ".$bulan_indonesia[date('m', strtotime($tanggal_periode))]." ".date('Y', strtotime($tanggal_periode)),0, 0, 'C');


// ----------------------------------------- AKTIVA ----------------------------------------- \\
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Times','B',10);
$pdf->SetFillColor(255,49,49);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(190,5,'AKTIVA',1,1,'C',1,128,128);


$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0,0,0);

$total_aktiva = 0;
foreach($select->select_jenis_account_where_id_master_jenis_account('1') as $data_jenis_account) {
	$id_jenis_account=$data_jenis_account['id_jenis_account'];
  	$jenis_account=$data_jenis_account['jenis_account'];
	$total_jenis_account=0;

	$pdf->SetFont('Times','B',8);
	$pdf->Cell(190,5,$jenis_account,TB,1,'L',220, 220, 220);

	foreach ($select->select_account_where_id_jenis_account($id_jenis_account) as $data_account) {
	    $id_account = $data_account['id_account'];
	    $nama_account = $data_account['nama_account'];
	    $nominal = $select->select_jumlah_nominal_per_account_debit($id_account, $tanggal_awal, $tanggal_periode);
		$total_jenis_account = $total_jenis_account + $nominal;

		$pdf->SetFont('Times','',8);
		$pdf->Cell(5,5,'',TB,0,'L',220, 220, 220);
		$pdf->Cell(110,5,$nama_account,TB,0,'L',220, 220, 220);
		$pdf->Cell(25,5,number_format($nominal,0,',','.'),TB,0,'R',220, 220, 220);
		$pdf->Cell(25,5,'',TB,0,'R',220, 220, 220);
		$pdf->Cell(25,5,'',TB,1,'R',220, 220, 220);
	}

	$pdf->SetFont('Times','B',8);
	$pdf->Cell(115,5,'TOTAL '.$jenis_account,TB,0,'C',220, 220, 220);
	$pdf->Cell(25,5,'',TB,0,'R',220, 220, 220);
	$pdf->Cell(25,5,number_format($total_jenis_account,0,',','.'),TB,0,'R',220, 220, 220);
	$pdf->Cell(25,5,'',TB,1,'R',220, 220, 220);

	$total_aktiva = $total_aktiva + $total_jenis_account;
}
$pdf->SetFillColor(255, 204, 204);
$pdf->Cell(165,5,'TOTAL AKTIVA',TB,0,'C',220, 220, 220);
$pdf->Cell(25,5,number_format($total_aktiva,0,',','.'),TB,1,'R',220, 220, 220);

// ----------------------------------------- PASIVA ----------------------------------------- \\
$pdf->SetFont('Times','B',10);
$pdf->SetFillColor(255,49,49);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(190,5,'PASIVA',1,1,'C',1,128,128);


$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0,0,0);

$total_pasiva = 0;
foreach($select->select_jenis_account_where_id_master_jenis_account('2') as $data_jenis_account) {
	$id_jenis_account=$data_jenis_account['id_jenis_account'];
	$jenis_account=$data_jenis_account['jenis_account'];
	$total_jenis_account=0;

	$pdf->SetFont('Times','B',8);
	$pdf->Cell(190,5,$jenis_account,TB,1,'L',220, 220, 220);

	foreach ($select->select_account_where_id_jenis_account($id_jenis_account) as $data_account) {
        $id_account = $data_account['id_account'];
        $nama_account = $data_account['nama_account'];
        $nominal = $select->select_jumlah_nominal_per_account_kredit($id_account, $tanggal_awal, $tanggal_periode);
        $total_jenis_account = $total_jenis_account + $nominal;

        $pdf->SetFont('Times','',8);
		$pdf->Cell(5,5,'',TB,0,'L',220, 220, 220);
		$pdf->Cell(110,5,$nama_account,TB,0,'L',220, 220, 220);
		$pdf->Cell(25,5,number_format($nominal,0,',','.'),TB,0,'R',220, 220, 220);
		$pdf->Cell(25,5,'',TB,0,'R',220, 220, 220);
		$pdf->Cell(25,5,'',TB,1,'R',220, 220, 220);
	}

	$pdf->SetFont('Times','B',8);
	$pdf->Cell(115,5,'TOTAL '.$jenis_account,TB,0,'C',220, 220, 220);
	$pdf->Cell(25,5,'',TB,0,'R',220, 220, 220);
	$pdf->Cell(25,5,number_format($total_jenis_account,0,',','.'),TB,0,'R',220, 220, 220);
	$pdf->Cell(25,5,'',TB,1,'R',220, 220, 220);

  	$total_pasiva = $total_pasiva + $total_jenis_account;
}

foreach($select->select_jenis_account_where_id_master_jenis_account('3') as $data_jenis_account) {
	$id_jenis_account=$data_jenis_account['id_jenis_account'];
	$jenis_account=$data_jenis_account['jenis_account'];
	$total_jenis_account=0;

	$pdf->SetFont('Times','B',8);
	$pdf->Cell(190,5,$jenis_account,TB,1,'L',220, 220, 220);

	foreach ($select->select_account_where_id_jenis_account($id_jenis_account) as $data_account) {
        $id_account = $data_account['id_account'];
        $nama_account = $data_account['nama_account'];
        $nominal_account = $select->select_jumlah_nominal_per_account_kredit($id_account, $tanggal_awal, $tanggal_periode);
        $total_jenis_account = $total_jenis_account + $nominal;

        //Laba Rugi
        $total_pendapatan = 0;
        foreach ($select->select_jenis_account_where_id_master_jenis_account('4') as $data_jenis_account) {
          $id_jenis_account=$data_jenis_account['id_jenis_account'];
          foreach ($select->select_account_where_id_jenis_account($id_jenis_account) as $data_account) {
            $id_account = $data_account['id_account'];
            $nominal = $select->select_jumlah_nominal_per_account_kredit($id_account, $tanggal_awal, $tanggal_periode);

            $total_pendapatan = $total_pendapatan + $nominal;
          }

        }

        $total_biaya = 0;
        foreach ($select->select_jenis_account_where_id_master_jenis_account('5') as $data_jenis_account) {
          $id_jenis_account=$data_jenis_account['id_jenis_account'];
          foreach ($select->select_account_where_id_jenis_account($id_jenis_account) as $data_account) {
            $id_account = $data_account['id_account'];
            $nominal = $select->select_jumlah_nominal_per_account_debit($id_account, $tanggal_awal, $tanggal_periode);

            $total_biaya = $total_biaya + $nominal;
          }
        }
        $laba_rugi = $total_pendapatan-$total_biaya;

        $total_nominal = $nominal_account + $laba_rugi;

        $pdf->SetFont('Times','',8);
		$pdf->Cell(5,5,'',TB,0,'L',220, 220, 220);
		$pdf->Cell(110,5,$nama_account,TB,0,'L',220, 220, 220);
		$pdf->Cell(25,5,number_format($total_nominal,0,',','.'),TB,0,'R',220, 220, 220);
		$pdf->Cell(25,5,'',TB,0,'R',220, 220, 220);
		$pdf->Cell(25,5,'',TB,1,'R',220, 220, 220);
	}
	// ------------------------ BATAS LABA/RUGI ------------------------ \\

	$pdf->SetFont('Times','B',8);
	$pdf->Cell(115,5,'TOTAL '.$jenis_account,TB,0,'C',220, 220, 220);
	$pdf->Cell(25,5,'',TB,0,'R',220, 220, 220);
	$pdf->Cell(25,5,number_format($total_nominal,0,',','.'),TB,0,'R',220, 220, 220);
	$pdf->Cell(25,5,'',TB,1,'R',220, 220, 220);

  	$total_pasiva = $total_pasiva + $total_nominal;
}
$pdf->SetFillColor(255, 204, 204);
$pdf->Cell(165,5,'TOTAL PASIVA',TB,0,'C',220, 220, 220);
$pdf->Cell(25,5,number_format($total_pasiva,0,',','.'),TB,1,'R',220, 220, 220);



$pdf->Output("Neraca Per ".date('d', strtotime($tanggal_periode))." ".$bulan_indonesia[date('m', strtotime($tanggal_periode))]." ".date('Y', strtotime($tanggal_periode)).".pdf","I");
?>