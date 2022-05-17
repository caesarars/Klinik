<script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
</script>
<div class="container mt-1 ms-4 me-0 mw-100">
    <div class="row w-auto me-4">
        <div class="col-3 ps-0 bg-white me-2 p-2">
            <div class="list-group">
                <a href="<?= base_url('dokter/daftar_pasien') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src=" <?= base_url('images/daftar-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Daftar Pasien
                </a>
                <a href="<?= base_url('dokter/template') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src=" <?= base_url('images/template-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Template SOAP
                </a>
                <a href="<?= base_url('dokter/template_resep') ?>" class="list-group-item list-group-item-action fw-bold" style="color: #E79E5A;">
                    <img src=" <?= base_url('images/template-orange.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Template Resep
                </a>
            </div>
        </div>
        <div class="col ms-2 bg-white">
            <div class="row pt-3 p-0 bg-white mt-3">
                <div class="col align-self-center">
                    <h5 class="font-weight-bold m-0" style="color: B02525;">Template Resep</h5>
                </div>
                <div class="col text-right">
                    <a href="<?= base_url('dokter/tambah_template_resep') ?>" type="submit" class="btn btn-primary text-center px-3 py-2" name="template">Tambah Template</a>
                </div>
            </div>
            <div class="row px-0">
                <div class="col-100">
                    <hr style="color: #2269D2; height: 2px;">
                </div>
            </div>
            <?php
            // dd($template);
            if ($template) {
                foreach ($template as $template) : ?>


                    <div class="row p-3 m-0 bg-grey border">
                        <div class="row p-0 m-0">
                            <div class="col">
                                <h6 class="fw-bold" style="color: 2269D2;">Kata Kunci : <?= $template['keyword']; ?>
                                    <a href="<?= base_url('dokter/edit_template_resep/' . $template['id']) ?>">
                                        <img src="<?= base_url('images/edit-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                                    </a>
                                    <a class='btn-delete' href="<?= base_url('dokter/delete_template_resep/' . $template['id']) ?>">
                                        <img src="<?= base_url('images/delete-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                                    </a>
                                </h6>
                            </div>
                            <!-- <div class="col pt-0 m-0">
                                <h6></h6>
                            </div> -->
                        </div>
                        <div class="col">
                            <h5 class="fw-bold" style="color: 2269D2;">RESEP</h5>
                            <div class="border-2 p-1 overflow-auto" style="height: 507;">
                                <?= nl2br($template['resep']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row bg-white">
                        <br>
                    </div>
            <?php endforeach;
            }; ?>
        </div>
    </div>
</div>