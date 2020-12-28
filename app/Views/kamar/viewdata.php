<?= $this->extend('layout/main') ?>

<?= $this->section('title'); ?>
Manajamen Data Penyakit
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" class="btn btn-sm btn-primary tomboltambah">
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
                <form action="/kamar/index" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari Kode/Nama Kamar" name="cari" autofocus
                            value="<?= session()->get('carikamar') ?>">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name="tombolcari">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?= session()->getFlashdata('pesan'); ?>
        <table class="table table-sm table-striped table-bordered">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Kode Kamar</th>
                    <th>Nama Kamar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $nomor = 0 + (($nohalaman - 1) * 10);
                foreach ($datakamar as $row) :
                    $nomor++;
                ?>

                <tr>
                    <td><?= $nomor; ?></td>
                    <td><?= $row['kamarkode']; ?></td>
                    <td><?= $row['kamarnm']; ?></td>
                    <td>
                        <form action="/kamar/hapus/<?= $row['kamarkode'] ?>" method="post" style="display:inline;"
                            class="formhapus">
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit" class="btn btn-sm btn-danger btnhapus">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </form>
                        <button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $row['kamarkode'] ?>')"
                            title="Edit Kamar">
                            <i class="fa fa-tags"></i>
                        </button>
                    </td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table><br>
        <div class="float-right">
            <?= $pager->links('kamar', 'paging'); ?>
        </div>
    </div>
    <!-- /.card-body -->
    <!-- /.card-footer-->
</div>
<div class="viewmodal" style="display: none;"></div>
<script>
function edit(kode) {
    $.ajax({
        type: "post",
        url: "/master/kamar/edit",
        data: {
            kode: kode
        },
        dataType: "json",
        success: function(response) {
            if (response.data) {
                $('.viewmodal').html(response.data).show();
                $('#modaltambah').on('shown.bs.modal', function(e) {
                    $('#namakamar').focus();
                });
                $('#modaledit').modal('show');
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" +
                thrownError);
        }
    });
}
$(document).ready(function() {
    $('.tomboltambah').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "/master/kamar/tambah",
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambah').on('shown.bs.modal', function(e) {
                        $('#kodekamar').focus();
                    });
                    $('#modaltambah').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            }
        });
    });
    $('.formhapus').submit(function(e) {
        Swal.fire({
            title: 'Hapus Data Kamar',
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