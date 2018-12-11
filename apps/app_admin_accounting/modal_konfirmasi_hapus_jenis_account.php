<div class="modal fade" id="hapus<?php echo $data['id_jenis_account']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><center><strong>HAPUS JENIS ACCOUNT</strong></center></h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger">Yakin anda ingin menghapus data "<strong><?php echo $data['jenis_account']; ?></strong>" ?</div>
				</div>
				<div hidden="true">
					<input type="text" name="id_jenis_account" value="<?php echo $data['id_jenis_account']; ?>" />
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i>&nbsp;Tidak</button>
					<button name="delete_jenis_account" class="btn btn-danger">Iya</button>
				</div>
			</form>
		</div>
	</div>
</div>
                