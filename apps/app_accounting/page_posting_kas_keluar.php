<?php
include "../../koneksi/koneksi.php";

$tanggal_hari_ini = date('Y-m-d');

$tanggal_awal = date('Y-m-d');
if(isset($_GET['tanggal_awal'])){
  $tanggal_awal = $_GET['tanggal_awal'];
}

$tanggal_akhir = date('Y-m-d');
if(isset($_GET['tanggal_akhir'])){
  $tanggal_akhir = $_GET['tanggal_akhir'];
}

$limit="10";
if(isset($_GET['limit'])){
  $limit = $_GET['limit'];
}

?>
<section class="content-header">
  <h1>
    Posting Kas Keluar
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
              <div class="col-sm-10">
                <div id="example1_filter" class="dataTables_filter">

                  <label>
                    Tanggal :
                    <input type="date" name="tanggal_awal" class="form-control input-sm" value="<?php echo $tanggal_awal;?>">
                    &nbsp; S/D
                    <input type="date" name="tanggal_akhir" class="form-control input-sm" value="<?php echo $tanggal_akhir;?>">
                  </label>
                    &nbsp;
                  <label>
                    <select name="limit" class="form-control input-sm">
                      <?php
                      if($limit=="10"){
                        $selected_10='selected="selected"';
                        $selected_20='';
                        $selected_50='';
                        $selected_100='';
                      } else 
                      if($limit=="20"){
                        $selected_10='';
                        $selected_20='selected="selected"';
                        $selected_50='';
                        $selected_100='';
                      } else
                      if($limit=="50"){
                        $selected_10='';
                        $selected_20='';
                        $selected_50='selected="selected"';
                        $selected_100='';
                      } else
                      if($limit=="100"){
                        $selected_10='';
                        $selected_20='';
                        $selected_50='';
                        $selected_100='selected="selected"';
                      } 
                      ?>
                      <option value="10" <?php echo $selected_10;?>>10</option>
                      <option value="20" <?php echo $selected_20;?>>20</option>
                      <option value="50" <?php echo $selected_50;?>>50</option>
                      <option value="100" <?php echo $selected_100;?>>100</option>
                    </select> 
                  </label>
                  &nbsp
                  <label>
                    <button name="page" value="page_posting_kas_keluar" class="btn"><i class="fa fa-search"></i></button>
                  </label>

                </div>
              </div>
              </form>
            </div>

            <!-- body table -->
            <div class="row">
              <div class="col-sm-12">
              <form method="POST">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="150">Tanggal</th>
                      <th>Keterangan</th>
                      <th width="150">Nominal</th>
                      <th width="250">Account</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                     foreach ($select->select_data_temp_where('67', 'o', $tanggal_awal, $tanggal_akhir, $limit, 'belum') as $data) {
                    ?>
                    <tr>
                      <td align="right" hidden="hidden"><input type="text" name=id_temp[] value="<?php echo $data['id_temp']; ?>"></td>
                      <td align="center"><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                      <td align="left"><?php echo $data['keterangan']; ?></td>
                      <td align="right"><?php echo number_format($data['nominal'],0,',','.'); ?></td>
                      <td align="left">
                        <select class="select2" name=data_debit[]>
                          <option selected="selected" value="xxx"></option>
                          <?php 
                          foreach ($select->select_account_posting('8') as $data_debit) {
                            ?>
                            <option value="<?php echo $data_debit['id_account'];?>"><?php echo $data_debit['nama_account'];?></option>
                            <?php 
                          }
                          ?>
                        </select>
                      </td>
                    </tr>
                    <?php
                    }
                    //ini tampil jika masih blm ada transaksi
                    if(!($select->select_data_temp_where('67', 'o', $tanggal_awal, $tanggal_akhir, $limit, 'belum'))) {
                      ?>
                      <tr class="odd">
                        <td valign="top" colspan="5" align="center" class="dataTables_empty">Maaf, Tidak ada data !</td>
                      </tr>
                      <?php
                    } else {
                      ?>
                      <tr>
                        <td colspan="5" align="right"><input type="submit" name="posting_kas_keluar" value="POST" class="btn btn-primary"></td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </form>
              </div>
            </div>

            <!-- Pageination -->
            <div class="row">
              <div class="col-sm-5">
                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite"></div>
              </div>
              <div class="col-sm-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  <ul class="pagination">
                    <?php
                    $bulan_ini=date('Y-m', strtotime($tanggal_hari_ini));
                    $tanggal_page=$bulan_ini."-01";
                    ?>
                    <li class="paginate_button previous" id="example2_previous"><a href="?page=page_posting_kas_keluar&tanggal_awal=<?php echo $tanggal_page?>&tanggal_akhir=<?php echo $tanggal_page?>&limit=<?php echo $limit?>" aria-controls="example2" data-dt-idx="0" tabindex="0">Awal Bulan</a></li>
                    <?php
                    //agar tnaggal paginatin rapi
                    $tanggal_hari_ini_kurangi_6=date('Y-m-d', strtotime('-5 days', strtotime($tanggal_hari_ini)));
                    if($tanggal_akhir>=$tanggal_hari_ini_kurangi_6){

                      $tanggal_page=date('Y-m-d', strtotime('-6 days', strtotime($tanggal_hari_ini)));
                      for ($i= 1; $i <= 7; $i++) {
                        
                        $tanggal_tok=date('d', strtotime($tanggal_page));
                        if($tanggal_akhir==$tanggal_page) {
                          $active="active";
                        } else {
                          $active="";
                        }
                        ?>
                        <li class="paginate_button <?php echo $active; ?>"><a href="?page=page_posting_kas_keluar&tanggal_awal=<?php echo $tanggal_page; ?>&tanggal_akhir=<?php echo $tanggal_page; ?>&limit=<?php echo $limit?>" aria-controls="example2" data-dt-idx="1" tabindex="0"><?php echo $tanggal_tok; ?></a></li>
                        <?php
                        $tanggal_page=date('Y-m-d', strtotime('+1 days', strtotime($tanggal_page)));
                      }
                      
                    } else {

                      $tanggal_page=date('Y-m-d', strtotime('-3 days', strtotime($tanggal_akhir)));
                      for ($i= 1; $i <= 7; $i++) {
                        $tanggal_tok=date('d', strtotime($tanggal_page));
                        if($tanggal_akhir==$tanggal_page) {
                          $active="active";
                        } else {
                          $active="";
                        }
                        ?>
                        <li class="paginate_button <?php echo $active; ?>"><a href="?page=page_posting_kas_keluar&tanggal_awal=<?php echo $tanggal_page; ?>&tanggal_akhir=<?php echo $tanggal_page; ?>&limit=<?php echo $limit?>" aria-controls="example2" data-dt-idx="1" tabindex="0"><?php echo $tanggal_tok; ?></a></li>
                        <?php
                        $tanggal_page=date('Y-m-d', strtotime('+1 days', strtotime($tanggal_page)));
                      }

                    }
                    ?>

                    <li class="paginate_button next" id="example2_next"><a href="?page=page_posting_kas_keluar" aria-controls="example2" data-dt-idx="7" tabindex="0">Hari Ini</a></li>
                  </ul>
                </div>
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