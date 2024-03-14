<h2 style="margin-top:0px">Data TPS 3R</h2>
<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url('tps/tambah'), 'Tambah', 'class="btn btn-primary"'); ?>
    </div>
    <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
    </div>
    <div class="col-md-1 text-right">
    </div>

</div>
<table class="table " id="datatables" style="margin-bottom: 10px">
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
        $no = 1;
        foreach ($tps_data as $tps) {
        ?>
            <tr>
                <td width="80px" style="color: black;"><?php echo $no++ ?></td>
                <td style="color: black;"><?= $tps->nama_tps ?></td>
                <td style="color: black;"><?= $tps->lokasi ?></td>
                <td style="text-align:center; color: black;" width="200px">
                    <?php


                    echo anchor(site_url('tps/update/' . $tps->id_tps), 'Ubah', array('class' => 'btn btn-default btn-sm'));
                    echo '|';
                    echo anchor(site_url('tps/delete/' . $tps->id_tps), 'Hapus', array('class' => 'btn btn-danger btn-sm'));

                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>