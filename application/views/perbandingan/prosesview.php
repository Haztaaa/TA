<?php error_reporting(0); ?>
<script>
	function show() {

		$("#hasil").toggle('fade');
	}
</script>
<div id="respon" class="hidden-print"></div>
<?php
$sql = "Select COUNT(*) as m FROM alternatif ";
$c = $this->m_db->get_query_row($sql, 'm');
if ($c < 1) {
	echo '<div class="alert alert-warning hidden-print" id="error">Belum Ada Alternatif Yang Di Daftarkan!</div>';
} else {
?>
	<label for="" style="color: red;">Data Nilai Alternatif</label>
	<br><br>
	<div class="table-responsive">

		<table class="table table-bordered ">
			<thead>
				<th style="color: black;">Nama TPS</th>
				<?php
				$dKriteria = $this->mod_kriteria->kriteria_data();
				if (!empty($dKriteria)) {
					foreach ($dKriteria as $rKriteria) {
						echo '<th style="color: black;">' . $rKriteria->nama_kriteria . '</th>';
					}
				}
				?>

			</thead>
			<?php


			$dAlternatif = $this->m_db->get_data('alternatif');
			if (!empty($dAlternatif)) {

				foreach ($dAlternatif as $rAlternatif) {
					$alternatifID = $rAlternatif->id_alternatif;
					$tpsID = $rAlternatif->id_tps;
					$nama_tps = field_value('tps', 'id_tps', $tpsID, 'nama_tps');

			?>
					<tr>
						<td style="color: black;"><?= $nama_tps; ?></td>
						<?php
						$total = 0;
						if (!empty($dKriteria)) {
							foreach ($dKriteria as $rKriteria) {
								$kriteriaid = $rKriteria->id_kriteria;
								$subkriteria = alternatif_nilai($alternatifID, $kriteriaid);

								$d = $this->db->get_where('subkriteria', ['id_subkriteria' => $subkriteria])->row();
								if ($d->nilai == null) {
									$d->nilai = 0;
									$msgg = 'Nilai Alternatif Belum Diisi';
								}
								echo '<td style="color: black;">' . $d->nilai . '</td>';
							}
						}
						?>



					</tr>

		<?php

				}
			} else {
				return false;
			}
		}
		?>

		</table>
	</div>
	<?php if ($d->nilai == null) {
		echo '<a href="javascript:;" onclick="show();" class="btn btn-danger disabled ">Masi Ada Alternatif yang nilainya belum diisi!</a>';
	} else {
		echo '<a href="javascript:;" onclick="show();" class="btn btn-success ">Hitung</a>';
	} ?>
	<br><br>
	<div id="hasil" style="display: none;">
		<label for="" style="color: red;">Hasil Normalisasi</label>
		<div class="table-responsive">

			<table class="table table-bordered ">
				<thead>
					<th style="color: black;">Nama TPS</th>
					<?php
					$dKriteria = $this->mod_kriteria->kriteria_data();
					if (!empty($dKriteria)) {
						foreach ($dKriteria as $rKriteria) {
							echo '<th style="color: black;">' . $rKriteria->nama_kriteria . '</th>';
						}
					}
					?>

				</thead>
				<?php


				$dAlternatif = $this->m_db->get_data('alternatif');
				if (!empty($dAlternatif)) {

					foreach ($dAlternatif as $rAlternatif) {
						$alternatifID = $rAlternatif->id_alternatif;
						$tpsID = $rAlternatif->id_tps;
						$nama_tps = field_value('tps', 'id_tps', $tpsID, 'nama_tps');

				?>
						<tr>
							<td style="color: black;"><?= $nama_tps; ?></td>
							<?php
							$total = 0;
							$hasil_normalisasi = 0;
							if (!empty($dKriteria)) {
								foreach ($dKriteria as $rKriteria) {
									$kriteriaid = $rKriteria->id_kriteria;
									$subkriteria = alternatif_nilai($alternatifID, $kriteriaid);
									$d = $this->db->get_where('subkriteria', ['id_subkriteria' => $subkriteria])->row();
									if ($rKriteria->jenis_kriteria == 'Benefit') {
										$datamax = $this->db->query("SELECT an.id_kriteria, MAX(nilai) AS max 
																FROM subkriteria LEFT JOIN alternatif_nilai an 
																ON an.id_subkriteria=subkriteria.id_subkriteria 
																WHERE an.id_kriteria='$kriteriaid' 
																GROUP BY an.id_kriteria")->row();
										$max = $datamax->max;
										$bobot = $rKriteria->bobot;
										$nilai = $d->nilai;
										// hasil normalisasi
										$hasil =  number_format($nilai / $max, 4);
										$hasil_akhir = $hasil * $bobot;
										echo '<td style="color: black;">' . $hasil . '</td>';
										$hasil_normalisasi = $hasil_normalisasi + $hasil;
									} else {
										$datamin = $this->db->query("SELECT an.id_kriteria, MIN(nilai) AS min
																FROM subkriteria LEFT JOIN alternatif_nilai an 
																ON an.id_subkriteria=subkriteria.id_subkriteria 
																WHERE an.id_kriteria='$kriteriaid' 
																GROUP BY an.id_kriteria")->row();
										$bobot = $rKriteria->bobot;
										$min = $datamin->min;
										$nilai = $d->nilai;
										$hasil = number_format($min / $nilai, 4);
										$hasil_akhir = $hasil * $bobot;
										echo '<td>' . $hasil . '</td>';
										$hasil_normalisasi = $hasil_normalisasi + $hasil;
									}
								}
							}
							?>



						</tr>
				<?php

					}
				} else {
					return false;
				}

				?>

			</table>
		</div>
		<br><br>
		<label for="" style="color: red;">Pembobotan </label>
		<div class="table-responsive">
			<?php $hasil_ranks = array(); ?>
			<table class="table table-bordered ">
				<thead>
					<th style="color: black;">Nama TPS</th>
					<?php
					$dKriteria = $this->mod_kriteria->kriteria_data();
					if (!empty($dKriteria)) {
						foreach ($dKriteria as $rKriteria) {
							echo '<th style="color: black;">' . $rKriteria->nama_kriteria . '</th>';
						}
					}
					?>
					<th style="color: black;">Hasil</th>
				</thead>
				<?php


				$dAlternatif = $this->m_db->get_data('alternatif');
				if (!empty($dAlternatif)) {

					foreach ($dAlternatif as $rAlternatif) {
						$alternatifID = $rAlternatif->id_alternatif;
						$tpsID = $rAlternatif->id_tps;
						$nama_tps = field_value('tps', 'id_tps', $tpsID, 'nama_tps');

				?>
						<tr>
							<td style="color: black;"><?= $nama_tps; ?></td>
							<?php
							$total = 0;
							$hasil_normalisasi = 0;

							if (!empty($dKriteria)) {
								foreach ($dKriteria as $rKriteria) {
									$kriteriaid = $rKriteria->id_kriteria;
									$subkriteria = alternatif_nilai($alternatifID, $kriteriaid);
									$d = $this->db->get_where('subkriteria', ['id_subkriteria' => $subkriteria])->row();
									if ($rKriteria->jenis_kriteria == 'Benefit') {
										$datamax = $this->db->query("SELECT an.id_kriteria, MAX(nilai) AS max 
																FROM subkriteria LEFT JOIN alternatif_nilai an 
																ON an.id_subkriteria=subkriteria.id_subkriteria 
																WHERE an.id_kriteria='$kriteriaid' 
																GROUP BY an.id_kriteria")->row();
										$max = $datamax->max;
										$bobot = $rKriteria->bobot;

										$nilai = $d->nilai;
										// hasil normalisasi
										$hasil =  number_format($nilai / $max, 4);
										$hasil_akhir_max = $hasil * $bobot;

										echo '<td style="color: black;">' . $hasil_akhir_max . '</td>';
										$hasil_normalisasi = $hasil_normalisasi + $hasil_akhir_max;
									} else {
										$datamin = $this->db->query("SELECT an.id_kriteria, MIN(nilai) AS min
																FROM subkriteria LEFT JOIN alternatif_nilai an 
																ON an.id_subkriteria=subkriteria.id_subkriteria 
																WHERE an.id_kriteria='$kriteriaid' 
																GROUP BY an.id_kriteria")->row();
										$bobot = $rKriteria->bobot;
										$min = $datamin->min;

										$nilai = $d->nilai;
										$hasil = number_format($min / $nilai, 4);
										$hasil_akhir_min = $hasil * $bobot;

										echo '<td name="tes" style="color: black;">' . $hasil_akhir_min . '</td>';
										// var_dump($hasil_akhir);
										// die;

										$hasil_normalisasi = $hasil_normalisasi + $hasil_akhir_min;
									}
								}
							}
							?>


							<td style="color: black;">
								<?php

								$hasil_rank['nilai'] = $hasil_normalisasi;
								$hasil_rank['tps'] = $nama_tps;
								array_push($hasil_ranks, $hasil_rank);
								echo $hasil_normalisasi;

								?>
							</td>

						</tr>
				<?php

					}
				} else {
					return false;
				}

				?>

			</table>
		</div>
		<div class="table-responsive">
			<label for="" style="color:red;">Hasil Peringkat</label>
			<table class="table table-bordered">
				<thead>
					<th style="color: black;">Peringkat</th>
					<th style="color: black;">Nama TPS</th>
					<th style="color: green;">Nilai</th>
				</thead>
				<?php
				$no = 1;
				rsort($hasil_ranks);
				foreach ($hasil_ranks as $rank) { ?>
					<tr style="color: black;">
						<td>
							<center><?php echo $no++ ?></center>
						</td>
						<td>
							<center><?php echo $rank['tps']; ?></center>
						</td>
						<td>
							<center><?php
									$v = $rank['nilai'];
									echo number_format($v, 4); ?></center>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<?php rsort($hasil_ranks); ?>
		<label for="" style="color:black;">REKOMENDASI TPS YANG SESUAI ADALAH: <b><?= $hasil_ranks[0]['tps'] ?></b></label>
	</div>