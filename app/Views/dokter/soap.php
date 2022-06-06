<script type="text/javascript">
    var templateResep = <?php echo json_encode($templateResep) ?>;
    var templateSoap = <?php echo json_encode($template) ?>;
    var assesment = <?php echo json_encode($assesment) ?>;
</script>

<!-- Modal Template SOAP -->
<div class="modal fade" id="ModalSOAP" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Pilih template SOAP yang ingin dipakai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto align-self-center">
                            <label class="mb-0">Kata Kunci</label>
                        </div>
                        <div class="col-auto align-self-center">
                            <input type="hidden" name="type" id="type" value="soap">
                            <select name="keywordSOAP" id="keywordSOAP" class="custom-select">
                                <?php foreach ($template as $template) : ?>
                                    <option value="<?= $template['id']; ?>"><?= $template['keyword']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn-modal-soap btn-primary" value="Pakai Template">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Template Resep -->
<div class="modal fade" id="modalResep" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Pilih template Resep yang ingin dipakai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto align-self-center">
                            <label class="mb-0">Kata Kunci</label>
                        </div>
                        <div class="col-auto align-self-center">
                            <input type="hidden" name="type" id="type" value="resep">
                            <select name="keywordResep" id="keywordResep" class="custom-select">
                                <?php foreach ($templateResep as $template) : ?>
                                    <option value="<?= $template['id']; ?>"><?= $template['keyword']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn-modal-resep btn-primary" value="Pakai Template">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Template Riwayat -->
<div class="modal fade" id="modalRiwayat" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Riwayat Rekam Medis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php include('riwayat.php') ?>
            </div>
        </div>
    </div>
</div>

