<?= $this->extend('layout/main') ?>

<?= $this->section('title'); ?>
Manajamen Data Pasien
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" onclick="window.location='/pasien/tambah'" class="btn btn-sm btn-primary">
                Tambah Data
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
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="/pasien/index" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari Nomor / Nama Pasien" name="cari"
                            autofocus value="<?= session()->get('caripasien') ?>">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name="tombolcari">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-sm table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No.Pasien</th>
                    <th>Nama</th>
                    <th>Jenkel</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $nomor = 0 + (($nohalaman - 1) * 10);
                foreach ($datapasien as $row) :
                    $nomor++;
                ?>

                <tr>
                    <td><?= $nomor; ?></td>
                    <td><?= $row['pasienno']; ?></td>
                    <td><?= $row['pasiennama']; ?></td>
                    <td><?= $row['pasienjk']; ?></td>
                    <td>
                        <form action="/pasien/hapus/<?= $row['pasienno'] ?>" method="post" style="display:inline;"
                            class="formhapus">
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit" class="btn btn-sm btn-danger btnhapus">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </form>

                        <button type="button"
                            onclick="window.location='<?= site_url('pasien/edit/' . $row['pasienno']) ?>'"
                            class="btn btn-sm btn-info">
                            <i class="fa fa-tags"></i>
                        </button>
                    </td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table><br>
        <div class="float-right">
            <?= $pager->links('pasien', 'paging'); ?>
        </div>
    </div>
    <!-- /.card-body -->
    <!-- /.card-footer-->
</div>
<script>
$(document).ready(function() {
    $('.formhapus').submit(function(e) {
        Swal.fire({
            title: 'Hapus Data Pasien',
            text: "Yakin data ini dihapus ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Hapus',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function() {
                        window.location.reload();
                    }
                });
            }
        });
        return false;
    });
});
</script>

<?= $this->endSection(); ?>