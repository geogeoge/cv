<div class="modal fade" id="edit<?php echo $data['id_jenis_account'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
						<input type="text" name="id_jenis_account" id="inputEmail" class = "form-control" value="<?php echo $data['id_jenis_account'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">JENIS ACCOUNT</label>
					<div class="col-sx-10">
						<input type="text" name="jenis_account" id="inputEmail" class = "form-control" value="<?php echo $data['jenis_account'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">MASTER JENIS ACCOUNT</label>
					<div class="col-sx-10">
						<select class = "form-control" name="id_master_jenis_account" required="required">
							<?php
				            foreach($select->select_master_jenis_account() as $data_master) {
				            	$selected="";
				            	if($data['id_master_jenis_account']==$data_master['id_master_jenis_account']){
				            		$selected="selected='selected'";
				            	}
				            ?>
							<option value="<?php echo $data_master['id_master_jenis_account'];?>" <?php echo $selected;?>><?php echo $data_master['master_jenis_account'];?></option>
							<?php
							}
							?>
						</select>  
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name="edit_jenis_account" class="btn btn-warning">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                