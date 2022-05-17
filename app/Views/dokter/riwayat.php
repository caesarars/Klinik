<div class="container mt-1 ms-4 me-0 mw-100">
    <div class="row w-auto me-4">
        <div class="col-3 ps-0 bg-white me-2 p-2">
            <div class="list-group">
                <a href="<?= base_url('dokter/soap/' . $pasien['id']) ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src=" <?= base_url('images/cardiograph-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Rekam Medis
                </a>
                <a href="<?= base_url('dokter/riwayat/' . $pasien['id']) ?>" class="list-group-item list-group-item-action fw-bold" style="color: #E79E5A;">
                    <img src=" <?= base_url('images/history-orange.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Riwayat Rekam Medis
                </a>
            </div>
        </div>
        <div class="col ms-2">
            <div class="row py-3 bg-white">
                <div class="col-2">
                    <img src=" <?= base_url('images/profile.png') ?>" class="img-thumbnail border-0 p-0">
                </div>
                <div class="col ">
                    <h5><?= $pasien['nama']; ?></h5>
                    <h6><?php if ($pasien['jenisKelamin'] == 'L') {
                            echo 'Laki-laki';
                        } else {
                            echo 'Perempuan';
                        } ?></h6>
                    <h6><?= $pasien['tanggalLahir']; ?> - <?= $pasien['umur']; ?></h6>
                    <h6>No. Rekam Medis : <?= $pasien['id']; ?></h6>
                </div>
            </div>
            <div class="row p-3 bg-white mt-3">

                <?php foreach ($soap as $soap) : ?>
                    <div class="row p-3 m-0 bg-grey border">
                        <div class="col">
                            <h5 class="fw-bold" style="color: 2269D2;">SUBJECTIVE</h5>
                            <div class="border-2 p-1 overflow-auto" style="height: 220; width: 300;">
                                <?= nl2br($soap['subjective']); ?>
                            </div>
                            <br>
                            <h5 class="fw-bold" style="color: 2269D2;">ASSESSMENT</h5>
                            <div class="border-2 p-1 overflow-auto" style="height: 220; width: 300;">
                                <?= nl2br($soap['assesment']); ?>
                            </div>
                        </div>
                        <div class="col">
                            <h5 class="fw-bold" style="color: 2269D2;">OBJECTIVE</h5>
                            <div class="border-2 p-1 overflow-auto" style="height: 220; width: 300;">
                                <?= nl2br($soap['objective']); ?>
                            </div>
                            <br>
                            <h5 class="fw-bold" style="color: 2269D2;">PLANNING</h5>
                            <div class="border-2 p-1 overflow-auto" style="height: 220; width: 300;">
                                <?= nl2br($soap['planning']); ?>
                            </div>
                        </div>
                        <div class="col text-right">
                            <br>
                            <a href="<?= base_url('dokter/edit_soap/' . $soap['id']) ?>">
                                <img src="<?= base_url('images/edit-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                            </a>
                            <p class="m-0" style="color: 2269D2;"><?= $soap['tanggal']; ?></p>
                            <p class="m-0" style="color: 2269D2;"><?= $soap['nama']; ?></p>
                            <!-- <hr style="color: #2269D2; height: 2px;">
                            <h5 class="fw-bold m-0" style="color: 2269D2;">Tekanan Darah</h5>
                            <p class="m-0" style="color: 2269D2;"><?= $soap['tekananDarah']; ?> MmHg</p>
                            <h5 class="fw-bold m-0" style="color: 2269D2;">Frekuensi Nadi</h5>
                            <p class="m-0" style="color: 2269D2;"><?= $soap['frekuensiNadi']; ?>/Menit</p>
                            <h5 class="fw-bold m-0" style="color: 2269D2;">Suhu</h5>
                            <p class="m-0" style="color: 2269D2;"><?= $soap['suhu']; ?> C</p>
                            <h5 class="fw-bold m-0" style="color: 2269D2;">Frekuensi Nafas</h5>
                            <p class="m-0" style="color: 2269D2;"><?= $soap['frekuensiNafas']; ?>/Menit</p>
                            <h5 class="fw-bold m-0" style="color: 2269D2;">Skor Nyeri</h5>
                            <p class="m-0" style="color: 2269D2;"><?= $soap['skorNyeri']; ?></p> -->
                        </div>
                    </div>
                    <div class="row bg-white">
                        <br>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>