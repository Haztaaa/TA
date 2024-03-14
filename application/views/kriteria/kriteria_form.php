<h2 style="margin-top:0px"><?php echo $button; ?> Data Kriteria Baru</h2>
<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="varchar">Nama Kriteria <?php echo form_error('nama_kriteria') ?></label>
        <input type="text" class="form-control" name="nama_kriteria" id="nama_kriteria" placeholder="Nama Kriteria" value="<?php echo $nama_kriteria; ?>" />
    </div>
    <div class="form-group">
        <label for="varchar">Jenis Kriteria <?php echo form_error('jenis_kriteria') ?></label>
        <select name="jenis_kriteria" class="form-control" id="">
            <option value="Cost">Cost</option>
            <option value="Benefit">Benefit</option>
        </select>
    </div>
    <input type="hidden" name="id_kriteria" value="<?php echo $id_kriteria; ?>" />
    <button type="submit" class="btn btn-primary"><?php echo $button; ?></button>
    <a href="<?php echo site_url('kriteria') ?>" class="btn btn-default">Kembali</a>
</form>