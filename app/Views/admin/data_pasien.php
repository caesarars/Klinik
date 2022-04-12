<div class="container mt-1 ms-4 me-0 mw-100">
    <div class="row w-auto me-4">
        <div class="col-3 ps-0 bg-white me-2 p-2">
            <div class="list-group">
                <button type="button" class="list-group-item list-group-item-action fw-bold">
                    <img src=" <?= base_url('images/profil-orange.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Data Identitas
                </button>
            </div>
        </div>
        <div class="col bg-white py-3 ms-2">
            <div class="container">
                <div class="row align-content-left">
                    <div class="col-3">
                        <a href="<?= base_url('admin/edit_pasien/' . $pasien['id']) ?>" class="btn-primary p-2">
                            <img src="<?= base_url('images/edit-white.png') ?>" class="img-thumbnail bg-transparent border-0" style="height: 30px;" alt="">
                            Ubah Pasien
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="<?= base_url('admin/delete_pasien/' . $pasien['id']) ?>" class="btn-primary p-2">
                            <img src="<?= base_url('images/delete-white.png') ?>" class="img-thumbnail bg-transparent border-0" style="height: 30px;" alt="">
                            Hapus Pasien
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="<?= base_url('admin/pasien_masuk/' . $pasien['id']) ?>" class="btn-primary p-2">
                            Daftar
                        </a>
                    </div>
                </div>
                <div class="row align-items-start mt-4">
                    <div class="col-sm-1 pe-0">
                        <img src="<?= base_url('images/doctor-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    </div>
                    <div class="col ps-0">
                        <h6>Informasi Pasien</h6>
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
                        <p><?= $pasien['nama']; ?></p>
                    </div>
                    <div class="col pe-0">
                        <p class="fw-bold mb-0">NIK</p>
                        <p><?= $pasien['nik']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Tempat Lahir</p>
                        <p><?= $pasien['tempatLahir']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Tanggal Lahir</p>
                        <p><?= $pasien['tanggalLahir']; ?></p>
                    </div>
                    <div class="col pe-0">
                        <p class="fw-bold mb-0">Umur</p>
                        <p><?= $pasien['umur']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Jenis Kelamin</p>
                        <p><?php if ($pasien['jenisKelamin'] == "P") {
                                echo "Perempuan";
                            } elseif ($pasien['jenisKelamin'] == "L") {
                                echo "Laki-laki";
                            } ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Kewarganegaraan</p>
                        <p><?= $pasien['kewarganegaraan']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Agama</p>
                        <p><?= $pasien['agama']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Status Pernikahan</p>
                        <p><?= $pasien['statusPernikahan']; ?></p>
                    </div>
                    <div class="col pe-0">
                        <p class="fw-bold mb-0">Pendidikan Terakhir</p>
                        <p><?= $pasien['pendidikan']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Status Asuransi</p>
                        <p><?= $pasien['statusAsuransi']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Golongan Darah</p>
                        <p><?= $pasien['golonganDarah']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Alamat</p>
                        <p><?= $pasien['alamat']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Kelurahan</p>
                        <p><?= $pasien['kelurahan']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Kecamatan</p>
                        <p><?= $pasien['kecamatan']; ?></p>
                    </div>
                    <div class="col pe-0">
                        <p class="fw-bold mb-0">Kabupaten/Kota</p>
                        <p><?= $pasien['kabupaten']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Provinsi</p>
                        <p><?= $pasien['provinsi']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Kode Pos</p>
                        <p><?= $pasien['kodePos']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Nomor Telepon</p>
                        <p><?= $pasien['noTelp']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Nomor Handphone</p>
                        <p><?= $pasien['noHP']; ?></p>
                    </div>
                    <div class="col pe-0">
                        <p class="fw-bold mb-0">Email</p>
                        <p><?= $pasien['email']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row align-items-start">
                    <div class="col-sm-1 pe-0">
                        <img src="<?= base_url('images/kontak-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    </div>
                    <div class="col ps-0">
                        <h6>Kontak Darurat</h6>
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
                        <p><?= $kontak['nama']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Hubungan</p>
                        <p><?= $kontak['hubungan']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Alamat</p>
                        <p><?= $kontak['alamat']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Kelurahan</p>
                        <p><?= $kontak['kelurahan']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Kecamatan</p>
                        <p><?= $kontak['kecamatan']; ?></p>
                    </div>
                    <div class="col pe-0">
                        <p class="fw-bold mb-0">Kabupaten/Kota</p>
                        <p><?= $kontak['kabupaten']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Provinsi</p>
                        <p><?= $kontak['provinsi']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Kode Pos</p>
                        <p><?= $kontak['kodePos']; ?></p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4 ps-0">
                        <p class="fw-bold mb-0">Nomor Telepon</p>
                        <p><?= $kontak['noTelp']; ?></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold mb-0">Nomor Handphone</p>
                        <p><?= $kontak['noHP']; ?></p>
                    </div>
                    <div class="col pe-0">
                        <p class="fw-bold mb-0">Email</p>
                        <p><?= $kontak['email']; ?></p>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>