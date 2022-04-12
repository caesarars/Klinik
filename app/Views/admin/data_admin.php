<div class="container mt-1 ms-4 me-0 mw-100">
    <div class="row w-auto me-4">
        <div class="col-3 ps-0 bg-white me-2 p-2">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action fw-bold">
                    <img src=" <?= base_url('images/profil-orange.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Data Identitas
                </a>
            </div>
        </div>
        <div class="col bg-white py-3 ms-2">
            <div class="container">
                <div class="row align-content-left">
                    <div class="col-3">
                        <a href="<?= base_url('admin/edit_admin/' . $admin['id']) ?>" class="btn-primary p-2">
                            <img src="<?= base_url('images/edit-white.png') ?>" class="img-thumbnail bg-transparent border-0" style="height: 30px;" alt="">
                            Ubah Admin
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="<?= base_url('admin/delete_admin/' . $admin['id']) ?>" class="btn-primary p-2">
                            <img src="<?= base_url('images/delete-white.png') ?>" class="img-thumbnail bg-transparent border-0" style="height: 30px;" alt="">
                            Hapus Admin
                        </a>
                    </div>
                </div>
                <div class="row align-items-start mt-4">
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
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Nama Lengkap</p>
                        <p><?= $admin['nama']; ?></p>
                    </div>
                    <div class="col pe-0">
                        <p class="fw-bold mb-0">NIK</p>
                        <p><?= $admin['nik']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Tempat Lahir</p>
                        <p><?= $admin['tempatLahir']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Tanggal Lahir</p>
                        <p><?= $admin['tanggalLahir']; ?></p>
                    </div>
                    <div class="col pe-0">
                        <p class="fw-bold mb-0">Umur</p>
                        <p><?= $admin['umur']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Jenis Kelamin</p>
                        <p><?php if ($admin['jenisKelamin'] == "P") {
                                echo "Perempuan";
                            } elseif ($admin['jenisKelamin'] == "L") {
                                echo "Laki-laki";
                            } ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Kewarganegaraan</p>
                        <p><?= $admin['kewarganegaraan']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Agama</p>
                        <p><?= $admin['agama']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Status Pernikahan</p>
                        <p><?= $admin['statusPernikahan']; ?></p>
                    </div>
                    <div class="col pe-0">
                        <p class="fw-bold mb-0">Pendidikan Terakhir</p>
                        <p><?= $admin['pendidikan']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Golongan Darah</p>
                        <p><?= $admin['golonganDarah']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Alamat</p>
                        <p><?= $admin['alamat']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Kelurahan</p>
                        <p><?= $admin['kelurahan']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Kecamatan</p>
                        <p><?= $admin['kecamatan']; ?></p>
                    </div>
                    <div class="col pe-0">
                        <p class="fw-bold mb-0">Kabupaten/Kota</p>
                        <p><?= $admin['kabupaten']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Provinsi</p>
                        <p><?= $admin['provinsi']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Kode Pos</p>
                        <p><?= $admin['kodePos']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Nomor Telepon</p>
                        <p><?= $admin['noTelp']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Nomor Handphone</p>
                        <p><?= $admin['noHP']; ?></p>
                    </div>
                    <div class="col pe-0">
                        <p class="fw-bold mb-0">Email</p>
                        <p><?= $admin['email']; ?></p>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>