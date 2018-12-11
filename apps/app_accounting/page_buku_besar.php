<section class="content-header">
  <h1 class="">
    Buku Besar
    <small>SoloNet</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data Akun</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="15">No</th>
              <th>Nama Akun</th>
              <th width="300">Jenis Akun</th>
              <th width="80">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach ($select->select_account_left_join_jenis_account() as $data) {
              $id_account = $data['id_account'];
              $pecah_id_account = explode(".", $id_account);
              $id_id_account = implode("", $pecah_id_account);
            ?>
            <tr>
              <td align="center"><?php echo $no; ?></td>
              <td align="left"><?php echo $data['nama_account']; ?></td>
              <td align="center"><?php echo $data['jenis_account']; ?></td>
              <td align="center">
                <a href="#modal_opsi_buku_besar<?php echo $id_account; ?>" role="button"  data-target = "#modal_opsi_buku_besar<?php echo $id_account; ?>" data-toggle="modal" class="btn btn-info"><i class="fa fa-search"></i></a>
              </td>
            </tr>
          <?php
          $no++;
          include "modal_opsi_buku_besar.php";
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>No</th>
              <th>Nama Akun</th>
              <th>Jenis Akun</th>
              <th>Action</th>
            </tr>

            </tfoot>
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

