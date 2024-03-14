<script type="text/javascript">
	$(document).ready(function() {
		$(".opsi input").removeAttr('required');
		$(".opsi select").removeAttr('required');
		$(".tipe").each(function() {
			$(this).change(function() {
				var did = $(this).attr('data-id');
				$(".opsi").attr('style', 'display:none');
				$(".opsi input").removeAttr('required');
				$(".opsi select").removeAttr('required');
				$("#div_" + did).show();
				$("#div_" + did + " input").attr('required', 'required');
			});
		});

	});
</script>
</script>
<div class="row">
	<div class="col-md-6">
		<form action="<?= base_url('subkriteria/tambah/' . $kriteria) ?>" method="POST">
			<input type="hidden" name="id_kriteria" value="<?= $kriteria; ?>" />
			<?= form_error('ket'); ?>
			<?= form_error('nilai'); ?>

			<div id="div_teks" class="opsi">
				<div class="form-group required">
					<label for="field-1" class="col-sm-3 control-label">Keterangan</label>
					<div class="col-md-7">
						<input type="text" name="ket" class="form-control " autocomplete="" placeholder="keterangan" required="" "/>
				</div>
			</div>	
			
		</div>
		<br><br>
					<div id=" nilaikategori">

						<div class="form-group required">
							<label class="col-sm-3 control-label">Nilai</label>
							<div class="col-md-6">
								<label for="" style="color:red;">1 = nilai paling sangat rendah</label>
								<br>
								<label for="" style="color:red;">9 = nilai paling sangat tinggi</label>
								<?php for ($i = 1; $i <= 9; $i++) : ?>

									<div class="radio radio-replace">

										<label>
											<input type="radio" name="nilai" value="<?= $i ?>" /> <?= $i ?>
											<?= form_error('nilai ', '<small class="text-danger pl-3">', '</small>'); ?>
										</label>
									</div>
								<?php endfor; ?>


							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-2 ">&nbsp;</label>
						<div class="col-md-6">
							<button type="submit" name="submit" class="btn btn-primary btn-flat">Tambah</button>
							<a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
						</div>
					</div>
		</form>
	</div>
</div>