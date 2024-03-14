<div class="row" style="margin-bottom: 10px">
    <div class="col-md-2">
        <?php echo anchor(site_url('kriteria/create'), 'Tambah Kriteria', 'class="btn btn-primary"'); ?>
    </div>

</div>

<div class="col-md-12 text-center">
    <div style="margin-top: 8px" id="message">
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>
</div>

<br><br>
<br>
<div class="">


    <table id="datatables" class="table table-bordered">
        <thead>
            <tr role="row" style="color: black;">
                <th style="color: black;">No</th>
                <th style="color: black;">Nama Kriteria</th>
                <th style="color: black;">Jenis Kriteria</th>
                <th style="color: black;">Bobot</th>
                <th style="color: black;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($kriteria_data as $kriteria) {
            ?>
                <tr class="gradeA odd" role="row">
                    <td width="80px" style="color: black;"><?php echo ++$start ?></td>
                    <td style="color: black;"><?php echo $kriteria->nama_kriteria ?></td>
                    <td style="color: black;"><?php echo $kriteria->jenis_kriteria ?></td>
                    <td style="color: black;">
                        <?php
                        if ($kriteria->bobot) :
                            echo $kriteria->bobot
                        ?>
                        <?php else : ?>
                            <span>Belum Ada bobot</span>
                        <?php endif; ?>
                    </td>
                    <td style="color: black;" width="300px">
                        <?php
                        echo anchor(site_url('Subkriteria/parameter/' . $kriteria->id_kriteria), 'Penilaian', array('class' => 'btn btn-danger'));
                        echo ' | ';
                        echo anchor(site_url('kriteria/update/' . $kriteria->id_kriteria), 'Ubah', array('class' => 'btn btn-default'));
                        echo ' | ';
                        echo anchor(site_url('kriteria/delete/' . $kriteria->id_kriteria), 'Hapus', 'onclick="javasciprt: return confirm(\'Apakah Anda Yakin?\')"');
                        ?>
                    </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>
    <hr>
    <div class="float-right">
        <?php echo anchor(site_url('perbandingan/banding'), 'Hitung Bobot', 'class="btn btn-primary"'); ?>
    </div>
</div>