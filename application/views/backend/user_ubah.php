<h2 style="margin-top:0px">Ubah Data Pengguna</h2>
<form action="<?= base_url('admin/dashboard/ubah_pengguna/' . $id) ?>" method="post">
    <div class="form-group">
        <label for="varchar">Nama Lengkap <?php echo form_error('nama_lengkap') ?></label>
        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?= $users->nama ?>" />
    </div>
    <div class="form-group">
        <label for="varchar">Nama Pengguna <?php echo form_error('nama_pengguna') ?></label>
        <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna" value="<?= $users->username ?>" />
    </div>
    <div class="form-group">
        <label for="varchar">Kata Sandi <?php echo form_error('kata_sandi') ?></label>
        <input type="password" class="form-control" name="kata_sandi" id="kata_sandi" value="<?= $users->password ?>" />
    </div>


    <button type="submit" class="btn btn-primary">Ubah</button>
    <a href="<?php echo site_url('admin/dashboard/manajemen') ?>" class="btn btn-default">Kembali</a>
</form>