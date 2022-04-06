<div class="container mt-1 ms-4 me-0 mw-100">
    <div class="row w-auto me-4">
        <div class="col-3 ps-0 bg-white me-2 p-2">
            <div class="list-group">
                <a href="" class="list-group-item list-group-item-action fw-bold" style="color: #E79E5A;">
                    <img src=" <?= base_url('images/cardiograph-orange.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Edit SOAP
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
                    <h6><?= $pasien['tanggalLahir']; ?> - <?= $pasien['umur']; ?> Tahun</h6>
                </div>
            </div>
            <div class="row pt-3 p-0 bg-white mt-3">
                <div class="col align-self-center">
                    <h5 class="font-weight-bold m-0" style="color: B02525;">SOAP</h5>
                </div>
                <div class="col text-right">
                    <a href="" type="submit" class="btn btn-primary text-center px-3 py-2" name="template">Template SOAP</a>
                </div>
            </div>
            <div class="row px-0 bg-white">
                <div class="col-100">
                    <hr style="color: #2269D2; height: 2px;">
                </div>
            </div>

            <form action="<?= base_url('dokter/update_soap/' . $soap['id']) ?>" method="POST">
                <div class="form-row bg-white justify-content-center pt-2">
                    <div class="form-group col-5">
                        <label class="fw-bold" style="color: 2269D2;" for="subjective">SUBJECTIVE</label>
                        <textarea class="form-control border-2" id="subjective" name="subjective" rows="10"><?= $soap['subjective']; ?></textarea>
                        <br>
                        <label class="fw-bold" style="color: 2269D2;" for="assesment">ASSESMENT</label>
                        <textarea class="form-control border-2" id="assesment" name="assesment" rows="10"><?= $soap['assesment']; ?></textarea>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="form-group col-5">
                        <label class="fw-bold" style="color: 2269D2;" for="objective">OBJECTIVE</label>
                        <textarea class="form-control border-2" id="objective" name="objective" rows="10"><?= $soap['objective']; ?></textarea>
                        <br>
                        <label class="fw-bold" style="color: 2269D2;" for="planning">PLANNING</label>
                        <textarea class="form-control border-2" id="planning" name="planning" rows="10"><?= $soap['planning']; ?></textarea>
                    </div>
                </div>
                <div class="row justify-content-center py-4 bg-white">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary text-center px-3 py-2" name="simpan">SIMPAN</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>