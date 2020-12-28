<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="modaltambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltambahLabel">Tambah Data Penyakit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/master/penyakit/simpan" class="formsimpan">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namapenyakit">Nama Penyakit</label>
                        <input type="text" name="namapenyakit" id="namapenyakit" class="form-control form-control-sm">
                        <div class="invalid-feedback errornamapenyakit">
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
                    if (response.error.namapenyakit) {
                        $('#namapenyakit').addClass('is-invalid');
                        $('.errornamapenyakit').html(response.error.namapenyakit)
                    } else {
                        $('#namapenyakit').removeClass('is-invalid');
                        $('.errornamapenyakit').html('');
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