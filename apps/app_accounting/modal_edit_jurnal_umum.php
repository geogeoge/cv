<div class="modal fade" id="edit_jurnal_umum<?php echo $id_modal;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>PERIODE</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="hidden">
					<label class="col-sx-2 control-label" for="inputEmail">Tanggal Awal</label>
					<div class="col-sx-10">
						<input type="text" name="no_transaksi" id="inputEmail" class = "form-control" value="<?php echo $no_transaksi; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">ID Debit</label>
					<div class="col-sx-10">
						<input type="text" name="id_transaksi_debit" id="inputEmail" class = "form-control" value="<?php echo $data_debit['id_transaksi'];?>">
					</div>
				</div>
				<div cla
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">ID Kredir</label>
					<div class="col-sx-10">
						<input type="text" name="id_transaksi_kredit" id="inputEmail" class = "form-control" value="<?php echo $data_kredit['id_transaksi'];?>">
					</div>
				</div>
				<div cla
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Tanggal</label>
					<div class="col-sx-10">
						<input type="date" name="tanggal" id="inputEmail" class = "form-control" value="<?php echo $tanggal;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Keterangan</label>
					<div class="col-sx-10">
						<textarea class="form-control" name="keterangan" rows="3"><?php echo $keterangan;?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nominal</label>
					<div class="col-sx-10">
						<input type="text" name="nominal" id="inputEmail" class = "form-control" value="<?php echo $data_pertransaksi['nominal'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Debit</label>
					<div class="col-sx-10">
						<select class="form-control" name="debit" required="required">
		                  <option></option>
		                  <?php
                          foreach ($select->select_account() as $edit_debit) {
                              $selected="";
                              if($data_debit['id_account'] == $edit_debit['id_account']){
                                  $selected = "selected='selected'";
                              }
                            ?>
                            <option value="<?php echo $edit_debit['id_account'];?>" <?php echo $selected;?>><?php echo $edit_debit['nama_account'];?></option>
                            <?php
                          }
                          ?>
		                </select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Kredit</label>
					<div class="col-sx-10">
						<select class="form-control" name="kredit" required="required">
		                  <option></option>
		                  <?php
                          foreach ($select->select_account() as $edit_kredit) {
                              $selected="";
                              if($data_kredit['id_account'] == $edit_kredit['id_account']){
                                  $selected = "selected='selected'";
                              }
                            ?>
                            <option value="<?php echo $edit_kredit['id_account'];?>" <?php echo $selected;?>><?php echo $edit_kredit['nama_account'];?></option>
                            <?php
                          }
                          ?>
		                </select>
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "edit_jurnal_umum" class="btn btn-info">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                