<div class="modal fade" id="edit<?php echo $data_account['id_account'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-warning"><strong><center>EDIT JENIS ACCOUNT</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="hidden">
					<label class="col-sx-2 control-label" for="inputEmail">ID JENIS ACCOUNT</label>
					<div class="col-sx-10">
						<input type="text" name="id_account" id="inputEmail" class = "form-control" value="<?php echo $data_account['id_account'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">NAMA ACCOUNT</label>
					<div class="col-sx-10">
						<input type="text" name="nama_account" id="inputEmail" class = "form-control" value="<?php echo $data_account['nama_account'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">MASTER JENIS ACCOUNT</label>
					<div class="col-sx-10">
						<select class = "form-control" name="id_jenis_account" required="required">
							<?php
				            foreach($select->select_jenis_account('') as $data_jenis) {
				            	$selected="";
				            	if($data_account['id_jenis_account']==$data_jenis['id_jenis_account']){
				            		$selected="selected='selected'";
				            	}
				            ?>
							<option value="<?php echo $data_jenis['id_jenis_account'];?>" <?php echo $selected;?>><?php echo $data_jenis['jenis_account'];?></option>
							<?php
							}
							?>
						</select>  
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name="edit_account" class="btn btn-warning">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                