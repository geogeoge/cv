<div class="modal fade" id="edit_jurnal_umum<?php echo $id_modal;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>PERIODE</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Tanggal Awal</label>
					<div class="col-sx-10">
						<input type="text" name="id_transaksi" id="inputEmail" class = "form-control" value="<?php echo $data['id_transaksi']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Account Baru</label>
					<div class="col-sx-10">
						<select class="form-control" name="id_account" required="required">
		                  <option></option>
		                  <?php
                          foreach ($select->select_account() as $edit_account) {
                              $selected="";
                              if($edit_account['id_account'] == $data['id_account']){
                                  $selected = "selected='selected'";
                              }
                            ?>
                            <option value="<?php echo $edit_account['id_account'];?>" <?php echo $selected;?>><?php echo $edit_account['nama_account'];?></option>
                            <?php
                          }
                          ?>
		                </select>
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "edit_account_buku_besar" class="btn btn-info">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                