<h2 style="margin-top:0px">Tambah Data Tps Baru</h2>
<hr>
<form action="<?= base_url('tps/tambah') ?>" method="post">
    <div class="form-group">
        <label for="varchar">Nama Tps <?php echo form_error('nama_tps') ?></label>
        <input type="text" class="form-control" name="nama_tps" id="nama_tps" placeholder="Nama Tps" />
    </div>
    <div class="form-group">
        <label for="varchar">Lokasi <?php echo form_error('lokasi') ?></label>
        <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" />
    </div>
    <!-- <?php foreach ($kriteria as $k) : ?>
        <div class="form-group">
            <?php $id = $k['id_kriteria'] ?>
            <label for="varchar"><?= $k['nama_kriteria'] ?></label>
            <?php $dat = $this->db->get_where('subkriteria', ['id_kriteria' => $id])->result(); ?>
            <input type="hidden" name="id_kriteria" value="<?= $k['id_kriteria'] ?>">
            <select name="kriteria[<?= $id ?>]" class="form-control">

                <option value=""></option>
                <?php foreach ($dat as $d) : ?>
                    <option value="<?= $d->id_subkriteria ?>"><?= $d->nama ?></option>
            </select>
        <?php endforeach; ?>
        </div>
    <?php endforeach; ?> -->
    <button type="submit" class="btn btn-primary">Tambah</button>
    <a href="<?php echo site_url('tps') ?>" class="btn btn-default">Batal</a>
</form>