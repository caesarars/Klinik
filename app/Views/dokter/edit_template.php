<div class="container mt-1 ms-4 me-0 mw-100">
    <div class="row w-auto me-4">
        <div class="col-3 ps-0 bg-white me-2 p-2">
            <div class="list-group">
                <a href="<?= base_url('dokter/daftar_pasien') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src=" <?= base_url('images/daftar-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Daftar Pasien
                </a>
                <a href="<?= base_url('dokter/template') ?>" class="list-group-item list-group-item-action fw-bold" style="color: #E79E5A;">
                    <img src=" <?= base_url('images/template-orange.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Template SOAP
                </a>
            </div>
        </div>
        <div class="col ms-2 bg-white">
            <div class="row pt-3 p-0 mt-3">
                <h5 class="font-weight-bold" style="color: B02525;">Edit Template SOAP</h5>
            </div>
            <div class="row px-0">
                <div class="col-100">
                    <hr style="color: #2269D2; height: 2px;">
                </div>
            </div>
            <form action="<?= base_url('dokter/update_template/' . $template['id']) ?>" method="POST">
                <div class="form-row pt-2" style="padding-left: 45px;">

                    <label class="fw-bold " style="color: 2269D2;" for="keyword">Kata Kunci</label>
                    <div class="form-group col-5" style="padding-left: 45px;">
                        <input type="text" class="form-control border-2" name="keyword" id="keyword" autocomplete="off" value="<?= $template['keyword']; ?>" required>
                    </div>
                </div>
                <div class="form-row justify-content-center pt-2">
                    <div class="form-group col-5">
                        <label class="fw-bold" style="color: 2269D2;" for="subjective">SUBJECTIVE</label>
                        <textarea class="form-control border-2" id="subjective" name="subjective" rows="10" required><?= $template['subjective']; ?></textarea>
                        <br>
                        <label class="fw-bold" style="color: 2269D2;" for="assesment">ASSESMENT</label>
                        <textarea class="form-control border-2" id="assesment" name="assesment" rows="10" required><?= $template['assesment']; ?></textarea>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="form-group col-5">
                        <label class="fw-bold" style="color: 2269D2;" for="objective">OBJECTIVE</label>
                        <textarea class="form-control border-2" id="objective" name="objective" rows="10" required><?= $template['objective']; ?></textarea>
                        <br>
                        <label class="fw-bold" style="color: 2269D2;" for="planning">PLANNING</label>
                        <textarea class="form-control border-2" id="planning" name="planning" rows="10" required><?= $template['planning']; ?></textarea>
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