<div class="modal fade" id="modal_batal_transaksi<?php echo $data['id_temp']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><center><strong>BATALKAN TRANSAKSI</strong></center></h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger">Yakin akan membatalkan transaksi "<strong><?php echo $data['keterangan']; ?></strong>" ?</div>
				</div>
				<div hidden="true">
					<input type="text" name="id_temp" value="<?php echo $data['id_temp']; ?>" />
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i>&nbsp;Tidak</button>
					<button name="batal_posting" class="btn btn-danger">Iya</button>
				</div>
			</form>
		</div>
	</div>
</div>
                