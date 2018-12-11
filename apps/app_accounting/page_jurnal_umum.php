<?php
include "../../koneksi/koneksi.php";

$tanggal_awal= date('Y-m-d');
if(isset($_GET['tanggal_awal'])){
  $tanggal_awal = $_GET['tanggal_awal'];
}

$tanggal_akhir= date('Y-m-d');
if(isset($_GET['tanggal_akhir'])){
  $tanggal_akhir = $_GET['tanggal_akhir'];
}

$via="keterangan";
if(isset($_GET['via'])){
  $via = $_GET['via'];
}

$isi_data="";
if(isset($_GET['isi_data'])){
  $isi_data = $_GET['isi_data'];
}


?>
<section class="content-header">
  <h1>
    Jurnal Umum
    <small>
      SoloNet
    </small>
  </h1>
</section>
<!-- Main content -->

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body scroll">
          <div class="dataTables_wrapper dt-bootstrap">
            <div class="row">
              <div class="col-sm-6"></div>
              <div class="col-sm-6"></div>
            </div>

            <!-- Bagian Pencarian -->
            <div class="row">
              <form method="GET" action="?page=page_data_pelanggan">
              <div class="col-sm-2">
                
              </div>
              <div class="col-sm-12">
                <div id="example1_filter" class="dataTables_filter">

                  <label>
                    Tanggal :
                    <input type="date" name="tanggal_awal" class="form-control input-sm" value="<?php echo $tanggal_awal;?>">
                    &nbsp; S/D
                    <input type="date" name="tanggal_akhir" class="form-control input-sm" value="<?php echo $tanggal_akhir;?>">
                  </label>
                  &nbsp;
                  <label>
                    Via :
                  </label>
                  <label>
                    <select name="via" class="form-control input-sm">
                      <?php
                      if($via=="keterangan"){
                        $selected_1='selected="selected"';
                        $selected_2='';
                        $selected_3='';
                      } else
                      if($via=="no_transaksi"){
                        $selected_1='';
                        $selected_2='selected="selected"';
                        $selected_3='';
                      } else 
                      if($via=="nominal"){
                        $selected_1='';
                        $selected_2='';
                        $selected_3='selected="selected"';
                      }
                      ?>
                      <option value="keterangan" <?php echo $selected_1;?>>Keterangan</option>
                      <option value="no_transaksi" <?php echo $selected_2;?>>No Transaksi</option>
                      <option value="nominal" <?php echo $selected_3;?>>Nominal</option>
                    </select> 
                  </label>
                    &nbsp;
                  <label>
                    Data :
                    <input type="search" name="isi_data" class="form-control input-sm" value="<?php echo $isi_data;?>">
                  </label>
                  &nbsp;
                  <label>
                    <button name="page" value="page_jurnal_umum" class="btn"><i class="fa fa-search"></i></button>
                  </label>

                </div>
              </div>
              </form>
            </div>

            <!-- body table -->
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-bordered" >
                  <thead>
                    <tr>
                      <th width="100">Tanggal</th>
                      <th width="80">No Transaksi</th>
                      <th>Keterangan</th>
                      <th width="100">Nominal</th>
                      <th width="250">Debit</th>
                      <th width="250">Kredit</th>
                      <th width="80">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
                  foreach ($select->select_pertransaksi($tanggal_awal, $tanggal_akhir, $via, $isi_data) as $data_pertransaksi) {
                    $no_transaksi = $data_pertransaksi['no_transaksi'];
                    $tanggal = $data_pertransaksi['tanggal'];
                    $keterangan = $data_pertransaksi['keterangan'];
                    $id_temp = $data_pertransaksi['id_temp'];
                    $nominal = $data_pertransaksi['nominal'];

                    $pecah_no_transaksi = explode(".", $no_transaksi);
                    $id_modal = implode("", $pecah_no_transaksi)
                  ?>  
                    <tr>
                      <td align="center"><?php echo date('d-m-Y', strtotime($tanggal)); ?></td>
                      <td align="center"><?php echo $no_transaksi; ?></td>
                      <td align="left"><?php echo $keterangan; ?></td>
                    <?php
                    
                    //perulangan akun debit
                    foreach ($select->select_pertransaksi_detail($no_transaksi, 'D') as $data_debit) {
                    ?>
                      <td align="right"><?php echo number_format($data_debit['nominal'],0,',','.'); ?></td>
                      <td align="left"><?php echo $data_debit['nama_account']; ?></td>
                    <?php
                    }
                    //batas perulangan akun debit
                    ?>

                    <?php
                    //perulangan akun debit
                    foreach ($select->select_pertransaksi_detail($no_transaksi, 'K') as $data_kredit) {
                    ?>
                      <td align="left"><?php echo $data_kredit['nama_account']; ?></td>
                    <?php
                    }
                    //batas perulangan akun debit
                    ?>
                    <?php
                    ?>
                      <td align="center">
                        <a href="#edit_jurnal_umum<?php echo $id_modal;?>" role="button"  data-target = "#edit_jurnal_umum<?php echo $id_modal;?>" data-toggle="modal" class="btn btn-xs btn-warning">&nbsp;<i class="fa fa-edit"></i>&nbsp;</a>
                        <a href="#modal_konfirmasi_batal_posting<?php echo $id_modal;?>" role="button"  data-target = "#modal_konfirmasi_batal_posting<?php echo $id_modal;?>" data-toggle="modal" class="btn btn-xs btn-danger">&nbsp;<i class="fa fa-close"></i>&nbsp;</a>
                      </td>
                    </tr>
                    <?php
                    include "modal_konfirmasi_batal_posting.php";
                    include "modal_edit_jurnal_umum.php";
                  }
                  ?>
                  <?php
                  //ini tampil jika masih blm ada transaksi
                  if(!($select->select_pertransaksi($tanggal_awal, $tanggal_akhir, $via, $isi_data))) {
                    ?>
                    <tr class="odd">
                      <td valign="top" colspan="7" align="center" class="dataTables_empty">Maaf, Data yang kamu cari tidak ada gan !</td>
                    </tr>
                    <?php
                  }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
            
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>