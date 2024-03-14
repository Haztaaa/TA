<h2 style="margin-top:0px">Penilaian Kriteria</h2>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url('subkriteria/tambah/' . $kriteria), 'Tambah', 'class="btn btn-primary"'); ?>
    </div>
    <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
    </div>
    <div class="col-md-1 text-right">
    </div>

</div>
<table id="datatables" class="table table-bordered" style="margin-bottom: 10px">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Penilaian Kriteria</th>
            <th>Nilai</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $idd = $this->uri->segment(3); ?>

        <?php $start = 1; ?>
        <?php foreach ($record as $subkriteria) : ?>
            <tr>
                <td width="80px"><?php echo $start ?></td>
                <td><?php echo $subkriteria->nama ?></td>
                <td><?php echo $subkriteria->nilai ?></td>
                <td style="text-align:center" width="200px">
                    <?php
                    echo anchor(site_url('subkriteria/ubah/' . $subkriteria->id_subkriteria . '/' . $idd), 'Ubah', array('class' => 'btn btn-danger btn-sm'));
                    echo ' | ';
                    echo anchor(site_url('subkriteria/delete/' . $subkriteria->id_subkriteria . '/' . $idd), 'Hapus', 'onclick="javasciprt: return confirm(\'Anda Yakin ?\')"');
                    ?>
                </td>
            </tr>
            <?php $start++; ?>
        <?php endforeach; ?>
    </tbody>

</table>
<div class="col-md-6 text-right">
    <!--  <?php echo $pagination ?> -->
</div>

</div>