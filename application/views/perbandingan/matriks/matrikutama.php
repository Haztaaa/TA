<?php

$irdata = array(
	1 => 0.00,
	2 => 0.00,
	3 => 0.58,
	4 => 0.90,
	5 => 1.12,
	6 => 1.24,
	7 => 1.32,
	8 => 1.41,
	9 => 1.45,
	10 => 1.49,
	11 => 1.51,
	12 => 1.48,
	13 => 1.56,
	14 => 1.57,
	15 => 1.59,
);

$jumlah = count($arr);

$ir = 0.00;
foreach ($irdata as $irk => $irv) {
	if ($irk == $jumlah) {
		$ir = $irv;
	}
}
?>
<script type="text/javascript">
	$(document).ready(function() {

		<?php
		if (!empty($arr)) {
		?>
			hitung();
		<?php
		}
		?>

		$("#formentri").submit(function(e) {
			e.preventDefault();
			$.ajax({
				type: 'post',
				dataType: 'json',
				url: "<?= base_url(); ?>Perbandingan/updateutama",
				data: $(this).serialize(),
				error: function() {
					shownotice('danger', 'Gagal menyimpan sss data');
					$("#formentri select").removeAttr("disabled");
					$("#formentri button").removeAttr("disabled");
				},
				beforeSend: function() {
					$("#formentri select").attr('disabled', 'disabled');
					$("#formentri button").attr('disabled', 'disabled');
					shownotice('info', 'Tunggu sebentar,lagi menyimpan data');
				},
				success: function(x) {
					if (x.status == "ok") {
						shownotice('success', x.msg);
					} else {
						shownotice('danger', x.msg);
					}
					$("#formentri select").removeAttr("disabled");
					$("#formentri button").removeAttr("disabled");
				},
			});
		});

		$(".inputnumber").each(function() {
			$(this).change(function() {
				hitung();

			});
		});

	});

	function shownotice(tipe, pesan) {
		$("#respon").html('<div class="alert alert-' + tipe + '">' + pesan + '</div>');
		$("#respon").show('fadeIn');
		if ($("#respon").is(":visible")) {
			setTimeout(function() {
				$("#respon").hide('fadeOut');
			}, 3000);
		}
	}

	function contoh() {
		$("#k1b2").val(9);
		$("#k1b3").val(9);
		$("#k1b4").val(9);
		$("#k1b5").val(9);
		$("#k2b4").val(9);
		$("#k2b5").val(9);
		$("#k3b4").val(9);
		$("#k3b5").val(9);
		$("#k4b5").val(9);

	}

	function hitung() {
		//contoh();

		$(".inputnumber").each(function() {
			//	$(this).change(function(){		
			var dtarget = $(this).attr('data-target');
			var dkolom = $(this).attr('data-kolom');
			var jumlah = $(this).val();
			var rumus = 1 / parseFloat(jumlah);
			var fx = rumus.toFixed(4);
			$("#" + dtarget).val(fx);
			//$("#"+dtarget).prop('readonly',true);	
			total();
			mnk();
			mptb();
			rk();
			//alert(dkolom);
			//	});
		});
	}

	function showmatrix() {
		$("#matrikdiv").toggle('fade');
	}

	function total() {
		for (i = 1; i <= <?= $jumlah; ?>; i++) {
			var sum = 0;
			$(".kolom" + i).each(function() {
				sum += parseFloat($(this).val());
			});
			var fx = sum;
			$("#total" + i).val(fx);
		}
	}

	function mnk() {
		for (i = 1; i <= <?= $jumlah; ?>; i++) {
			var jml = 0;
			for (x = 1; x <= <?= $jumlah; ?>; x++) {
				var vtarget = $("#k" + i + "b" + x).val();
				var vkolom = $("#total" + x).val();
				var rumus = parseFloat(vtarget) / parseFloat(vkolom);
				var fx = rumus.toFixed(4);
				jml += parseFloat(rumus);
				$("#mn-k" + i + "b" + x).val(fx);
				//$("#mn-k"+i+"b"+x).val(i+" "+x);						
			}
			var jumlahmnk = jml.toFixed(4);
			var prio = parseFloat(jml) / parseFloat(<?= $jumlah; ?>);
			var totprio = prio.toFixed(4);;
			$("#jml-b" + i).val(jumlahmnk);
			$("#pri-b" + i).val(totprio);


		}
	}

	function mptb() {
		for (i = 1; i <= <?= $jumlah; ?>; i++) {
			var jml = 0;
			for (x = 1; x <= <?= $jumlah; ?>; x++) {
				var prio = $("#pri-b" + x).val();
				var nilai = $("#total" + i + x).val();
				var rumus = parseFloat(nilai) * parseFloat(prio);
				var fx = rumus;
				jml += parseFloat(rumus);
				//$("#mptb-k"+i+"b"+x).val(prio+"*"+nilai);
				$("#mptb-k" + i + "b" + x).val(fx);
			}
			var jumlahmnk = jml;
			$("#total" + i).val();
		}
	}

	function rk() {
		var total = 0;
		for (i = 1; i <= <?= $jumlah; ?>; i++) {
			var prio = $("#pri-b" + i).val();
			var jml = $("#total" + i).val();
			var hasil = parseFloat(jml) * parseFloat(prio);
			var fx = hasil.toFixed(4);
			total += hasil;
			$("#jmlrk-b" + i).val(jml);
			$("#priork-b" + i).val(prio);
			$("#prioritas-b" + i).val(prio);
			$("#hasilrk-b" + i).val(fx);
		}
		var fx2 = total.toFixed(4);
		$("#totalrk").val(fx2);
		$("#sumrk").val(fx2);
		var summaks = parseFloat(total) / parseFloat(<?= $jumlah; ?>);
		var fx_summaks = summaks;
		$("#summaks").val(fx_summaks);

		var ci_r_1 = parseFloat(fx2) - parseFloat(<?= $jumlah; ?>);
		var ci = parseFloat(ci_r_1) / parseFloat(<?= $jumlah; ?> - 1);
		var fx_ci = ci;
		$("#sumci").val(fx_ci);
		var cr = parseFloat(ci) / parseFloat(<?= $ir; ?>);
		var fx_cr = cr;
		var hasil = fx_cr.toFixed(4);
		$("#sumcr").val(hasil);
		$("#crvalue").val(fx_cr);
		$("#crjumlah").val(fx_cr);
	}
