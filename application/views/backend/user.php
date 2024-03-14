<div class="row">
    <div class="col-md-12">
        <div class="col-md-12 text-center">
            <?= $this->session->flashdata('message') ?>
        </div>
        <table class="table table-bordered responsive">
            <?= anchor('admin/dashboard/tambah_pengguna', 'Tambah Pengguna', array('class' => 'btn btn-primary')); ?>
            <br><br>

            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Nama Pengguna</th>
                    <th>Status</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $user->nama ?></td>
                        <td><?= $user->username ?></td>
                        <td><?php if ($user->status == 0) : ?>
                                <form action="<?= base_url('admin/dashboard/tidakaktif') ?>" method="POST">
                                    <input type="hidden" name="id" value="<?= $user->id_user ?>">
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-success">Aktif</button>
                                </form>
                            <?php else : ?>
                                <form action="<?= base_url('admin/dashboard/aktif') ?>" method="POST">
                                    <input type="hidden" name="id" value="<?= $user->id_user ?>">
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-danger">Tidak Aktif</button>
                                </form>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo anchor('admin/dashboard/ubah_pengguna/' . $user->id_user, 'Ubah', array('class' => 'btn btn-default')) ?> |
                            <button class="btn btn-danger btn-sm" data-href="<?php echo base_url('admin/dashboard/hapus_pengguna/' . $user->id_user) ?>" data-toggle="modal" data-target="#confirm-delete">Hapus</button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>