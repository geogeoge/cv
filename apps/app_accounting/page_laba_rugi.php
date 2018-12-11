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

$tanggal_awal = date('Y-m')."-01";
if(isset($_GET['tanggal_awal'])){
  $tanggal_awal = $_GET['tanggal_awal'];
}

$tanggal_akhir = date('Y-m-d');
if(isset($_GET['tanggal_akhir'])){
  $tanggal_akhir = $_GET['tanggal_akhir'];
}
?>
<section class="content-header">
  <h1 class="">
    <a href="#modal_periode" role="button"  data-target = "#modal_periode" data-toggle="modal" class="btn btn-primary">Periode</a>
    &nbsp;
    <a href="pdf_laba_rugi.php?tanggal_awal=<?php echo $tanggal_awal;?>&tanggal_akhir=<?php echo $tanggal_akhir;?>" target="_blank" class="btn btn-primary">Download</a>
  </h1>
</section>
<?php include "modal_opsi_laba_rugi.php";?>
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
              <strong>Laporan Laba/Rugi</strong>
              <br>
              <small><?php echo date('d', strtotime($tanggal_awal))." ".$bulan_indonesia[date('m', strtotime($tanggal_awal))]." ".date('Y', strtotime($tanggal_awal));?> s/d <?php echo date('d', strtotime($tanggal_akhir))." ".$bulan_indonesia[date('m', strtotime($tanggal_akhir))]." ".date('Y', strtotime($tanggal_akhir));?></small>
            </h3>
          </center>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">

          <table class="table table-condensed">
            <!-- //////////////////////////////////////////// PENDAPATAN //////////////////////////////////////////// -->
            <tr>
              <td colspan="4" style="border-top-width: 4px; border-top-color: black;"><strong>PENDAPATAN</strong></td>
            </tr>
            <?php
            $total_pendapatan = 0;
            foreach ($select->select_jenis_account_where_id_master_jenis_account('4') as $data_jenis_account) {
              $id_jenis_account=$data_jenis_account['id_jenis_account'];
              foreach ($select->select_account_where_id_jenis_account($id_jenis_account) as $data_account) {
                $id_account = $data_account['id_account'];
                $nominal = $select->select_jumlah_nominal_per_account_kredit($id_account, $tanggal_awal, $tanggal_akhir);
            ?>
            <tr>
              <td width="50">&nbsp;</td>
              <td><?php echo $data_account['nama_account'];?></td>
              <td width="200" align="right"><?php echo number_format($nominal,0,',','.');?></td>
              <td width="200" align="right">&nbsp;</td>
            </tr>
            <?php
              $total_pendapatan = $total_pendapatan + $nominal;
              }

            }
            ?>
            <tr>
              <td colspan="2" align="center"><strong>TOTAL PENDAPATAN</strong></td>
              <td width="200" align="right" style="border-top-width: 2px; border-top-color: black;">&nbsp;</td>
              <td width="200" align="right"><strong><?php echo number_format($total_pendapatan,0,',','.');?></strong></td>
            </tr>

            <tr>
              <td colspan="4"><strong>&nbsp;</strong></td>
            </tr>
            <!-- //////////////////////////////////////////// BIAYA //////////////////////////////////////////// -->
            <tr>
              <td colspan="4"><strong>BIAYA</strong></td>
            </tr>
            <?php
            $total_biaya = 0;
            foreach ($select->select_jenis_account_where_id_master_jenis_account('5') as $data_jenis_account) {
              $id_jenis_account=$data_jenis_account['id_jenis_account'];
              foreach ($select->select_account_where_id_jenis_account($id_jenis_account) as $data_account) {
                $id_account = $data_account['id_account'];
                $nominal = $select->select_jumlah_nominal_per_account_debit($id_account, $tanggal_awal, $tanggal_akhir);
            ?>
            <tr>
              <td width="50">&nbsp;</td>
              <td><?php echo $data_account['nama_account'];?></td>
              <td width="200" align="right"><?php echo number_format($nominal,0,',','.');?></td>
              <td width="200" align="right">&nbsp;</td>
            </tr>
            <?php
              $total_biaya = $total_biaya + $nominal;
              }
            }
            ?>
            <tr>
              <td colspan="2" align="center"><strong>TOTAL BIAYA</strong></td>
              <td width="200" align="right" style="border-top-width: 2px; border-top-color: black;">&nbsp;</td>
              <td width="200" align="right"><strong><?php echo number_format($total_biaya,0,',','.');?></strong></td>
            </tr>

            <tr>
              <td colspan="4"><strong>&nbsp;</strong></td>
            </tr>

            <tr style="background-color: #ddd; border-bottom-width: 4px; border-bottom-color: black;">
              <td colspan="3" align="center" ><strong>LABA/RUGI</strong></td>
              <td width="200" align="right" style="border-top-width: 3px; border-top-color: black;"><strong><?php echo number_format($total_pendapatan-$total_biaya,0,',','.');?></strong></td>
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

