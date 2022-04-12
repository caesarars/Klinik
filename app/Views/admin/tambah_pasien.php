<div class="container mt-1 ms-4 me-0 mw-100">
    <div class="row w-auto me-4">
        <div class="col-3 ps-0 bg-white me-2 p-2">
            <div class="list-group">
                <a href="<?= base_url('admin/tambah_pasien') ?>" class="list-group-item list-group-item-action fw-bold" style="color: #E79E5A;">
                    <img src=" <?= base_url('images/add-person-orange.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Tambah Pasien
                </a>
                <a href="<?= base_url('admin/daftar_pasien') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src=" <?= base_url('images/daftar-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Daftar Pasien
                </a>
                <a href="<?= base_url('admin/daftar_dokter') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src="<?= base_url('images/doctor-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Dokter
                </a>
                <a href="<?= base_url('admin/daftar_perawat') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src="<?= base_url('images/doctor-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Perawat
                </a>
                <a href="<?= base_url('admin/daftar_admin') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src="<?= base_url('images/doctor-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Administrator
                </a>
                <a href="<?= base_url('admin/daftar_apoteker') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src="<?= base_url('images/doctor-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Apoteker
                </a>
            </div>
        </div>
        <div class="col bg-white py-3 ms-2">
            <div class="container">
                <form action="<?= base_url('Admin/insert_pasien') ?>" method="POST">
                    <div class="row align-items-start">
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
                        <p>Nama Lengkap</p>
                        <input type="text" class="form-control" name="nama" id="nama" autocomplete="off">
                    </div>
                    <div class="row">
                        <p>NIK</p>
                        <input type="text" class="form-control" name="nik" id="nik" autocomplete="off">
                    </div>
                    <div class="row">
                        <div class="col ps-0">
                            <p>Tempat Lahir</p>
                            <input type="text" class="form-control" name="tempatLahir" id="tempatLahir" autocomplete="off">
                        </div>
                        <div class="col pe-0">
                            <p>Tanggal Lahir</p>
                            <input type="date" class="form-control" name="tanggalLahir" id="tanggalLahir" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <p>Jenis Kelamin</p>
                        <select name="jenisKelamin" id="jenisKelamin" class="custom-select">
                            <option value="P">Perempuan</option>
                            <option value="L">Laki-laki</option>
                        </select>
                    </div>
                    <div class="row">
                        <p>Kewarganegaraan</p>
                        <input type="text" class="form-control" name="kewarganegaraan" id="kewarganegaraan" autocomplete="off">
                    </div>
                    <div class="row">
                        <p>Agama</p>
                        <input type="text" class="form-control" name="agama" id="agama" autocomplete="off">
                    </div>
                    <div class="row">
                        <p>Status Pernikahan</p>
                        <input type="text" class="form-control" name="statusPernikahan" id="statusPernikahan" autocomplete="off">
                    </div>
                    <div class="row">
                        <p>Status Asuransi</p>
                        <input type="text" class="form-control" name="statusAsuransi" id="statusAsuransi" autocomplete="off">
                    </div>
                    <div class="row">
                        <p>Golongan Darah</p>
                        <input type="text" class="form-control" name="golonganDarah" id="golonganDarah" autocomplete="off">
                    </div>
                    <div class="row">
                        <p>Pendidikan Terakhir</p>
                        <input type="text" class="form-control" name="pendidikan" id="pendidikan" autocomplete="off">
                    </div>
                    <div class="row">
                        <p>Alamat</p>
                        <input type="text" class="form-control" name="alamat" id="alamat" autocomplete="off">
                    </div>
                    <div class="row">
                        <div class="col ps-0">
                            <p>Kelurahan</p>
                            <input type="text" class="form-control" name="kelurahan" id="kelurahan" autocomplete="off">
                        </div>
                        <div class="col">
                            <p>kecamatan</p>
                            <input type="text" class="form-control" name="kecamatan" id="kecamatan" autocomplete="off">
                        </div>
                        <div class="col pe-0">
                            <p>Kabupaten/Kota</p>
                            <input type="text" class="form-control" name="kabupaten" id="kabupaten" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ps-0">
                            <p>Provinsi</p>
                            <input type="text" class="form-control" name="provinsi" id="provinsi" autocomplete="off">
                        </div>
                        <div class="col pe-0">
                            <p>Kode Pos</p>
                            <input type="text" class="form-control" name="kodePos" id="kodePos" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ps-0">
                            <p>Nomor Telepon</p>
                            <input type="text" class="form-control" name="noTelp" id="noTelp" autocomplete="off">
                        </div>
                        <div class="col">
                            <p>Nomor Handphone</p>
                            <input type="text" class="form-control" name="noHP" id="noHP" autocomplete="off">
                        </div>
                        <div class="col pe-0">
                            <p>Email</p>
                            <input type="text" class="form-control" name="email" id="email" autocomplete="off">
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <hr style="color: #E9EDEE; height: 2px;">
                        </div>
                    </div>
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
                        <p>Nama Lengkap</p>
                        <input type="text" class="form-control" name="namaKontak" id="namaKontak" autocomplete="off">
                    </div>
                    <div class="row">
                        <p>Hubungan</p>
                        <input type="text" class="form-control" name="hubunganKontak" id="hubunganKontak" autocomplete="off">
                    </div>
                    <div class="row">
                        <p>Alamat</p>
                        <input type="text" class="form-control" name="alamatKontak" id="alamatKontak" autocomplete="off">
                    </div>
                    <div class="row">
                        <div class="col ps-0">
                            <p>Kelurahan</p>
                            <input type="text" class="form-control" name="kelurahanKontak" id="kelurahanKontak" autocomplete="off">
                        </div>
                        <div class="col">
                            <p>kecamatan</p>
                            <input type="text" class="form-control" name="kecamatanKontak" id="kecamatanKontak" autocomplete="off">
                        </div>
                        <div class="col pe-0">
                            <p>Kabupaten/Kota</p>
                            <input type="text" class="form-control" name="kabupatenKontak" id="kabupatenKontak" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ps-0">
                            <p>Provinsi</p>
                            <input type="text" class="form-control" name="provinsiKontak" id="provinsiKontak" autocomplete="off">
                        </div>
                        <div class="col pe-0">
                            <p>Kode Pos</p>
                            <input type="text" class="form-control" name="kodePosKontak" id="kodePosKontak" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ps-0">
                            <p>Nomor Telepon</p>
                            <input type="text" class="form-control" name="noTelpKontak" id="noTelpKontak" autocomplete="off">
                        </div>
                        <div class="col">
                            <p>Nomor Handphone</p>
                            <input type="text" class="form-control" name="noHPKontak" id="noHPKontak" autocomplete="off">
                        </div>
                        <div class="col pe-0 mb-3">
                            <p>Email</p>
                            <input type="text" class="form-control" name="emailKontak" id="emailKontak" autocomplete="off">
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col text-right pe-0">
                            <button type="submit" class="btn btn-primary text-center px-3 py-2" name="simpan">SIMPAN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>