</script>


<div id="respon"></div>
<div id="entri" class="col-md-12">
	<?php
	echo form_open('#', array('class' => 'form-horizontal', 'id' => 'formentri'));
	?>
	<input type="hidden" name="crvalue" id="crvalue" />

	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<th colspan="<?= $jumlah + 1; ?>" class="text-center" style="color:black;">Matrik Perbandingan Berpasangan</th>
			</thead>
			<thead>
				<th style="color:black;">Kriteria</th>
				<?php
				foreach ($arr as $k => $v) {
				?>
					<th style="color:black;"><?= $v; ?></th>
				<?php
				}
				?>
			</thead>
			<tbody>
				<?php

				$noUtama = 0;
				foreach ($arr as $k2 => $v2) {
					$noUtama += 1;
					//array_shift($xxx);
					echo '<tr>';
					echo '<td style="color:black;">' . $v2 . '</td>';
					$noSub = 0;
					$xxx = '';
					// jumlah = jumlah kriteria		
					for ($i = 1; $i <= $jumlah; $i++) {
						$keys = array_keys($arr);
						$xxx = $keys[array_search("gsda", $keys) + ($i - 1)];
						$newname = $k2 . "[" . $xxx . "]";

						$noSub += 1;
						if ($noSub == $noUtama) {
							echo '<td><input type="number" id="k' . $noUtama . 'b' . $noSub . '" readonly class="form-control kolom' . $noSub . '" style="color:black;" value="1" ="" title="kolom' . $noSub . '"/></td>';
						} else {

							if ($noUtama > $noSub) {
								echo '<td><input type="text" id="k' . $noUtama . 'b' . $noSub . '" readonly   class="form-control test kolom' . $noSub . '" style="color:black;" value="0" ="" title="kolom' . $noSub . '"/></td>';
							} else {
								echo '<td>';
								echo '<select name="' . $newname . '" id="k' . $noUtama . 'b' . $noSub . '" data-target="k' . $noSub . 'b' . $noUtama . '" style="color:black;" data-kolom="' . $noSub . '" class="form-control inputnumber kolom' . $noSub . '" title="kolom' . $noSub . '">';
								$tes = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 1 / 9, 1 / 8, 1 / 7, 1 / 6, 1 / 5, 1 / 4, 1 / 3, 1 / 2);
								// $d2 = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "1/9", "1 / 8", "1 / 7", "1 / 6", "1 / 5", "1 / 4", "1/3", "1/2");




								foreach ($tes as $x) {

									$nilai = ambil_nilai_kriteria($k2, $xxx);
									$sl = '';
									$t = number_format($x, 4);
									if ($nilai == $x) {
										$sl = 'selected="selected"';
									}
									echo '<option value="' . $x . '" ' . $sl . '>' . $t . '</option>';
								}
								echo '</select>';
							}
						}
					}
					echo '</tr>';
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<td>Jumlah</td>
					<?php
					for ($h = 1; $h <= $jumlah; $h++) {
					?>
						<td><input type="text" id="total<?= $h; ?>" class="form-control" value="0" title="total<?= $h; ?>" readonly="" /></td>
					<?php
					}
					?>
				</tr>
			</tfoot>
		</table>
	</div>

	<div class="pull-left">
		<!-- <a href="javascript:;" onclick="hitung();" class="btn btn-primary">Hitung</a>  -->
		<a href="javascript:;" onclick="showmatrix();" class="btn btn-info">Lihat Matriks</a>

		<button type="submit" name="submit" class="btn btn-success">Simpan Kriteria</button>
	</div>
	<?php
	echo form_close();
	?>
