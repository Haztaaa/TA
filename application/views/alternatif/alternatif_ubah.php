<!-- get alternatif -->
<script type="text/javascript">
    $(document).ready(function() {
        $("select").select2();
    });
</script>
<h2 for="">Halaman Ubah Alternatif</h2>
<div class="row">
    <?= form_open('Alternatif/ubah/' . $idd); ?>
    <div class="form-group required">
        <label class="col-sm-2 control-label" for="">Nama Sekolah</label>
        <div class="col-md-10">
            <select name="id_tps" class="form-control">
                <option value='<?php echo $tes->id_tps ?>'><?php echo $tes->nama_tps ?></option>

            </select>
        </div>
    </div>
    <?php $tes = array();

    foreach ($alt_nilai as $alt) {
        $tes[] = $alt->id_subkriteria;
    } ?>

    <br><br><br><br>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="">Penilaian</label>
        <div class="col-md-10">
            <table class="table table-bordered">
                <thead>
                    <th>Kriteria</th>
                    <th>Nilai</th>
                </thead>
                <tbody>
                    <?php
                    if (!empty($kriteria)) {
                        $no = 0;
                        foreach ($kriteria as $rk) {
                            $no++;
                            $kriteriaid = $rk->id_kriteria;


                            echo '<tr>';
                            echo '<td>' . $rk->nama_kriteria . '</td>';
                            echo '<td>';
                            $dSub = $this->m_db->get_data('subkriteria', array('id_kriteria' => $kriteriaid));
                            if (!empty($dSub)) {


                                echo '<select name="kriteria[' . $kriteriaid . ']"  class="form-control" data-placeholder="Pilih Nilai" style="width: 100%">';

                                echo '<option></option>';
                                foreach ($dSub as $rSub) {

                                    if (in_array($rSub->id_subkriteria, $tes)) {

                                        echo '<option value="' . $rSub->id_subkriteria . '" selected> ' . $rSub->nama . ' (' . $rSub->nilai . ')' . '</option>';
                                    } else {
                                        echo '<option value="' . $rSub->id_subkriteria . '" > ' . $rSub->nama . ' (' . $rSub->nilai . ')' . '</option>';
                                    }
                                }

                                echo '</select>';
                            } else {

                                echo 'Kriteria ini belum ada nilainya, Tolong di isi dulu  ';
                            }
                            $al = $this->db->query("SELECT * FROM alternatif_nilai WHERE id_kriteria ='$kriteriaid' AND id_alternatif ='$idd'")->result();
                            foreach ($al as $s) {
                                echo '<input type="hidden" name="id_alt_nilai' . $no . '" value="' . $s->id_alternatif_nilai . '">';
                            }
                            echo form_error('kriteria[' . $kriteriaid . ']');
                            echo '</td>';

                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-md-6">




            <button type="submit" name="submit" class="btn btn-primary btn-flat">Ubah</button>
            <a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>

        </div>
    </div>
    <?= form_close(); ?>
</div>