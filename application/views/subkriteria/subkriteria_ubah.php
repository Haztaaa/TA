<script type="text/javascript">
    $(document).ready(function() {
        $(".opsi input").removeAttr('required');
        $(".opsi select").removeAttr('required');
        $(".tipe").each(function() {
            $(this).change(function() {
                var did = $(this).attr('data-id');
                $(".opsi").attr('style', 'display:none');
                $(".opsi input").removeAttr('required');
                $(".opsi select").removeAttr('required');
                $("#div_" + did).show();
                $("#div_" + did + " input").attr('required', 'required');
            });
        });

    });
</script>
</script>
<div class="row">
    <div class="col-md-6">
        <form action="<?= base_url('subkriteria/ubah/' . $id . '/' . $idd) ?>" method="POST">
            <input type="hidden" name="id_kriteria" value="<?= $kriteria; ?>" />

            <div id="div_teks" class="opsi">
                <div class="form-group required">
                    <label for="field-1" class="col-sm-3 control-label ">Keterangan</label>
                    <div class="col-md-7">
                        <input type="text" name="ket" class="form-control " autocomplete="" value="<?= $sub->nama ?>" required />
                    </div>

                </div>
            </div>
            <br><br>
            <?= form_error('ket'); ?>
            <div id=" nilaikategori">

                <div class="form-group required">
                    <label class="col-sm-3 control-label">Nilai</label>
                    <div class="col-md-6">

                        <?php for ($i = 1; $i <= 9; $i++) : ?>
                            <?php $ch = '';
                            if ($sub->nilai == $i) : ?>
                                <?php $ch = 'checked="checked"'; ?>
                            <?php endif; ?>
                            <div class="radio radio-replace">
                                <label>
                                    <input type="radio" name="nilai" <?= $ch ?> value="<?= $i ?>" /> <?= $i ?>
                                    <?= form_error('nilai ', '<small class="text-danger pl-3">', '</small>'); ?>
                                </label>
                            </div>


                        <?php endfor; ?>


                    </div>
                </div>
            </div>
            <?= form_error('nilai'); ?>

            <div class="form-group">
                <label class="col-sm-2 ">&nbsp;</label>
                <div class="col-md-6">
                    <button type="submit" name="submit" class="btn btn-primary btn-flat">Ubah</button>
                    <a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>