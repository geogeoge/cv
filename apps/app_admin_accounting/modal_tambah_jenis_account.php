<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>TAMBAH JENIS ACCOUNT</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">JENIS ACCOUNT</label>
					<div class="col-sx-10">
						<input type="text" name="jenis_account" id="inputEmail" class = "form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">MASTER JENIS ACCOUNT</label>
					<div class="col-sx-10">
						<select class = "form-control" name="id_master_jenis_account" required="required">
                  			<option selected="selected" value=""></option>
							<?php
				            foreach($select->select_master_jenis_account() as $data_master) {
				            ?>
							<option value="<?php echo $data_master['id_master_jenis_account'];?>"><?php echo $data_master['master_jenis_account'];?></option>
							<?php
							}
							?>
						</select>  
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name="insert_jenis_account" class="btn btn-info">SIMPAN</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                