<script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
</script>
<div class="container mt-1 ms-4 me-0 mw-100">
    <div class="row w-auto me-4">
        <div class="col-3 ps-0 bg-white me-2 p-2">
            <div class="list-group">
                <a href="<?= base_url('dokter/daftar_pasien') ?>" class="list-group-item list-group-item-action fw-bold" style="color: #E79E5A;">
                    <img src=" <?= base_url('images/daftar-orange.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Daftar Pasien
                </a>
                <a href="<?= base_url('dokter/template') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src=" <?= base_url('images/template-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Template SOAP
                </a>
                <a href="<?= base_url('dokter/template_resep') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src=" <?= base_url('images/template-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Template Resep
                </a>
            </div>
        </div>
        <div class="col bg-white py-3 ms-2">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-6 text-right pe-0">
                        <div class="search">
                            <form action="<?= base_url('dokter/search_pasien/') ?>" method="POST">
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
                                    <th class="cell100 column1">No.</th>
                                    <th class="cell100 column2">No. RM</th>
                                    <th class="cell100 column3">Nama Pasien</th>
                                    <!-- <th class="cell100 column3">NIK</th> -->
                                    <th class="cell100 column4">Jenis Kelamin</th>
                                    <th class="cell100 column5">Umur</th>
                                    <th class="cell100 column6">Terakhir Daftar</th>
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

                                        <td class="cell100 column1" href='<?= base_url('dokter/soap/' . $ps['id']) ?>'><?= $index; ?></td>
                                        <td class="cell100 column2" href='<?= base_url('dokter/soap/' . $ps['id']) ?>'><?= $ps['id']; ?></td>
                                        <td class="cell100 column3" href='<?= base_url('dokter/soap/' . $ps['id']) ?>'><?= $ps['nama']; ?></td>
                                        <!-- <td class="cell100 column3" href='<?= base_url('dokter/soap/' . $ps['id']) ?>'><?= $ps['nik']; ?></td> -->
                                        <td class="cell100 column4" href='<?= base_url('dokter/soap/' . $ps['id']) ?>'><?= $ps['jenisKelamin']; ?></td>
                                        <td class="cell100 column5" href='<?= base_url('dokter/soap/' . $ps['id']) ?>'><?= $umur; ?></td>
                                        <td class="cell100 column6" href='<?= base_url('dokter/soap/' . $ps['id']) ?>'><?= $ps['terakhirDaftar']; ?></td>
                                        </tr>
                                    <?php $index++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>