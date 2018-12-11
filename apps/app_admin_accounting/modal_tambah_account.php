<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>TAMBAH ACCOUNT</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">NAMA ACCOUNT</label>
					<div class="col-sx-10">
						<input type="text" name="nama_account" id="inputEmail" class = "form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">JENIS ACCOUNT</label>
					<div class="col-sx-10">
						<select class = "form-control" name="id_jenis_account" required="required">
                  			<option selected="selected" value=""></option>
							<?php
				            foreach($select->select_jenis_account('') as $data_jenis) {
				            ?>
							<option value="<?php echo $data_jenis['id_jenis_account'];?>"><?php echo $data_jenis['jenis_account'];?></option>
							<?php
							}
							?>
						</select>  
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name="insert_account" class="btn btn-info">SIMPAN</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                