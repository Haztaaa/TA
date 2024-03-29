<!-- Footer -->
<footer class="main" style="color: black;">


	&copy; 2022 <strong>SPK</strong> TPS 3 R (Reduce Reuse Recycle)

</footer>
</div>
<link rel="stylesheet" href="<?= base_url() ?>assets/js/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/js/rickshaw/rickshaw.min.css">

<!-- Bottom Scripts -->
<script src="<?= base_url() ?>assets/js/jquery-1.11.0.min.js"></script>
<script src="<?= base_url() ?>assets/js/gsap/main-gsap.js"></script>
<script src="<?= base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>

<script src="<?= base_url() ?>assets/js/bootstrap.js"></script>
<script src="<?= base_url() ?>assets/js/joinable.js"></script>
<script src="<?= base_url() ?>assets/js/resizeable.js"></script>
<script src="<?= base_url() ?>assets/js/neon-api.js"></script>
<script src="<?= base_url() ?>assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() ?>assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.sparkline.min.js"></script>
<script src="<?= base_url() ?>assets/js/rickshaw/vendor/d3.v3.js"></script>
<script src="<?= base_url() ?>assets/js/rickshaw/rickshaw.min.js"></script>
<script src="<?= base_url() ?>assets/js/raphael-min.js"></script>
<script src="<?= base_url() ?>assets/js/morris.min.js"></script>
<script src="<?= base_url() ?>assets/js/toastr.js"></script>
<script src="<?= base_url() ?>assets/js/neon-chat.js"></script>
<script src="<?= base_url() ?>assets/js/neon-custom.js"></script>
<script src="<?= base_url() ?>assets/js/neon-demo.js"></script>
<script src="<?= base_url() ?>assets/js/fileinput.js"></script>
<script src="<?= base_url() ?>assets/js/datatables/jquery.dataTables.min.js"></script>


<!-- modal hapus -->
<div class="modal fade" id="confirm-delete">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title">Konfirmasi!</h4>
			</div>

			<div class="modal-body">
				Yakin ingin menghapus data ini ?
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<a class="btn btn-danger btn-ok">Hapus saja</a>
			</div>
		</div>
	</div>
</div>
</body>

</html>
<script>
	$(document).ready(function() {
		$('#datatables').DataTable({
			"language": {

				"decimal": "",
				"emptyTable": "Tidak Ada Data Yang Ditemukan",
				"info": "Menampilkan _START_ ke _END_ dari _TOTAL_ data",
				"infoEmpty": "Menampilkan 0 to 0 of 0 Data",
				"infoFiltered": "(Di Filter Dari _MAX_ total data)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Menampilkan _MENU_ Data ",
				"loadingRecords": "Mohon Tunggu...",
				"processing": "Memproses...",
				"search": "Cari:",
				"zeroRecords": "Data Tidak Ditemukan",
				"paginate": {
					"first": "Awal",
					"last": "Akhir",
					"next": "Selanjutnya",
					"previous": "Sebelumnya"
				},
				"aria": {
					"sortAscending": ": activate to sort column ascending",
					"sortDescending": ": activate to sort column descending"
				}

			}
		});
	});
</script>

<script>
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
</script>