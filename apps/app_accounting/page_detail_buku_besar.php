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


$id_account="";
if(isset($_GET['id_account'])){
  $id_account = $_GET['id_account'];
}

$query_account=mysqli_query($koneksi,"SELECT * FROM `account` WHERE id_account='$id_account'");
$data_account=mysqli_fetch_array($query_account);

?>
<section class="content-header">
  <h1>
    Tabel Account <strong><?php echo $data_account['nama_account'];?></strong>
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
                    <input type="text" name="id_account" class="form-control input-sm" value="<?php echo $id_account;?>" style="display: none;">
                    Tanggal :
                    <input type="date" name="tanggal_awal" class="form-control input-sm" value="<?php echo $tanggal_awal;?>">
                    &nbsp; S/D
                    <input type="date" name="tanggal_akhir" class="form-control input-sm" value="<?php echo $tanggal_akhir;?>">
                  </label>
                  &nbsp;
                  <label>
                    <button name="page" value="page_detail_buku_besar" class="btn"><i class="fa fa-search"></i></button>
                  </label>

                </div>
              </div>
              </form>
            </div>

            <!-- body table -->
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th width="150">Tanggal</th>
                      <th width="150">No Transaksi</th>
                      <th>Keterangan</th>
                      <th width="150">Debit</th>
                      <th width="150">Kredit</th>
                      <th width="80">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $total_debit = 0;
                    $total_kredit = 0;
                    foreach ($select->select_detail_buku_besar($tanggal_awal, $tanggal_akhir, $id_account) as $data) {
                      $DK=$data['DK'];
                      
                      $no_transaksi = $data['no_transaksi'];
                      $pecah_no_transaksi = explode(".", $no_transaksi);
                      $id_modal = implode("", $pecah_no_transaksi)
                    ?>  
                      <tr>
                        <td align="center"><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                        <td align="center"><?php echo $data['no_transaksi']; ?></td>
                        <td align="left"><?php echo $data['keterangan']; ?></td>
                        <?php
                        if($DK=="D"){
                          $total_debit = $total_debit + $data['nominal'];
                        ?>
                        <td align="right"><?php echo number_format($data['nominal'],0,',','.'); ?></td>
                        <td align="right"><?php echo "-"; ?></td>
                        <?php
                        } else {
                          $total_kredit = $total_kredit + $data['nominal'];
                        ?>
                        <td align="right"><?php echo "-"; ?></td>
                        <td align="right"><?php echo number_format($data['nominal'],0,',','.'); ?></td>
                        <?php
                        }
                        ?>
                        <td align="center">
                            <a href="#edit_jurnal_umum<?php echo $id_modal;?>" role="button"  data-target = "#edit_jurnal_umum<?php echo $id_modal;?>" data-toggle="modal" class="btn btn-xs btn-warning">&nbsp;<i class="fa fa-edit"></i>&nbsp;</a>
                        </td>
                      </tr>
                      <?php
                      include "modal_edit_account_buku_besar.php";
                    }
                    //ini tampil jika masih blm ada transaksi
                    if(!($select->select_detail_buku_besar($tanggal_awal, $tanggal_akhir, $id_account))) {
                      ?>
                      <tr class="odd">
                        <td valign="top" colspan="6" class="dataTables_empty" align="center">Maaf, Data yang kamu cari tidak ada gan !</td>
                      </tr>
                      <?php
                    }
                    ?>
                    <tr style="border-top-width: ">
                      <td colspan="3"><strong>Total</strong></td>
                      <td width="150" align="right"><strong><?php echo number_format($total_debit,0,',','.'); ?></strong></td>
                      <td width="150" align="right"><strong><?php echo number_format($total_kredit,0,',','.'); ?></strong></td>
                      <td> </td>
                    </tr>
                    <tr style="background-color: #ddd;">
                      <td colspan="3"><strong>SALDO</strong></td>
                      <td colspan="2" align="center"><strong><?php echo number_format($select->select_jumlah_nominal_per_account_debit($id_account, $tanggal_awal, $tanggal_akhir),0,',','.'); ?></strong></td>
                      <td> </td>
                    </tr>
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