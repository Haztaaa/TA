<div class="col-md-12 text-center">
	<div style="margin-top: 8px" id="message">
		<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
	</div>
</div>
<br>
<br>
<div class="row">
	<div class="col-sm-4">

		<div class="tile-stats tile-red">
			<div class="icon"><i class="entypo-users"></i></div>
			<div class="num" data-start="0" data-end=" <?php echo $jumlah_users; ?> " data-postfix="" data-duration="1500" data-delay="0">0</div>

			<h3>Jumlah Pengguna</h3>
			<p> yang ada pada Website.</p>
		</div>

	</div>

	<div class="col-sm-4">

		<div class="tile-stats tile-green">
			<div class="icon"><i class="entypo-chart-bar"></i></div>
			<div class="num" data-start="0" data-end="<?php echo count($jumlah_kriteria); ?>" data-postfix="" data-duration="1500" data-delay="600">0</div>

			<h3>Jumlah Kriteria</h3>
			<p> yang ada pada Website.</p>
		</div>

	</div>

	<div class="col-sm-4">

		<div class="tile-stats tile-aqua">
			<div class="icon"><i class="entypo-suitcase"></i></div>
			<div class="num" data-start="0" data-end=" <?= $jumlah_tps ?> " data-postfix="" data-duration="1500" data-delay="1200">0</div>

			<h3>Jumlah TPS 3 R</h3>
			<p>TPS 3 R yang ada pada website.</p>
		</div>

	</div>

</div>
<br />

<div class="row">
	<div class="col-md-6">

		<div class="panel panel-info" data-collapsed="0">

			<!-- panel head -->
			<div class="panel-heading">
				<div class="panel-title">Tempat Pengolahan Sampah</div>

				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
				</div>
			</div>

			<!-- panel body -->
			<div class="panel-body" style="text-align: justify; color:black;">

				<p>Tempat pengolahan sampah adalah tempat berlangsungnya kegiatan pemisahan dan pengolahan sampah secara terpadu. Menurut Pedoman Umum 3R Permukiman tahun 2016, konsep 3R adalah paradigma baru dalam pola konsumsi dan produksi di semua tingkatan dengan memberikan prioritas tertinggi pada pengolahan limbah yang berorientasi pada pencegahan penimbunan sampah, minimisasi limbah dengan mendorong barang yang dapat digunakan lagi dan barang yang dapat didekomposisi secara biologi (biodegradable) dan penerapan pembuangan limbah yang ramah lingkungan</p>

			</div>

		</div>

	</div>

	<div class="col-md-6">

		<div class="panel panel-success" data-collapsed="0">

			<!-- panel head -->
			<div class="panel-heading">
				<div class="panel-title">SPK Penentuan Pembukaan TPS 3R</div>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
				</div>
			</div>

			<!-- panel body -->
			<div class="panel-body" style="text-align: justify; color:black;">
				<p>Sistem Pendukung Keputusan (SPK) secara umum didefinisikan sebagai sebuah sistem yang mampu memberikan kemampuan baik kemampuan pemecahan masalah maupun kemampuan pengkomunikasian untuk masalah semi-terstruktur. Secara khusus, SPK didefinisikan sebagai sebuah sistem yang mendukung kerja seorang manajer maupun sekelompok manajer dalam memecahkan masalah semi-terstruktur dengan cara memberikan informasi ataupun usulan menuju pada keputusan tertent</p>

			</div>

		</div>

	</div>
</div>