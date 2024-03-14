<!-- get alternatif -->
<script type="text/javascript">
	$(document).ready(function() {
		$("select").select2();
	});
</script>
<div class="row">
	<?= form_open('Alternatif/create'); ?>
	<div class="form-group required">
		<label class="col-sm-2 control-label" for="">Nama TPS</label>
		<div class="col-md-10">
			<select name="id_tps" class="form-control">
				<?php
				if (!empty($tps)) {
					foreach ($tps as $s) {
				?>
						<option value='<?php echo $s->id_tps ?>'><?php echo $s->nama_tps ?></option>
					<?php }
				} else { ?>
					<option class="form-control"> Semua TPS sudah terdaftar</option>
				<?php } ?>

			</select>
		</div>
	</div>
	<br><br><br><br>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="">Penilaian</label>
		<div class="col-md-10">
			<table class="table table-bordered">
				<thead>
					<th>Kriteria</th>
					<th>Nilai</th>
				</thead>
				<tbody>
					<?php
					if (!empty($kriteria)) {
						foreach ($kriteria as $rk) {
							$kriteriaid = $rk->id_kriteria;
							echo '<tr>';
							echo '<td>' . $rk->nama_kriteria . '</td>';
							echo '<td>';
							$dSub = $this->m_db->get_data('subkriteria', array('id_kriteria' => $kriteriaid));
							if (!empty($dSub)) {
								echo '<select name="kriteria[' . $kriteriaid . ']"  class="form-control" data-placeholder="Pilih Nilai"  style="width: 100%">';
								echo '<option></option>';
								foreach ($dSub as $rSub) {

									echo '<option value="' . $rSub->id_subkriteria . '">' . $rSub->nama . ' (' . $rSub->nilai . ')' . '</option>';
								}
								echo '</select>';
							}
							echo form_error('kriteria[' . $kriteriaid . ']');
							echo '</td>';
							echo '</tr>';
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">&nbsp;</label>
		<div class="col-md-6">
			<?php
			if (!empty($tps)) {
			?>
				<button type="submit" name="submit" class="btn btn-primary btn-flat">Tambah</button>
				<a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
			<?php } else { ?>
				<button type="submit" name="submit" class="btn btn-primary btn-flat" disabled>Tambah</button>
				<a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
			<?php } ?>
		</div>
	</div>
	<?= form_close(); ?>
</div>