<div class="container mt-1 ms-4 me-0 mw-100">
    <div class="row w-auto me-4">
        <div class="col-3 ps-0 bg-white me-2 p-2">
            <div class="list-group">
                <a href="<?= base_url('dokter/soap/' . $pasien['id']) ?>" class="list-group-item list-group-item-action fw-bold" style="color: #E79E5A;">
                    <img src=" <?= base_url('images/Cardiograph-orange.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Rekam Medis
                </a>
                <!-- <a href="<?= base_url('dokter/riwayat/' . $pasien['id']) ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src=" <?= base_url('images/history-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Riwayat Rekam Medis
                </a> -->
            </div>
        </div>
        <div class="col ms-2">
            <div class="row py-3 bg-white">
                <div class="col-2">
                    <img src=" <?= base_url('images/profile.png') ?>" class="img-thumbnail border-0 p-0">
                </div>
                <div class="col">
                    <h5><?= $pasien['nama']; ?></h5>
                    <h6><?php if ($pasien['jenisKelamin'] == 'L') {
                            echo 'Laki-laki';
                        } else {
                            echo 'Perempuan';
                        } ?></h6>
                    <h6><?= $pasien['tanggalLahir']; ?> - <?= $pasien['umur']; ?></h6>
                    <h6>No. Rekam Medis : <?= $pasien['id']; ?></h6>
                </div>
                <div class="col ">
                    <h6 class="fw-bold">Berat Badan</h6>
                    <p><?= $assesment['beratBadan']; ?> Kg</p>
                    <h6 class="fw-bold">Tinggi Badan</h6>
                    <p class="mb-0"><?= $assesment['tinggiBadan']; ?> Cm</p>

                </div>
            </div>
            <!-- <div class="row pt-3 p-0 bg-white mt-3">
                <div class="col align-self-center">
                    <h5 class="font-weight-bold m-0" role="button" data-toggle="collapse" data-parent="#accordion" href="#assesmentPerawat" aria-expanded="true" aria-controls="assesmentPerawat" style="color: B02525;">
                        ASSESMENT PERAWAT
                    </h5>
                </div>
            </div>
            <div class="row px-0 bg-white">
                <div class="col-100">
                    <hr style="color: #2269D2; height: 2px;">
                </div>
            </div>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div id="assesmentPerawat" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="assesmentPerawat">
                        <div class="panel-body">
                            <div class="row px-0 bg-white justify-content-center">
                                <div class="col-4">
                                    <h6 class="">Tekanan Darah :<?= $assesment['tekananDarah']; ?> MmHg</h6>
                                    <h6 class="">Frekuensi Nadi :<?= $assesment['frekuensiNadi']; ?> X/Menit</h6>
                                    <h6 class="">Suhu :<?= $assesment['suhu']; ?> C</h6>
                                </div>
                                <div class="col-4">
                                    <h6 class="">Frekuensi Nafas :<?= $assesment['frekuensiNafas']; ?></h6>
                                    <h6 class="">Skor Nyeri :<?= $assesment['skorNyeri']; ?> MmHg</h6>
                                    <h6 class="">IMT :<?= $assesment['IMT']; ?> Kg/M2</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-3 p-0 bg-white mt-3">
                <div class="col align-self-center">
                    <h5 class="font-weight-bold m-0" role="button" data-toggle="collapse" data-parent="#accordion" href="#keluhanUtama" aria-expanded="true" aria-controls="keluhanUtama" style="color: B02525;">
                        KELUHAN UTAMA
                    </h5>
                </div>
            </div>
            <div class="row px-0 bg-white">
                <div class="col-100">
                    <hr style="color: #2269D2; height: 2px;">
                </div>
            </div> -->
            <!-- <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div id="keluhanUtama" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="keluhanUtama">
                        <div class="panel-body">
                            <div class="row px-0 mx-2 bg-white justify-content-center">
                                <div class="border-2 p-2 overflow-auto" style="height: 100; ">
                                    <?= nl2br($assesment['keluhanUtama']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row pt-3 p-0 bg-white mt-3">
                <div class="col align-self-center">
                    <h5 class="font-weight-bold m-0" style="color: B02525;">SOAP</h5>
                </div>
                <div class="col text-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalRiwayat">
                        Riwayat SOAP
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSOAP">
                        Template SOAP
                    </button>
                </div>
            </div>
            <div class="row px-0 bg-white">
                <div class="col-100">
                    <hr style="color: #2269D2; height: 2px;">
                </div>
            </div>
            <form action="<?= base_url('dokter/insert_soap/' . $pasien['id']) ?>" method="POST">
                <div class="form-row bg-white justify-content-center pt-2">
                    <div class="form-group col-5">
                        <label class="fw-bold" style="color: 2269D2;" for="subjective">SUBJECTIVE</label>
                        <textarea class="form-control border-2" id="subjective" name="subjective" rows="10" required><?php
                                                                                                                        echo 'Keluhan Utama : ';
                                                                                                                        echo $assesment['keluhanUtama'];
                                                                                                                        echo "\n\n";
                                                                                                                        if (isset($selectedSubjective)) {
                                                                                                                            echo $selectedSubjective;
                                                                                                                        }
                                                                                                                        ?></textarea>
                        <br>
                        <label class="fw-bold" style="color: 2269D2;" for="assesment">ASSESSMENT</label>
                        <textarea class="form-control border-2" id="assesment" name="assesment" rows="10" required><?php
                                                                                                                    if (isset($selectedAssesment)) {
                                                                                                                        echo $selectedAssesment;
                                                                                                                    }
                                                                                                                    ?></textarea>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="form-group col-5">
                        <label class="fw-bold" style="color: 2269D2;" for="objective">OBJECTIVE</label>
                        <textarea class="form-control border-2" id="objective" name="objective" rows="10" required><?php

                                                                                                                    echo "Berat Badan :";
                                                                                                                    echo $assesment['beratBadan'];
                                                                                                                    echo "Kg\n";
                                                                                                                    echo "Tinggi Badan :";
                                                                                                                    echo $assesment['tinggiBadan'];
                                                                                                                    echo "Cm\n";
                                                                                                                    echo "Tekanan Darah :";
                                                                                                                    echo $assesment['tekananDarah'];
                                                                                                                    echo "MmHg\n";
                                                                                                                    echo 'Frekuensi Nadi : ';
                                                                                                                    echo $assesment['frekuensiNadi'];
                                                                                                                    echo " X/Menit\n";
                                                                                                                    echo 'Suhu : ';
                                                                                                                    echo $assesment['suhu'];
                                                                                                                    echo " C\n";
                                                                                                                    echo 'Frekuensi Nafas : ';
                                                                                                                    echo $assesment['frekuensiNafas'];
                                                                                                                    echo " X/Menit\n";
                                                                                                                    echo 'Skor Nyeri :';
                                                                                                                    echo $assesment['skorNyeri'];
                                                                                                                    echo "\n";
                                                                                                                    echo 'IMT : ';
                                                                                                                    echo $assesment['IMT'];
                                                                                                                    echo " Kg/M2\n\n";
                                                                                                                    if (isset($selectedObjective)) {
                                                                                                                        echo $selectedObjective;
                                                                                                                    }
                                                                                                                    ?></textarea>
                        <br>
                        <label class="fw-bold" style="color: 2269D2;" for="planning">PLANNING</label>
                        <textarea class="form-control border-2" id="planning" name="planning" rows="10" required><?php
                                                                                                                    if (isset($selectedPlanning)) {
                                                                                                                        echo $selectedPlanning;
                                                                                                                    }
                                                                                                                    ?></textarea>
                    </div>
                    <div class="form-group col-11 text-center">
                        <label class="fw-bold " style="color: 2269D2;" for="resep">RESEP</label>
                        <textarea class="form-control border-2" id="resep" name="resep" rows="10" required><?php
                                                                                                            if (isset($selectedResep)) {
                                                                                                                echo $selectedResep;
                                                                                                            }
                                                                                                            ?></textarea>
                        <div class="col text-right pe-0 mt-2">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalResep">
                                Template Resep
                            </button>
                        </div>
                    </div>
                    <!-- <div class="col text-right pe-0 mt-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalResep">
                            Tambah Resep
                        </button>
                    </div>
                    </div> -->
                </div>
                <!-- Modal Resep -->
                <!-- <div class="modal fade" id="ModalResep" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Tambah Resep</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 align-items-center m-3">
                            <textarea class="form-control border-2" id="resep" name="resep" rows="10"></textarea>
                        </div>
                        <div class="modal-footer">
                            <input type="" class="btn btn-primary" data-bs-dismiss="modal" value="Tambah Resep">
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
                <div class="row justify-content-center py-4 bg-white">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary text-center px-3 py-2" name="simpan">SIMPAN</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    $('.btn-modal-resep').on('click', function(e) {
        e.preventDefault();
        var resep = document.getElementById('resep').value;
        var selected = document.getElementById('keywordResep').value;
        let template = templateResep.find(template => template.id === selected);
        document.getElementById('resep').value = resep + "\n" + template.resep;
        $('#modalResep').modal('hide');
    })

    $('.btn-modal-soap').on('click', function(e) {
        e.preventDefault();
        var selected = document.getElementById('keywordSOAP').value;
        let template = templateSoap.find(template => template.id === selected);
        document.getElementById('subjective').value = "Keluhan Utama :" +
            assesment.keluhanUtama +
            "\n\n" +
            template.subjective;
        document.getElementById('objective').value = "Berat Badan :" +
            assesment.beratBadan +
            " Kg\n" +
            "Tinggi Badan :" +
            assesment.tinggiBadan +
            " Cm\n" +
            "Tekanan Darah :" +
            assesment.tekananDarah +
            " MmHg\n" +
            'Frekuensi Nadi : ' +
            assesment.frekuensiNadi +
            " X/Menit\n" +
            'Suhu : ' +
            assesment.suhu +
            " C\n" +
            'Frekuensi Nafas : ' +
            assesment.frekuensiNafas +
            " X/Menit\n" +
            'Skor Nyeri :' +
            assesment.skorNyeri +
            "\n" +
            'IMT : ' +
            assesment.IMT +
            " Kg/M2\n\n" +
            template.objective;
        document.getElementById('assesment').value = template.assesment;
        document.getElementById('planning').value = template.planning;
        $('#ModalSOAP').modal('hide');
    })
</script>