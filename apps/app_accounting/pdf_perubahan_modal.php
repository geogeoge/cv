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
$tanggal_awal_tahun_sebelumnya = date('Y', strtotime('-1 years', strtotime($tanggal_periode)))."-01-01";
$tanggal_awal_tahun_berjalan = date('Y-', strtotime($tanggal_periode))."01-01";

$tanggal_akhir_yang_ditahan = date('Y-m-d', strtotime('-1 days', strtotime($tanggal_awal_tahun_sebelumnya)));
$tanggal_akhir_tahun_sebelumnya = date('Y-m-d', strtotime('-1 days', strtotime($tanggal_awal_tahun_berjalan)));
$tanggal_akhir_tahun_berjalan = $tanggal_periode;

$penambahan_modal_yang_ditahan = $select->perubahan_modal_tampil_penambahan_modal($tanggal_awal_yang_ditahan, $tanggal_akhir_yang_ditahan);
$penambahan_modal_tahun_sebelumnya = $select->perubahan_modal_tampil_penambahan_modal($tanggal_awal_tahun_sebelumnya, $tanggal_akhir_tahun_sebelumnya);
$penambahan_modal_tahun_berjalan = $select->perubahan_modal_tampil_penambahan_modal($tanggal_awal_tahun_berjalan, $tanggal_akhir_tahun_berjalan);

$penarikan_modal_yang_ditahan = $select->perubahan_modal_tampil_penarikan_modal($tanggal_awal_yang_ditahan, $tanggal_akhir_yang_ditahan);
$penarikan_modal_tahun_sebelumnya = $select->perubahan_modal_tampil_penarikan_modal($tanggal_awal_tahun_sebelumnya, $tanggal_akhir_tahun_sebelumnya);
$penarikan_modal_tahun_berjalan = $select->perubahan_modal_tampil_penarikan_modal($tanggal_awal_tahun_berjalan, $tanggal_akhir_tahun_berjalan);


$laba_rugi_yang_ditahan = $select->perubahan_modal_tampil_laba_rugi($tanggal_awal_yang_ditahan, $tanggal_akhir_yang_ditahan);
$laba_rugi_tahun_sebelumnya = $select->perubahan_modal_tampil_laba_rugi($tanggal_awal_tahun_sebelumnya, $tanggal_akhir_tahun_sebelumnya);
$laba_rugi_tahun_berjalan = $select->perubahan_modal_tampil_laba_rugi($tanggal_awal_tahun_berjalan, $tanggal_akhir_tahun_berjalan);

$modal_awal = $penambahan_modal_yang_ditahan - $penarikan_modal_yang_ditahan + $laba_rugi_yang_ditahan;
$jumlah_modal_tahun_sebelumnya = $modal_awal + $penambahan_modal_tahun_sebelumnya + $laba_rugi_tahun_sebelumnya;
$total_modal_tahun_sebelumnya = $jumlah_modal_tahun_sebelumnya - $penarikan_modal_tahun_sebelumnya;

$jumlah_modal_tahun_berjalan = $total_modal_tahun_sebelumnya + $penambahan_modal_tahun_berjalan + $laba_rugi_tahun_berjalan;
$total_modal_tahun_berjalan = $jumlah_modal_tahun_berjalan - $penarikan_modal_tahun_berjalan;


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetLineWidth(0);

$pdf->SetFont('Times','B',14);
$pdf->Cell(10,15,' ',0, 1, 'C');

$pdf->SetFont('Arial','B',14);
$pdf->Cell(190,5,'CV. CONNECTIS JATI INFORMATIKA',0, 0, 'C');
$pdf->Cell(0,6,'',0, 1, 'R');

$pdf->SetFont('Times','B',12);
$pdf->Cell(190,5,'Laporan Perubahan Modal',0, 0, 'C');

$pdf->Ln();
$pdf->SetFont('Times','B',10);
$pdf->Cell(190,5,'Sampai '.date('d', strtotime($tanggal_periode))." ".$bulan_indonesia[date('m', strtotime($tanggal_periode))]." ".date('Y', strtotime($tanggal_periode)),0, 0, 'C');


// ----------------------------------------- AKTIVA ----------------------------------------- \\
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Times','B',10);
$pdf->SetFillColor(255,49,49);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(190,5,'PERUBAHAN MODAL',1,1,'C',1,128,128);


$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Times','B',8);
$pdf->Cell(190,5,'PERUBAHAN MODAL TAHUN SEBELUMNYA',TB,1,'L',220, 220, 220);

