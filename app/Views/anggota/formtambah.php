<?= $this->extend('layout/main') ?>

<?= $this->section('title'); ?>
Manajamen Data Anggota
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button class="btn btn-sm btn-danger" type="button" onclick="window.location='/anggota/index'">
                Kembali
            </button>

        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">

        <form method="post" action="/anggota/simpan">

            <div class="form-group">
                <label>Kode Anggota</label>
                <input type="text" name="kodeanggota" maxlength="5" class="form-control form-control-sm">
                <?php
                if (isset($validation)) {
                    echo '<br>';
                    echo '<span style="color:red; font-size:11px">';
                    echo $validation->getError('kodeanggota');
                    echo '</span>';
                }
                ?>
            </div>

            <div class="form-group">
                <label>Nama Anggota</label>
                <input type="text" name="namaanggota" class="form-control form-control-sm">
                <?php
                if (isset($validation)) {
                    echo '<br>';
                    echo '<span style="color:red; font-size:11px">';
                    echo $validation->getError('namaanggota');
                    echo '</span>';
                }
                ?>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <br>
                <input type="radio" name="jenkel" value="L"> Laki-Laki &nbsp;
                <input type="radio" name="jenkel" value="P"> Perempuan
                <?php
                if (isset($validation)) {
                    echo '<br>';
                    echo '<span style="color:red; font-size:11px">';
                    echo $validation->getError('jenkel');
                    echo '</span>';
                }
                ?>
            </div>

            <div class="form-group">
                <label>No.Telp/HP</label>
                <input type="text" name="telp" class="form-control form-control-sm">
                <?php
                if (isset($validation)) {
                    echo '<br>';
                    echo '<span style="color:red; font-size:11px">';
                    echo $validation->getError('telp');
                    echo '</span>';
                }
                ?>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control form-control-sm" cols="30" rows="10"></textarea>
                <?php
                if (isset($validation)) {
                    echo '<br>';
                    echo '<span style="color:red; font-size:11px">';
                    echo $validation->getError('alamat');
                    echo '</span>';
                }
                ?>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-success">
                    Simpan Data
                </button>


            </div>

        </form>

    </div>
    <!-- /.card-body -->
    <!-- /.card-footer-->
</div>




<?= $this->endSection(); ?>