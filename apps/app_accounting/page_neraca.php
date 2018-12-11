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
$tanggal_awal_bulan_berjalan = date('Y-', strtotime($tanggal_periode))."01-01";

$tanggal_akhir_yang_ditahan = date('Y-m-d', strtotime('-1 days', strtotime($tanggal_awal_bulan_berjalan)));
$tanggal_akhir_bulan_bejalan = $tanggal_periode;
?>
<section class="content-header">
  <h1 class="">
    <a href="#modal_periode" role="button"  data-target = "#modal_periode" data-toggle="modal" class="btn btn-primary">Periode</a>
    &nbsp;
    <a href="pdf_neraca.php?tanggal_periode=<?php echo $tanggal_periode;?>" target="_blank" class="btn btn-primary">Download</a>
  </h1>
</section>
<?php include "modal_opsi_neraca.php";?>

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
              <strong>Neraca</strong>
              <br>
              <small>Periode <?php echo date('d', strtotime($tanggal_periode))." ".$bulan_indonesia[date('m', strtotime($tanggal_periode))]." ".date('Y', strtotime($tanggal_periode));?></small>
            </h3>
          </center>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">

          <table class="table table-condensed">
            <!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ KOLONG AKTIVA ////////////////////////////// -->
            <tr>
              <td colspan="5" align="center" style="border-top-width: 4px; border-top-color: black;"><strong>AKTIVA</strong></td>
            </tr>

            <?php
            $total_aktiva = 0;
            foreach($select->select_jenis_account_where_id_master_jenis_account('1') as $data_jenis_account) {
              $id_jenis_account=$data_jenis_account['id_jenis_account'];
              $jenis_account=$data_jenis_account['jenis_account'];
              $total_jenis_account=0;
              ?>
              <tr>
                <td colspan="5"><?php echo $jenis_account;?></td>
              </tr>
              <?php
              foreach ($select->select_account_where_id_jenis_account($id_jenis_account) as $data_account) {
                $id_account = $data_account['id_account'];
                $nama_account = $data_account['nama_account'];
                $nominal = $select->select_jumlah_nominal_per_account_debit($id_account, $tanggal_awal, $tanggal_periode);
                ?>
                <tr>
                  <td width="50">&nbsp;</td>
                  <td><?php echo $nama_account;?></td>
                  <td width="200" align="right"><?php echo number_format($nominal,0,',','.');?></td>
                  <td width="200" align="right">&nbsp;</td>
                  <td width="200" align="right">&nbsp;</td>
                </tr>
                <?php
                $total_jenis_account = $total_jenis_account + $nominal;
              }
              ?>
              <tr>
                <td colspan="2" align="center">Jumlah <?php echo $jenis_account;?></td>
                <td width="200" align="right" style="border-top-width: 2px; border-top-color: black;">&nbsp;</td>
                <td width="200" align="right"><?php echo number_format($total_jenis_account,0,',','.');?></td>
                <td width="200" align="right">&nbsp;</td>
              </tr>
              <?php
              $total_aktiva = $total_aktiva + $total_jenis_account;
            }
            ?>

            <tr style="background-color: #ddd; border-bottom-width: 4px; border-bottom-color: black;">
              <td colspan="3" align="center"><strong>TOTAL AKTIVA</strong></td>
              <td width="200" align="right" style="border-top-width: 2px; border-top-color: black;">&nbsp;</td>
              <td width="200" align="right"><strong><?php echo number_format($total_aktiva,0,',','.');?></strong></td>
            </tr>

            <!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ KOLONG PASIVA ////////////////////////////// -->
            <tr>
              <td colspan="5" align="center" style="border-top-width: 4px; border-top-color: black;"><strong>PASIVA</strong></td>
            </tr>

            <?php
            $total_pasiva = 0;
            foreach($select->select_jenis_account_where_id_master_jenis_account('2') as $data_jenis_account) {
              $id_jenis_account=$data_jenis_account['id_jenis_account'];
              $jenis_account=$data_jenis_account['jenis_account'];
              $total_jenis_account=0;
              ?>
              <tr>
                <td colspan="5"><?php echo $jenis_account;?></td>
              </tr>
              <?php
              foreach ($select->select_account_where_id_jenis_account($id_jenis_account) as $data_account) {
                $id_account = $data_account['id_account'];
                $nama_account = $data_account['nama_account'];
                $nominal = $select->select_jumlah_nominal_per_account_kredit($id_account, $tanggal_awal, $tanggal_periode);
                ?>
                <tr>
                  <td width="50">&nbsp;</td>
                  <td><?php echo $nama_account;?></td>
                  <td width="200" align="right"><?php echo number_format($nominal,0,',','.');?></td>
                  <td width="200" align="right">&nbsp;</td>
                  <td width="200" align="right">&nbsp;</td>
                </tr>
                <?php
                $total_jenis_account = $total_jenis_account + $nominal;
              }
              ?>
              <tr>
                <td colspan="2" align="center">Jumlah <?php echo $jenis_account;?></td>
                <td width="200" align="right" style="border-top-width: 2px; border-top-color: black;">&nbsp;</td>
                <td width="200" align="right"><?php echo number_format($total_jenis_account,0,',','.');?></td>
                <td width="200" align="right">&nbsp;</td>
              </tr>
              <?php
              $total_pasiva = $total_pasiva + $total_jenis_account;
            }
            ?>

            <?php
            foreach($select->select_jenis_account_where_id_master_jenis_account('3') as $data_jenis_account) {
              $id_jenis_account=$data_jenis_account['id_jenis_account'];
              $jenis_account=$data_jenis_account['jenis_account'];
              $total_jenis_account=0;
              ?>
              <tr>
                <td colspan="5"><?php echo $jenis_account;?></td>
              </tr>
              <?php
              foreach ($select->select_account_where_id_jenis_account($id_jenis_account) as $data_account) {
                $id_account = $data_account['id_account'];
                $nama_account = $data_account['nama_account'];
                $nominal_account = $select->select_jumlah_nominal_per_account_kredit($id_account, $tanggal_awal, $tanggal_periode);

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
                ?>
                <tr>
                  <td width="50">&nbsp;</td>
                  <td><?php echo $nama_account;?></td>
                  <td width="200" align="right"><?php echo number_format($total_nominal,0,',','.');?></td>
                  <td width="200" align="right">&nbsp;</td>
                  <td width="200" align="right">&nbsp;</td>
                </tr>
                <?php
              }
              ?>
              <tr>
                <td colspan="2" align="center">Jumlah <?php echo $jenis_account;?></td>
                <td width="200" align="right" style="border-top-width: 2px; border-top-color: black;">&nbsp;</td>
                <td width="200" align="right"><?php echo number_format($total_nominal,0,',','.');?></td>
                <td width="200" align="right">&nbsp;</td>
              </tr>
              <?php
              $total_pasiva = $total_pasiva + $total_nominal;
            }
            ?>

            <tr style="background-color: #ddd; border-bottom-width: 4px; border-bottom-color: black;">
              <td colspan="3" align="center"><strong>TOTAL PASIVA</strong></td>
              <td width="200" align="right" style="border-top-width: 2px; border-top-color: black;">&nbsp;</td>
              <td width="200" align="right"><strong><?php echo number_format($total_pasiva,0,',','.');?></strong></td>
            </tr>
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

