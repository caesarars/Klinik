<script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
</script>
<div class="container mt-1 ms-4 me-0 mw-100">
    <div class="row w-auto me-4">
        <div class="col-3 ps-0 bg-white me-2 p-2">
            <div class="list-group">
                <a href="<?= base_url('pemilik/daftar_dokter') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src="<?= base_url('images/doctor-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Dokter
                </a>
                <a href="<?= base_url('pemilik/daftar_perawat') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src="<?= base_url('images/doctor-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Perawat
                </a>
                <a href="<?= base_url('pemilik/daftar_admin') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src="<?= base_url('images/doctor-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Administrator
                </a>
                <a href="<?= base_url('pemilik/daftar_apoteker') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src="<?= base_url('images/doctor-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Apoteker
                </a>
                <a href="<?= base_url('pemilik/export_soap') ?>" class="list-group-item list-group-item-action fw-bold" style="color: #E79E5A;">
                    <img src="<?= base_url('images/export-orange.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Export Data Rekam Medis
                </a>
                <a href="<?= base_url('pemilik/export_data_pasien') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src="<?= base_url('images/export-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Export Data Pasien
                </a>
            </div>
        </div>
        <div class="col bg-white py-3 ms-2">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-sm-1 pe-0">
                        <img src="<?= base_url('images/doctor-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    </div>
                    <div class="col ps-0">
                        <h6>Informasi Administrator</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col px-0">
                        <hr style="color: #2269D2; height: 2px;">
                    </div>
                </div>
                <form action="<?= base_url('pemilik/export_data_soap') ?>" method="POST">
                    <div class="row justify-content-md-center">
                        <div class="col-2 pe-0">
                            <p>Dari Tanggal</p>
                            <input type="date" class="form-control" name="tanggalDari" id="tanggalDari" autocomplete="off">
                        </div>
                        <div class="col-2 pe-0">
                            <p>Hingga Tanggal</p>
                            <input type="date" class="form-control" name="tanggalHingga" id="tanggalHingga" autocomplete="off">
                        </div>
                    </div>
                    <div class="row justify-content-end mt-4">
                        <div class="col text-right pe-0">
                            <button type="submit" class="btn btn-primary text-center px-3 py-2" name="export">EXPORT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>