<?php
include "../../koneksi/koneksi.php";

$data_cari = "";
if(isset($_GET['data_cari'])){
  $data_cari = $_GET['data_cari'];
}

?>
<section class="content-header">
  <h1>
    Tabel <strong>Account</strong>
    <small>
      SoloNet
    </small>
    <a href="#tambah" role="button"  data-target = "#tambah" data-toggle="modal" class="btn btn-primary pull-right">Tambah Jenis Account</a>
  </h1>
</section>
<!-- Main content -->
<?php include "modal_tambah_account.php";?>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body scroll">
          <div class="dataTables_wrapper dt-bootstrap">

            <!-- body table -->
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-condensed">
                  <tbody>
                    <?php
                    foreach ($select->select_jenis_account($data_cari) as $data) {
                      $id_jenis_account =  $data['id_jenis_account'];
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
                        <td align="left" height="40" valign="bottom" width="20"><strong><?php echo $id_master_jenis_account.".".$kode_jenis; ?></strong></td>
                        <td align="left" colspan="3" height="40" valign="bottom"><strong><?php echo $data['jenis_account']; ?></strong></td>
                      </tr>
                      <?php
                      $kode = 0;
                      foreach ($select->select_account_left_join_jenis_account($id_jenis_account) as $data_account) {
                        $kode = $kode + 1;
                        if(!($id_account = $data_account['id_account'])){
                          $kode = 0;
                        }
                        $id_account = $data_account['id_account'];
                        ?>
                        <tr>
                          <td align="left" width="30">&nbsp;</td>
                          <td align="left" width="40"><?php echo $id_master_jenis_account.".".$kode_jenis.".".$kode; ?></td>
                          <td align="left"><?php echo $data_account['nama_account']; ?></td>
                          <td align="left" width="100">
                            <a href="#edit<?php echo $data_account['id_account']; ?>" role="button"  data-target = "#edit<?php echo $data_account['id_account']; ?>" data-toggle="modal" class="btn btn-warning">&nbsp;<i class="fa fa-edit"></i></a>

                            <a href="#hapus<?php echo $data_account['id_account']; ?>" role="button"  data-target = "#hapus<?php echo $data_account['id_account']; ?>" data-toggle="modal" class="btn btn-danger">&nbsp;<i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php
                        include "modal_edit_account.php";
                        include "modal_konfirmasi_hapus_account.php";
                      }
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