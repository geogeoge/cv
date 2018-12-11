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

$tanggal_awal = date('Y-m')."-01";
if(isset($_GET['tanggal_awal'])){
  $tanggal_awal = $_GET['tanggal_awal'];
}

$tanggal_akhir = date('Y-m-d');
if(isset($_GET['tanggal_akhir'])){
  $tanggal_akhir = $_GET['tanggal_akhir'];
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetLineWidth(0);

$pdf->Ln();
$pdf->SetFont('Times','B',14);
$pdf->Cell(10,15,' ',0, 1, 'C');

$pdf->SetFont('Arial','B',14);
$pdf->Cell(190,5,'CV. CONNECTIS JATI INFORMATIKA',0, 0, 'C');
$pdf->Cell(0,6,'',0, 1, 'R');

$pdf->SetFont('Times','B',12);
$pdf->Cell(190,5,'Laporan Laba/Rugi',0, 0, 'C');

$pdf->Ln();
$pdf->SetFont('Times','B',10);
$pdf->Cell(190,5,date('d', strtotime($tanggal_awal)).' '.$bulan_indonesia[date('m', strtotime($tanggal_awal))].' '.date('Y', strtotime($tanggal_awal)).' s/d '.date('d', strtotime($tanggal_akhir)).' '.$bulan_indonesia[date('m', strtotime($tanggal_akhir))]. ' '.date('Y', strtotime($tanggal_akhir)),0, 0, 'C');

$pdf->Ln();
$pdf->SetFont('Times','B',8);
$pdf->Cell(190,5,'(Disajikan dalam mata uang Rupiah)',0, 1, 'C');

// ----------------------------------------- AKTIVA ----------------------------------------- \\
$pdf->SetFont('Times','B',10);
$pdf->SetFillColor(255,49,49);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(190,5,'LABA / RUGI',1,1,'C',1,128,128);


$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0,0,0);


$pdf->SetFont('Times','B',8);
$pdf->Cell(190,5,'PENDAPATAN',TB,1,'L',220, 220, 220);

// ------------------------------- KOLOM PENDAPATAN ------------------------------- \\
$total_pendapatan = 0;
foreach($select->select_jenis_account_where_id_master_jenis_account('4') as $data_jenis_account) {
	$id_jenis_account=$data_jenis_account['id_jenis_account'];
	$jenis_account=$data_jenis_account['jenis_account'];

	foreach ($select->select_account_where_id_jenis_account($id_jenis_account) as $data_account) {
        $id_account = $data_account['id_account'];
        $nama_account = $data_account['nama_account'];
        $nominal = $select->select_jumlah_nominal_per_account_kredit($id_account, $tanggal_awal, $tanggal_akhir);
        $total_pendapatan = $total_pendapatan + $nominal;

        $pdf->SetFont('Times','',8);
		$pdf->Cell(5,5,'',TB,0,'L',220, 220, 220);
		$pdf->Cell(115,5,$nama_account,TB,0,'L',220, 220, 220);
		$pdf->Cell(35,5,number_format($nominal,0,',','.'),TB,0,'R',220, 220, 220);
		$pdf->Cell(35,5,'',TB,1,'R',220, 220, 220);
	}
}

$pdf->SetFont('Times','B',8);
$pdf->Cell(155,5,'TOTAL PENDAPATAN',TB,0,'C',220, 220, 220);
$pdf->Cell(35,5,number_format($total_pendapatan,0,',','.'),TB,1,'R',220, 220, 220);


// ------------------------------- KOLOM BEBAN ------------------------------- \\
$pdf->SetFont('Times','B',8);
$pdf->Cell(190,5,'BIAYA',TB,1,'L',220, 220, 220);

$total_biaya = 0;
foreach($select->select_jenis_account_where_id_master_jenis_account('5') as $data_jenis_account) {
	$id_jenis_account=$data_jenis_account['id_jenis_account'];
	$jenis_account=$data_jenis_account['jenis_account'];

	foreach ($select->select_account_where_id_jenis_account($id_jenis_account) as $data_account) {
        $id_account = $data_account['id_account'];
        $nama_account = $data_account['nama_account'];
        $nominal = $select->select_jumlah_nominal_per_account_debit($id_account, $tanggal_awal, $tanggal_akhir);
        $total_biaya = $total_biaya + $nominal;

        $pdf->SetFont('Times','',8);
		$pdf->Cell(5,5,'',TB,0,'L',220, 220, 220);
		$pdf->Cell(115,5,$nama_account,TB,0,'L',220, 220, 220);
		$pdf->Cell(35,5,number_format($nominal,0,',','.'),TB,0,'R',220, 220, 220);
		$pdf->Cell(35,5,'',TB,1,'R',220, 220, 220);
	}
}

$pdf->SetFont('Times','B',8);
$pdf->Cell(155,5,'TOTAL BIAYA',TB,0,'C',220, 220, 220);
$pdf->Cell(35,5,number_format($total_biaya,0,',','.'),TB,1,'R',220, 220, 220);

$pdf->SetFillColor(255, 204, 204);
$pdf->Cell(165,5,'LABA/RUGI',TB,0,'C',220, 220, 220);
$pdf->Cell(25,5,number_format($total_pendapatan - $total_biaya,0,',','.'),TB,1,'R',220, 220, 220);



$pdf->Output("Laba_Rugi ".date('d', strtotime($tanggal_awal)).' '.$bulan_indonesia[date('m', strtotime($tanggal_awal))].' '.date('Y', strtotime($tanggal_awal)).' - '.date('d', strtotime($tanggal_akhir)).' '.$bulan_indonesia[date('m', strtotime($tanggal_akhir))]. ' '.date('Y', strtotime($tanggal_akhir)).".pdf","I");
?>