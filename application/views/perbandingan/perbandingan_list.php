<script type="text/javascript">
	$(document).ready(function() {
		$("#formcari").submit(function(e) {
			e.preventDefault();
			$.ajax({
				type: 'get',
				dataType: 'html',
				url: "<?= base_url('Perbandingan/gethtml'); ?>",
				data: $(this).serialize(),
				error: function() {
					$("#matrik").html('Gagal mengambil data matrik');
				},
				beforeSend: function() {
					$("#matrik").html('Mengambil data matrik. Tunggu sebentar');
				},
				success: function(x) {
					$("#matrik").html(x);
				},
			});
		});
	});

	function showsubdata(kriteria) {
		$.ajax({
			type: 'get',
			dataType: 'html',
			url: "<?= base_url('Perbandingan/getsub'); ?>",
			data: "kriteria=" + kriteria,
			error: function() {
				$("#matriksub").html('Gagal mengambil data matrik');
			},
			beforeSend: function() {
				$("#matriksub").html('Mengambil data matrik. Tunggu sebentar');
			},
			success: function(x) {
				$("#matriksub").html(x);
			},
		});
	}
</script>
<div class="row">
	<form action="" id="formcari">
		<?= $this->session->flashdata('message'); ?>
		<div class="form-group">
			<label class="col-sm-2 control-label">Silahkan Klik Untuk Memulai</label>
			<button type="submit" class="btn btn-primary btn-flat">Tampilkan</button>
		</div>
	</form>
	<div id="matrik"></div>
</div>