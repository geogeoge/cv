<?php
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
?>
<section class="content-header">
  <h1 class="">
    <a href="#modal_periode" role="button"  data-target = "#modal_periode" data-toggle="modal" class="btn btn-primary">Periode</a>
    &nbsp;
    <a href="pdf_perubahan_modal.php?tanggal_periode=<?php echo $tanggal_periode;?>" target="_blank" class="btn btn-primary">Download</a>
  </h1>
</section>
<?php include "modal_opsi_perubahan_modal.php";?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <center>
            <h2>
              <strong>CV. CONNECTIS JATI INFORMATIKA</strong>
            </h2>
            <h3>
              <strong>Laporan Perubahan Modal</strong>
              <br>
              <small>Periode <?php echo date('d', strtotime($tanggal_periode))." ".$bulan_indonesia[date('m', strtotime($tanggal_periode))]." ".date('Y', strtotime($tanggal_periode));?></small>
            </h3>
          </center>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">

          <table class="table table-condensed">
            <!-- //////////////////////////////////////////// PENDAPATAN //////////////////////////////////////////// -->
            <?php
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
            ?>

            <tr>
              <td colspan="5"><strong>PERUBAHAN MODAL TAHUN <?php echo date('Y', strtotime($tanggal_periode));?></strong></td>
            </tr>
            <tr>
              <td width="50">&nbsp;</td>
              <td>Modal Tahun Sebelumnya</td>
              <td width="200" align="right">&nbsp;</td>
              <td width="200" align="right"><?php echo number_format($total_modal_tahun_sebelumnya,0,',','.');?></td>
              <td width="200" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td width="50">&nbsp;</td>
              <td>Penambahan Modal Tahun <?php echo date('Y', strtotime($tanggal_periode));?></td>
              <td width="200" align="right">&nbsp;</td>
              <td width="200" align="right"><?php echo number_format($penambahan_modal_tahun_berjalan,0,',','.');?></td>
              <td width="200" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td width="50">&nbsp;</td>
              <td>Laba/Rugi Tahun <?php echo date('Y', strtotime($tanggal_periode));?></td>
              <td width="200" align="right">&nbsp;</td>
              <td width="200" align="right"><?php echo number_format($laba_rugi_tahun_berjalan,0,',','.');?></td>
              <td width="200" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td width="50">&nbsp;</td>
              <td><strong>Jumlah Modal Tahun <?php echo date('Y', strtotime($tanggal_periode));?></strong></td>
              <td width="200" align="right">&nbsp;</td>
              <td width="200" align="right" style="border-top-width: 2px; border-top-color: black;"><strong><?php echo number_format($jumlah_modal_tahun_berjalan,0,',','.');?></strong></td>
              <td width="200" align="right">&nbsp;</td>
            </tr>
            <tr>
              <td width="50">&nbsp;</td>
              <td><font style="margin-left: 20px;">~ Penarikan Modal Tahun <?php echo date('Y', strtotime($tanggal_periode));?></font></td>
              <td width="200" align="right">&nbsp;</td>
              <td width="200" align="right">( <?php echo number_format($penarikan_modal_tahun_berjalan,0,',','.');?> )</td>
              <td width="200" align="right">&nbsp;</td>
            </tr>

            <tr style="background-color: #ddd; border-bottom-width: 4px; border-bottom-color: black;">
              <td colspan="3" align="center" ><strong>MODAL AKHIR</strong></td>
              <td width="200" align="right"  style="border-top-width: 3px; border-top-color: black;">&nbsp;</td>
              <td width="200" align="right"><strong><?php echo number_format($total_modal_tahun_berjalan,0,',','.');?></strong></td>
            </tr>
          </table>


        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

