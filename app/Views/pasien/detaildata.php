<!-- Modal -->
<div class="modal fade" id="modaldetail" tabindex="-1" aria-labelledby="modaldetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h5 class="modal-title" id="modaldetailLabel">Detail Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <td>No. Pasien :</td>
                            <td>
                                <?= $row['pasienno']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>NIK Pasien :</td>
                            <td>
                                <?= $row['pasiennoktp']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Pasien :</td>
                            <td>
                                <?= $row['pasiennama']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tempat/Tgl.Lahir :</td>
                            <td>
                                <?= $row['pasientmplahir'] . ' / ' . $row['pasientgllahir']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat :</td>
                            <td>
                                <?= $row['pasienalamat']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenkel :</td>
                            <td>
                                <?php
                                echo ($row['pasienjk'] == 'L') ? 'Laki-Laki' : 'Perempuan';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Telp :</td>
                            <td>
                                <?= $row['pasientelp']; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>