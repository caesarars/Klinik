<div class="container mt-1 ms-4 me-0 mw-100">
    <div class="row w-auto me-4">
        <div class="col-3 ps-0 bg-white me-2 p-2">
            <div class="list-group">
                <a href="<?= base_url('perawat/assesment/' . $pasien['id']) ?>" class="list-group-item list-group-item-action fw-bold" style="color: #E79E5A;">
                    <img src=" <?= base_url('images/cardiograph-orange.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Assesment Perawat
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
            <div class="row pt-3 p-0 bg-white mt-3">
                <h5 class="font-weight-bold" style="color: B02525;">Assesment Perawat</h5>
            </div>
            <div class="row px-0 bg-white">
                <div class="col-100">
                    <hr style="color: #2269D2; height: 2px;">
                </div>
            </div>
            <div class="row bg-white justify-content-center py-1">
                <div class="col-5" style="background-color: #E5E5E5;" align="center">
                    <h6 class="fw-bold" style="color: #2269D2;">Tanda Vital</h6>
                </div>
                <div class="col-5" style="background-color: #E5E5E5;" align="center">
                    <h6 class="fw-bold" style="color: #2269D2;">Nutrisi</h6>
                </div>
            </div>
            <form action="<?= base_url('perawat/insert_assesment/' . $pasien['id']) ?>" method="POST">
                <div class="row bg-white justify-content-center pt-2">
                    <div class="col-5">
                        <p class="fw-bold mb-0">Tekanan Darah</p>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="tekananDarah" id="tekananDarah" autocomplete="off">
                            </div>
                            <div class="col-2 px-0">
                                <p>MmHg</p>
                            </div>
                        </div>
                        <p class="fw-bold mb-0">Frekuensi Nadi</p>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="frekuensiNadi" id="frekuensiNadi" autocomplete="off">
                            </div>
                            <div class="col-2 px-0">
                                <p>X/Menit</p>
                            </div>
                        </div>
                        <p class="fw-bold mb-0">Suhu</p>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="suhu" id="suhu" autocomplete="off">
                            </div>
                            <div class="col-2 px-0">
                                <p>C</p>
                            </div>
                        </div>
                        <p class="fw-bold mb-0">Frekuensi Nafas</p>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="frekuensiNafas" id="frekuensiNafas" autocomplete="off">
                            </div>
                            <div class="col-2 px-0">
                                <p>X/Menit</p>
                            </div>
                        </div>
                        <p class="fw-bold mb-0">Skor Nyeri</p>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="skorNyeri" id="skorNyeri" autocomplete="off">
                            </div>
                            <div class="col-2 px-0">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class=" col-5">
                        <p class="fw-bold mb-0">Berat Badan</p>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="beratBadan" id="beratBadan" autocomplete="off">
                            </div>
                            <div class="col-2 px-0">
                                <p>Gr/Kg</p>
                            </div>
                        </div>
                        <p class="fw-bold mb-0">Tinggi Badan</p>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="tinggiBadan" id="tinggiBadan" autocomplete="off">
                            </div>
                            <div class="col-2 px-0">
                                <p>Cm</p>
                            </div>
                        </div>
                        <p class="fw-bold mb-0">IMT</p>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="imt" id="imt" autocomplete="off">
                            </div>
                            <div class="col-2 px-0">
                                <p>Kg/M2</p>
                            </div>
                        </div>
                        <p class="fw-bold mb-0">Khusus Pediatri</p>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="pediatri" id="pediatri" autocomplete="off">
                            </div>
                            <div class="col-2 px-0">
                            </div>
                        </div>
                        <p class="fw-bold mb-0">Lingkar Kepala</p>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="lingkarKepala" id="lingkarKepala" autocomplete="off">
                            </div>
                            <div class="col-2 px-0">
                                <p>Cm</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center py-4 bg-white">
                    <div class="col text-center m-0">
                        <button type="submit" class="btn btn-primary text-center px-3 py-2" name="simpan">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>