<?php
include "../../koneksi/koneksi.php";

$data_cari = "";
if(isset($_GET['data_cari'])){
  $data_cari = $_GET['data_cari'];
}
?>
<section class="content-header">
  <h1>
    Tabel <strong>Jenis Account</strong>
    <small>
      SoloNet
    </small>
    <a href="#tambah" role="button"  data-target = "#tambah" data-toggle="modal" class="btn btn-primary pull-right">Tambah Jenis Account</a>
  </h1>
</section>
<!-- Main content -->
<?php include "modal_tambah_jenis_account.php";?>

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
                    Cari :
                    <input type="text" name="data_cari" class="form-control input-sm" value="<?php echo $data_cari;?>">
                  </label>
                  &nbsp;
                  <label>
                    <button name="page" value="page_jenis_account" class="btn"><i class="fa fa-search"></i></button>
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
                      <th width="80">Kode</th>
                      <th>Jenis Account</th>
                      <th>Master Account</th>
                      <th width="150">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    foreach ($select->select_jenis_account($data_cari) as $data) {
                      $id_master_jenis_account = $data['id_master_jenis_account'];
                      if($id_master_jenis_account==1){
                        $kode_jenis_1=$kode_jenis_1 + 1;
                        $kode_jenis=$kode_jenis_1;
                      } else
                      if($id_master_jenis_account==2){
                        $kode_jenis_2=$kode_jenis_2 + 1;
                        $kode_jenis=$kode_jenis_2;
                      } else
                      if($id_master_jenis_account==3){
                        $kode_jenis_3=$kode_jenis_3 + 1;
                        $kode_jenis=$kode_jenis_3;
                      } else
                      if($id_master_jenis_account==4){
                        $kode_jenis_4=$kode_jenis_4 + 1;
                        $kode_jenis=$kode_jenis_4;
                      } else {
                        $kode_jenis_5=$kode_jenis_5 + 1;
                        $kode_jenis=$kode_jenis_5;
                      }
                    ?>  
                      <tr>
                        <td align="center"><?php echo $data['id_master_jenis_account'].".".$kode_jenis; ?></td>
                        <td align="left"><?php echo $data['jenis_account']; ?></td>
                        <td align="center"><?php echo $data['master_jenis_account']; ?></td>
                        <td align="center">
                          <a href="#edit<?php echo $data['id_jenis_account']; ?>" role="button"  data-target = "#edit<?php echo $data['id_jenis_account']; ?>" data-toggle="modal" class="btn btn-warning">&nbsp;<i class="fa fa-edit"></i></a>

                          <a href="#hapus<?php echo $data['id_jenis_account']; ?>" role="button"  data-target = "#hapus<?php echo $data['id_jenis_account']; ?>" data-toggle="modal" class="btn btn-danger">&nbsp;<i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php
                      include "modal_edit_jenis_account.php";
                      include "modal_konfirmasi_hapus_jenis_account.php";
                    }
                    //ini tampil jika masih blm ada transaksi
                    if(!($select->select_jenis_account($data_cari))) {
                      ?>
                      <tr class="odd">
                        <td valign="top" colspan="4" class="dataTables_empty" align="center">Maaf, Data yang kamu cari tidak ada gan !</td>
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