<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="modaltambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltambahLabel">Tambah Data Kamar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/master/kamar/simpan" class="formsimpan">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kodekamar">Kode kamar</label>
                        <input type="text" name="kodekamar" id="kodekamar" class="form-control form-control-sm">
                        <div class="invalid-feedback errorkodekamar">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="namakamar">Nama kamar</label>
                        <input type="text" name="namakamar" id="namakamar" class="form-control form-control-sm">
                        <div class="invalid-feedback errornamakamar">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success tombolsimpan">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.formsimpan').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.tombolsimpan').prop('disabled', true);
                $('.tombolsimpan').html('<i class="fa fa-spinner fa-spin"></i>');
            },
            complete: function(e) {
                $('.tombolsimpan').prop('disabled', false);
                $('.tombolsimpan').html('Simpan');
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.namakamar) {
                        $('#namakamar').addClass('is-invalid');
                        $('.errornamakamar').html(response.error.namakamar);
                    } else {
                        $('#namakamar').removeClass('is-invalid');
                        $('#namakamar').addClass('is-valid');
                        $('.errornamakamar').html('');
                    }

                    if (response.error.kodekamar) {
                        $('#kodekamar').addClass('is-invalid');
                        $('.errorkodekamar').html(response.error.kodekamar);
                    } else {
                        $('#kodekamar').removeClass('is-invalid');
                        $('#kodekamar').addClass('is-valid');
                        $('.errorkodekamar').html('');
                    }
                } else {
                    window.location.reload();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            }
        });
        return false;
    });
});
</script>