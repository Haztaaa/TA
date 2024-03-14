<h2 style="margin-top:0px">Data Alternatif yang telah diisi nilai kriteria</h2>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor('Alternatif/create', 'Tambah', 'class="btn btn-primary"'); ?>
    </div>

    <div class="col-md-4 text-center">
        <?= $this->session->flashdata('message'); ?>
    </div>
    <div class="col-md-1 text-right">
    </div>



</div>
<div class="table-responsive">
    <table class="table table-bordered" id="datatables" style="margin-bottom: 10px">
        <thead>
            <tr>
                <th style="color: black;">No</th>
                <th style="color: black;">Nama TPS</th>
                <th style="color: black;">Lokasi TPS</th>
                <th style="color: black;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($data)) {
                $no = 1;
                foreach ($data as $alternatif) {
            ?>
                    <tr>
                        <td width="80px" style="color: black;"><?php echo $no++ ?></td>
                        <td style="color: black;"><?php echo $alternatif->nama_tps ?></td>
                        <td style="color: black;"><?php echo $alternatif->lokasi ?></td>

                        <td style="text-align:center; color:black;" width="200px">
                            <?= anchor('Alternatif/ubah/' . $alternatif->id_alternatif, 'Ubah', array('class' => 'btn btn-default btn-sm')); ?>
                            <?= "|" ?>
                            <!-- <?= anchor('Alternatif/hapus?alternatif=' . $alternatif->id_alternatif, '', array('class' => 'btn btn-danger btn-sm')); ?> -->
                            <?= anchor('Alternatif/hapus?alternatif=' . $alternatif->id_alternatif, 'Hapus', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="5" align="center">Tidak Ada Data</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="row">

    <div class="col-md-6 text-right">

    </div>
</div>