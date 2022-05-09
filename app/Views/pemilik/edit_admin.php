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
                <a href="<?= base_url('pemilik/daftar_admin') ?>" class="list-group-item list-group-item-action fw-bold" style="color: #E79E5A;">
                    <img src="<?= base_url('images/doctor-orange.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Administrator
                </a>
                <a href="<?= base_url('pemilik/daftar_apoteker') ?>" class="list-group-item list-group-item-action fw-bold">
                    <img src="<?= base_url('images/doctor-blue.png') ?>" class="img-thumbnail" style="height: 30px;" alt="">
                    Apoteker
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
                <form action="<?= base_url('pemilik/update_admin/' . $admin['id']) ?>" method="POST">
                    <!-- <div class="row form-group">
                        <p>Username</p>
                        <input type="text" class="form-control" name="username" id="username" autocomplete="off">
                    </div>
                    <div class="row form-group">
                        <p>Password</p>
                        <input type="password" class="form-control" name="password" id="password" autocomplete="off">

                    </div>
                    <input type="checkbox" class="form-check-input" id="showPassword" onclick="myFunction()">
                    <label class="form-check-label" for="showPassword">Show Password</label>
                    <br>
                    <br> -->
                    <div class="row form-group">
                        <p>Nama Lengkap</p>
                        <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" value="<?= $admin['nama']; ?>" required>
                    </div>
                    <div class="row">
                        <p>NIK</p>
                        <input type="text" class="form-control" name="nik" id="nik" autocomplete="off" value="<?= $admin['nik']; ?>" required>
                    </div>
                    <div class="row">
                        <div class="col ps-0">
                            <p>Tempat Lahir</p>
                            <input type="text" class="form-control" name="tempatLahir" id="tempatLahir" autocomplete="off" value="<?= $admin['tempatLahir']; ?>" required>
                        </div>
                        <div class="col pe-0">
                            <p>Tanggal Lahir</p>
                            <input type="date" class="form-control" name="tanggalLahir" id="tanggalLahir" autocomplete="off" value="<?= $admin['tanggalLahir']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <p>Jenis Kelamin</p>
                        <select name="jenisKelamin" id="jenisKelamin" class="custom-select" required>
                            <option value="P" <?php if ($admin['jenisKelamin'] == "P") : ?> selected <?php endif; ?>>Perempuan</option>
                            <option value="L" <?php if ($admin['jenisKelamin'] == "L") : ?> selected <?php endif; ?>>Laki-laki</option>
                        </select>
                    </div>
                    <div class="row">
                        <p>Kewarganegaraan</p>
                        <input type="text" class="form-control" name="kewarganegaraan" id="kewarganegaraan" autocomplete="off" value="<?= $admin['kewarganegaraan']; ?>" required>
                    </div>
                    <div class="row">
                        <p>Agama</p>
                        <input type="text" class="form-control" name="agama" id="agama" autocomplete="off" value="<?= $admin['agama']; ?>" required>
                    </div>
                    <div class="row">
                        <p>Status Pernikahan</p>
                        <input type="text" class="form-control" name="statusPernikahan" id="statusPernikahan" autocomplete="off" value="<?= $admin['statusPernikahan']; ?>" required>
                    </div>
                    <div class="row">
                        <p>Golongan Darah</p>
                        <input type="text" class="form-control" name="golonganDarah" id="golonganDarah" autocomplete="off" value="<?= $admin['golonganDarah']; ?>" required>
                    </div>
                    <div class="row">
                        <p>Pendidikan Terakhir</p>
                        <input type="text" class="form-control" name="pendidikan" id="pendidikan" autocomplete="off" value="<?= $admin['pendidikan']; ?>" required>
                    </div>
                    <div class="row">
                        <p>Alamat</p>
                        <input type="text" class="form-control" name="alamat" id="alamat" autocomplete="off" value="<?= $admin['alamat']; ?>" required>
                    </div>
                    <div class="row">
                        <div class="col ps-0">
                            <p>Kelurahan</p>
                            <input type="text" class="form-control" name="kelurahan" id="kelurahan" autocomplete="off" value="<?= $admin['kelurahan']; ?>" required>
                        </div>
                        <div class="col">
                            <p>kecamatan</p>
                            <input type="text" class="form-control" name="kecamatan" id="kecamatan" autocomplete="off" value="<?= $admin['kecamatan']; ?>" required>
                        </div>
                        <div class="col pe-0">
                            <p>Kabupaten/Kota</p>
                            <input type="text" class="form-control" name="kabupaten" id="kabupaten" autocomplete="off" value="<?= $admin['kabupaten']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ps-0">
                            <p>Provinsi</p>
                            <input type="text" class="form-control" name="provinsi" id="provinsi" autocomplete="off" value="<?= $admin['provinsi']; ?>" required>
                        </div>
                        <div class="col pe-0">
                            <p>Kode Pos</p>
                            <input type="text" class="form-control" name="kodePos" id="kodePos" autocomplete="off" value="<?= $admin['kodePos']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ps-0">
                            <p>Nomor Telepon</p>
                            <input type="text" class="form-control" name="noTelp" id="noTelp" autocomplete="off" value="<?= $admin['noTelp']; ?>" required>
                        </div>
                        <div class="col">
                            <p>Nomor Handphone</p>
                            <input type="text" class="form-control" name="noHP" id="noHP" autocomplete="off" value="<?= $admin['noHP']; ?>" required>
                        </div>
                        <div class="col pe-0">
                            <p>Email</p>
                            <input type="text" class="form-control" name="email" id="email" autocomplete="off" value="<?= $admin['email']; ?>" required>
                        </div>
                    </div>
                    <div class="row justify-content-end mt-4">
                        <div class="col text-right pe-0">
                            <button type="submit" class="btn btn-primary text-center px-3 py-2" name="simpan">SIMPAN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>