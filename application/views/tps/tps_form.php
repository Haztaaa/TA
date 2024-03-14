<h2 style="margin-top:0px">Tps <?php echo $button ?></h2>
<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="varchar">Nama Tps <?php echo form_error('nama_tps') ?></label>
        <input type="text" class="form-control" name="nama_tps" id="nama_tps" placeholder="Nama Tps" value="<?php echo $nama_tps; ?>" />
    </div>
    <div class="form-group">
        <label for="varchar">Lokasi <?php echo form_error('lokasi') ?></label>
        <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="<?php echo $lokasi; ?>" />
    </div>


    <input type="hidden" name="id_tps" value="<?php echo $id_tps; ?>" />
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
    <a href="<?php echo site_url('tps') ?>" class="btn btn-default">Batal</a>
</form>