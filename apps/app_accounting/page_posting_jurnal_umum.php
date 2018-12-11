<!-- Main content -->
<section class="content">
  <div class="row">      
    <div class="col-md-12">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Form Posting Jurnal Umum</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-10">
                <input type="date" name="tanggal" class="form-control" id="inputPassword3" value="<?php echo date('Y-m-d');?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="keterangan" rows="3"></textarea>  
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nominal</label>
              <div class="col-sm-10">
                <input type="text" id="inputku" class="form-control" name="nominal" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php echo '';?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Debit</label>
              <div class="col-sm-10">
                <select class="form-control" name="debit" required="required">
                  <option selected="selected" disabled="disabled"></option>
                  <?php
                  foreach ($select->select_account() as $data_debit) {
                    ?>
                    <option value="<?php echo $data_debit['id_account'];?>"><?php echo $data_debit['nama_account'];?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Kredit</label>
              <div class="col-sm-10">
                <select class="form-control" name="kredit" required="required">
                  <option selected="selected" disabled="disabled"></option>
                  <?php
                  foreach ($select->select_account() as $data_kredit) {
                    ?>
                    <option value="<?php echo $data_kredit['id_account'];?>"><?php echo $data_kredit['nama_account'];?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="?page=page_posting_jurnal_umum" class="btn btn-default">Reset</a>
            <button name="post_jurnal_umum" class="btn btn btn-primary pull-right">Post</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>