$pdf->SetFont('Times','',8);
$pdf->Cell(5,5,'',TB,0,'L',220, 220, 220);
$pdf->Cell(110,5,'Modal Awal',TB,0,'L',220, 220, 220);
$pdf->Cell(25,5,number_format($modal_awal,0,',','.'),TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,'',TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,'',TB,1,'R',220, 220, 220);

$pdf->SetFont('Times','',8);
$pdf->Cell(5,5,'',TB,0,'L',220, 220, 220);
$pdf->Cell(110,5,'Penambahan Modal Tahun '.date('Y', strtotime('-1 years', strtotime($tanggal_periode))),TB,0,'L',220, 220, 220);
$pdf->Cell(25,5,number_format($penambahan_modal_tahun_sebelumnya,0,',','.'),TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,'',TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,'',TB,1,'R',220, 220, 220);

$pdf->SetFont('Times','',8);
$pdf->Cell(5,5,'',TB,0,'L',220, 220, 220);
$pdf->Cell(110,5,'Laba/Rugi Tahun '.date('Y', strtotime('-1 years', strtotime($tanggal_periode))),TB,0,'L',220, 220, 220);
$pdf->Cell(25,5,number_format($laba_rugi_tahun_sebelumnya,0,',','.'),TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,'',TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,'',TB,1,'R',220, 220, 220);

$pdf->SetFont('Times','',8);
$pdf->Cell(10,5,'',TB,0,'L',220, 220, 220);
$pdf->Cell(105,5,'~ Penarikan Modal Tahun '.date('Y', strtotime('-1 years', strtotime($tanggal_periode))),TB,0,'L',220, 220, 220);
$pdf->Cell(25,5,'('.number_format($penarikan_modal_tahun_sebelumnya,0,',','.').')',TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,'',TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,'',TB,1,'R',220, 220, 220);

$pdf->SetFont('Times','B',8);
$pdf->Cell(115,5,'Total Modal Tahun '.date('Y', strtotime('-1 years', strtotime($tanggal_periode))),TB,0,'C',220, 220, 220);
$pdf->Cell(25,5,'',TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,number_format($total_modal_tahun_sebelumnya,0,',','.'),TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,'',TB,1,'R',220, 220, 220);

$pdf->SetFont('Times','B',8);
$pdf->Cell(190,5,'PERUBAHAN MODAL TAHUN BERJALAN',TB,1,'L',220, 220, 220);

$pdf->SetFont('Times','',8);
$pdf->Cell(5,5,'',TB,0,'L',220, 220, 220);
$pdf->Cell(110,5,'Penambahan Modal Tahun '.date('Y', strtotime($tanggal_periode)),TB,0,'L',220, 220, 220);
$pdf->Cell(25,5,'',TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,number_format($penambahan_modal_tahun_berjalan,0,',','.'),TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,'',TB,1,'R',220, 220, 220);

$pdf->SetFont('Times','',8);
$pdf->Cell(5,5,'',TB,0,'L',220, 220, 220);
$pdf->Cell(110,5,'Laba/Rugi Tahun '.date('Y', strtotime($tanggal_periode)),TB,0,'L',220, 220, 220);
$pdf->Cell(25,5,'',TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,number_format($laba_rugi_tahun_berjalan,0,',','.'),TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,'',TB,1,'R',220, 220, 220);

$pdf->SetFont('Times','',8);
$pdf->Cell(10,5,'',TB,0,'L',220, 220, 220);
$pdf->Cell(105,5,'~ Penarikan Modal Tahun '.date('Y', strtotime($tanggal_periode)),TB,0,'L',220, 220, 220);
$pdf->Cell(25,5,'',TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,'('.number_format($penarikan_modal_tahun_berjalan,0,',','.').')',TB,0,'R',220, 220, 220);
$pdf->Cell(25,5,'',TB,1,'R',220, 220, 220);

	

$total_aktiva = $total_aktiva + $total_jenis_account;
$pdf->SetFont('Times','B',8);
$pdf->SetFillColor(255, 204, 204);
$pdf->Cell(165,5,'TOTAL AKTIVA',TB,0,'C',220, 220, 220);
$pdf->Cell(25,5,number_format($total_modal_tahun_berjalan,0,',','.'),TB,1,'R',220, 220, 220);



$pdf->Output("Perubahan Modal Per ".date('d', strtotime($tanggal_periode))." ".$bulan_indonesia[date('m', strtotime($tanggal_periode))]." ".date('Y', strtotime($tanggal_periode)).".pdf","I");
?>