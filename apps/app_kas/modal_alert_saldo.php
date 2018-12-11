<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-danger"><strong><center>PERINGATAN !!!</center></strong></div>
			</div>
			<div class="modal-body">
				<center>
				<h4 class="modal-title" id="myModalLabel">Maaf mbak, Saldo Kas Kecilnya Kurang !</h4>
				<h4><strong>Saldo : Rp. <?php echo number_format($select->select_data_kas_kecil_in() - $select->select_data_kas_kecil_out(),0,',','.');?></strong></h4>
				<h4>Silakan Isi Saldo Kas Kecil Dulu !</h4>
				</center>
			</div>
			<div class = "modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
			</div>                                
		</div>
	</div>
</div>
                