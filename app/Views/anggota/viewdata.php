<?= $this->extend('layout/main') ?>

<?= $this->section('title'); ?>
Manajamen Data Anggota
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" onclick="window.location='/anggota/tambah'" class="btn btn-sm btn-primary">
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
                <form action="/anggota/index" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari Data Berdasarkan Kode atau Nama"
                            name="cari" autofocus value="<?= session()->get('carianggota') ?>">
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
                    <th>Kode Anggota</th>
                    <th>Nama Anggota</th>
                    <th>Jenkel</th>
                    <th>Alamat</th>
                    <th>Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $nomor = 0 + (($nohalaman - 1) * 10);
                foreach ($dataanggota as $row) :
                    $nomor++;
                ?>

                <tr>
                    <td><?= $nomor; ?></td>
                    <td><?= $row['anggotakode']; ?></td>
                    <td><?= $row['anggotanama']; ?></td>
                    <td><?= $row['anggotajk']; ?></td>
                    <td><?= $row['anggotaalamat']; ?></td>
                    <td><?= $row['anggotatelp']; ?></td>
                    <td>
                        <!-- <button type="button" onclick="window.location='/anggota/hapus/' + <?//= $row['anggotakode'] ?>">
                            Hapus
                        </button> -->
                        <form action="/anggota/hapus/<?= $row['anggotakode'] ?>" method="post" style="display:inline;"
                            onsubmit="pesan=confirm('Yakin data ini dihapus ?'); if(pesan) return true; else return false;">
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </form>

                        <button type="button"
                            onclick="window.location='<?= site_url('anggota/edit/' . $row['anggotakode']) ?>'"
                            class="btn btn-sm btn-info">
                            <i class="fa fa-tags"></i>
                        </button>
                    </td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="float-left">
            <?= $pager->links('anggota', 'paging'); ?>
        </div>
    </div>
    <!-- /.card-body -->
    <!-- /.card-footer-->
</div>






<?= $this->endSection(); ?>