</div>
<br><br><br>
<div id="matrikdiv" class="col-md-12" style="display: none">
	<form action="<?= base_url('perbandingan/simpanbobot') ?>" method="POST">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<th colspan="<?= $jumlah + 3; ?>" class="text-center" style="color: black;">Matrik Nilai Kriteria</th>
				</thead>
				<thead>
					<th style="color: black;">Kriteria</th>
					<?php
					foreach ($arr as $k => $v) {
					?>
						<th style="color: black;"><?= $v; ?></th>
					<?php
					}
					?>
					<th>Jumlah</th>
					<th style="color:black;">Prioritas</th>

				</thead>
				<tbody>
					<?php
					$noUtama2 = 0;
					foreach ($arr as $k2 => $v2) {
						$noUtama2 += 1;
						echo '<tr>';
						echo '<td style="color: black;">' . $v2 . '</td>';
						$noSub2 = 0;
						for ($i = 1; $i <= $jumlah; $i++) {
							$noSub2 += 1;
							echo '<td><input type="text" id="mn-k' . $noUtama2 . 'b' . $noSub2 . '" style="color:black;" class="form-control" value="0" readonly=""/></td>';
						}
						echo '<td><input type="text" class="form-control" id="jml-b' . $noUtama2 . '" style="color:black;" value="0" readonly=""/></td>';
						echo '<td><input type="text" name="jumprio" class="form-control" id="pri-b' . $noUtama2 . '" style="color:green;" value="0" readonly=""/></td>';

						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>

		<?php
		for ($h = 1; $h <= $jumlah; $h++) {
			echo 	'<input type="hidden" name="jumlahprio' . $h . '" id="prioritas-b' . $h . '" value="">';
		}
		$no = 0;
		foreach ($id as  $a) : {
				$no++;
				echo 	'<input type="hidden" name="id' . $no . '"  value="' . $a['id_kriteria'] . '">';
			}
		endforeach;
		?>
		<input type="hidden" name="crvalue" id="crjumlah" />
		<button type="submit" name="submit" class="btn btn-success " style="margin-bottom: 20px;">Simpan Bobot</button>
	</form>


	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<th colspan="<?= $jumlah + 1; ?>" class="text-center">Rasio Konsistensi</th>
			</thead>
			<thead>
				<th style="color: black;">Kriteria</th>
				<th style="color: black;">Jumlah Per Baris</th>
				<th style="color: black;">Prioritas</th>
				<th style="color: black;">Hasil</th>
			</thead>
			<tbody>
				<?php
				$noUtama4 = 0;
				foreach ($arr as $k4 => $v4) {
					$noUtama4 += 1;
					echo '<tr>';
					echo '<td style="color: black;" >' . $v4 . '</td>';
					echo '<td "><input type="text" style="color: black;" class="form-control" id="jmlrk-b' . $noUtama4 . '" value="0" readonly =""/></td>';
					echo '<td "><input type="text" style="color: black;" class="form-control" id="priork-b' . $noUtama4 . '" value="0" readonly=""/></td>';
					echo '<td "><input type="text"  style="color: black;" class="form-control" id="hasilrk-b' . $noUtama4 . '" value="0" readonly=""/></td>';
					echo '</tr>';
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3" align="center" style="color: black;"><b>TOTAL</b></td>
					<td>
						<input type="text" style="color: black;" class="form-control" id="totalrk" value="0" readonly="" />
					</td>
				</tr>
			</tfoot>
		</table>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<th colspan="<?= $jumlah + 1; ?>" class="text-center" style="color: black;">Hasil Perhitungan</th>
			</thead>
			<thead>
				<th style="color: black;">Keterangan</th>
				<th style="color: black;">Nilai</th>
			</thead>
			<tbody>
				<tr>
					<td style="color: black;">Nilai Lamda Max</td>
					<td>
						<input type="text" style="color: black;" class="form-control" id="sumrk" value="0" readonly="" />
					</td>
				</tr>
				<tr>
					<td style="color: black;">n(Jumlah Kriteria)</td>
					<td>
						<input type="text" style="color: black;" class="form-control" id="sumkriteria" value="<?= $jumlah; ?>" readonly="" />
					</td>
				</tr>

				<tr>
					<td style="color: black;">CI((Maks-n)/n)</td>
					<td>
						<input type="text" style="color: black;" class="form-control" id="sumci" value="0" readonly="" />
					</td>
				</tr>
				<tr>
					<td style="color: black;">CR(CI/IR)</td>
					<td>
						<input type="text" class="form-control" style="color: green;" id="sumcr" value="0" readonly="" />
						<?php ?>
					</td>


				</tr>

			</tbody>
		</table>
		<p style="color: black; text-align:center;">Apabila CR < 0,1 Maka Kriteria Konsisten </p>
	</div>

</div>