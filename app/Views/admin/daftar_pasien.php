<script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
</script>
<div class="container mt-1 ms-4 me-0 mw-100">
    <div class="row w-auto me-4">
        <div class="col-3 ps-0 bg-white me-2 p-2">
            <div class="list-group">

                <a href="<?= base_url('admin/tambah_pasien') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src=" <?= base_url('images/add-person-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Tambah Pasien
                </a>
                <a href="<?= base_url('admin/daftar_pasien') ?>" class="list-group-item list-group-item-action fw-bold" style="color: #E79E5A;">
                    <img src=" <?= base_url('images/daftar-orange.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Daftar Pasien
                </a>
            </div>
        </div>
        <div class="col bg-white py-3 ms-2">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-6 text-right pe-0">
                        <div class="search">
                            <form action="<?= base_url('admin/search_pasien/') ?>" method="POST">
                                <input type="text" id="keyword" name="keyword" placeholder="Masukan NIK atau Nama" class="form-control">
                                <button type="submit" class="btn btn-outline-light border-0">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table100 ver1 m-b-110 mt-3">
                    <div class="table100-head">
                        <table>
                            <thead>
                                <tr class="row100 head">
                                    <th class="cell100 column1">No. RM</th>
                                    <th class="cell100 column2">Nama Pasien</th>
                                    <th class="cell100 column3">NIK</th>
                                    <th class="cell100 column4">Umur </th>
                                    <th class="cell100 column5">Terakhir Daftar</th>
                                    <th class="cell100 column6">Tindakan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="table100-body js-pscroll">
                        <table>

                            <tbody>
                                <?php
                                $index = 1;
                                foreach ($pasien as $ps) :
                                    date_default_timezone_set('Asia/Jakarta');
                                    $currentDate = new DateTime();
                                    $tanggalLahir = new DateTime($ps['tanggalLahir']);
                                    $umur = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
                                    if ($ps['soap']) {
                                ?>

                                        <tr class="row100 body" style="background-color: #96b4e1;">
                                        <?php } elseif ($ps['assesment']) { ?>
                                        <tr class="row100 body" style="background-color: #fce303;">
                                        <?php } else { ?>
                                        <tr class="row100 body">
                                        <?php } ?>
                                        <td class="cell100 column1" href='<?= base_url('admin/data_pasien/' . $ps['id']) ?>'><?= $ps['id']; ?></td>
                                        <td class="cell100 column2" href='<?= base_url('admin/data_pasien/' . $ps['id']) ?>'><?= $ps['nama']; ?></td>
                                        <td class="cell100 column3" href='<?= base_url('admin/data_pasien/' . $ps['id']) ?>'><?= $ps['nik']; ?></td>
                                        <td class="cell100 column4" href='<?= base_url('admin/data_pasien/' . $ps['id']) ?>'><?= $umur ?></td>
                                        <td class="cell100 column5" href='<?= base_url('admin/data_pasien/' . $ps['id']) ?>'><?= $ps['terakhirDaftar']; ?></td>
                                        <td class="cell column6">
                                            <a href="<?= base_url('admin/edit_pasien/' . $ps['id']) ?>">
                                                <img src="<?= base_url('images/edit-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                                            </a>
                                            <a class="btn-delete" href="<?= base_url('admin/delete_pasien/' . $ps['id']) ?>">
                                                <img src="<?= base_url('images/delete-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                                            </a>
                                        </td>
                                        </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>