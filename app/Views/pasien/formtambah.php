<?= $this->extend('layout/main') ?>

<?= $this->section('title'); ?>
Tambah Data <div class="preloader-wrapper active">
    <!-- spinner-blue -->
    <div class="spinner-layer spinner-blue">
        <div class="circle-clipper left">
            <div class="circle"></div>
        </div>
        <div class="gap-patch">
            <div class="circle"></div>
        </div>
        <div class="circle-clipper right">
            <div class="circle"></div>
        </div>
    </div>
    <!-- spinner-red -->
    <div class="spinner-layer spinner-red">
        <div class="circle-clipper left">
            <div class="circle"></div>
        </div>
        <div class="gap-patch">
            <div class="circle"></div>
        </div>
        <div class="circle-clipper right">
            <div class="circle"></div>
        </div>
    </div>
    <!-- spinner-yellow -->
    <div class="spinner-layer spinner-yellow">
        <div class="circle-clipper left">
            <div class="circle"></div>
        </div>
        <div class="gap-patch">
            <div class="circle"></div>
        </div>
        <div class="circle-clipper right">
            <div class="circle"></div>
        </div>
    </div>
    <!-- spinner-greem -->
    <div class="spinner-layer spinner-green">
        <div class="circle-clipper left">
            <div class="circle"></div>
        </div>
        <div class="gap-patch">
            <div class="circle"></div>
        </div>
        <div class="circle-clipper right">
            <div class="circle"></div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button class="btn btn-sm btn-danger" type="button" onclick="window.location='/pasien/index'">
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

        <form method="post" action="/pasien/simpan">

            <div class="form-group">
                <label>No.Pasien</label>
                <input type="text" name="nopasien" maxlength="5" class="form-control form-control-sm" autofocus
                    maxlength="6">
                <?php
                if (isset($validation)) {
                    echo '<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                ' . $validation->getError('nopasien') . '
                            </div>';
                }
                ?>
            </div>

            <div class="form-group">
                <label>NIK (Nomor Induk Kependudukan) Pasien</label>
                <input type="text" name="nik" class="form-control form-control-sm" maxlength="16">
                <?php
                if (isset($validation)) {
                    echo '<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                ' . $validation->getError('nik') . '
                            </div>';
                }
                ?>
            </div>
            <div class="form-group">
                <label>Nama Pasien</label>
                <input type="text" name="namapasien" class="form-control form-control-sm">
                <?php
                if (isset($validation)) {
                    echo '<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                ' . $validation->getError('namapasien') . '
                            </div>';
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
                    echo '<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                ' . $validation->getError('jenkel') . '
                            </div>';
                }
                ?>
            </div>

            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" name="tmplahir" class="form-control form-control-sm">
                <?php
                if (isset($validation)) {
                    echo '<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                ' . $validation->getError('tmplahir') . '
                            </div>';
                }
                ?>
            </div>
            <div class="form-group">
                <label>Tgl. Lahir</label>
                <input type="date" name="tgllahir" class="form-control form-control-sm">
                <?php
                if (isset($validation)) {
                    echo '<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                ' . $validation->getError('tgllahir') . '
                            </div>';
                }
                ?>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control form-control-sm" cols="30" rows="10"></textarea>
                <?php
                if (isset($validation)) {
                    echo '<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                ' . $validation->getError('alamat') . '
                            </div>';
                }
                ?>
            </div>
            <div class="form-group">
                <label>No.HP/Telp</label>
                <input type="text" name="telp" class="form-control form-control-sm">
                <?php
                if (isset($validation)) {
                    echo '<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                ' . $validation->getError('telp') . '
                            </div>';
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