<?php

namespace App\Controllers;

use DateTime;

class Admin extends BaseController
{

    public function tambah_pasien()
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        echo view('include/header', $user);
        echo view('admin/tambah_pasien');
        echo view('include/footer');
    }
    public function daftar_pasien()
    {
        date_default_timezone_set('Asia/Jakarta');
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        $data['pasien'] = $this->M_Pasien
            ->where('terakhirDaftar >=', date("Y-m-d"))
            ->orderBy('terakhirDaftar', 'desc')->findAll();
        echo view('include/header', $user);
        echo view('admin/daftar_pasien', $data);
        echo view('include/footer');
    }

    public function search_pasien()
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        $keyword =  $this->request->getVar('keyword');
        $data['pasien'] = $this->M_Pasien->getSearch($keyword);
        echo view('include/header', $user);
        echo view('admin/daftar_pasien', $data);
        echo view('include/footer');
    }

    public function data_pasien($id)
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";

        $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $tanggalLahir = new DateTime($data['pasien']['tanggalLahir']);
        $data['pasien']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        $data['kontak'] = $this->M_Kontak->where(["idPasien" => $id])->first();
        echo view('include/header', $user);
        echo view('admin/data_pasien', $data);
        echo view('include/footer');
    }

    public function insert_pasien()
    {
        $session = session();
        $this->M_Pasien->insert([
            'nama' => $this->request->getVar('nama'),
            'nik' => $this->request->getVar('nik'),
            'tempatLahir' => $this->request->getVar('tempatLahir'),
            'tanggalLahir' => $this->request->getVar('tanggalLahir'),
            'jenisKelamin' => $this->request->getVar('jenisKelamin'),
            'kewarganegaraan' => $this->request->getVar('kewarganegaraan'),
            'agama' => $this->request->getVar('agama'),
            // 'umur' => $this->request->getVar('umur'),
            'statusPernikahan' => $this->request->getVar('statusPernikahan'),
            'statusAsuransi' => $this->request->getVar('statusAsuransi'),
            'golonganDarah' => $this->request->getVar('golonganDarah'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'alamat' => $this->request->getVar('alamat'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'provinsi' => $this->request->getVar('provinsi'),
            'kodePos' => $this->request->getVar('kodepos'),
            'kodePos' => $this->request->getVar('kodePos'),
            'noTelp' => $this->request->getVar('noTelp'),
            'noHP' => $this->request->getVar('noHP'),
            'email' => $this->request->getVar('email'),
            'terakhirDaftar' => date("Y-m-d H:i:s")
        ]);
        $id = $this->M_Pasien->getInsertID();
        $this->M_Kontak->insert([
            'idPasien' => $id,
            'nama' => $this->request->getVar('namaKontak'),
            'hubungan' => $this->request->getVar('hubunganKontak'),
            'alamat' => $this->request->getVar('alamatKontak'),
            'kelurahan' => $this->request->getVar('kelurahanKontak'),
            'kecamatan' => $this->request->getVar('kecamatanKontak'),
            'kabupaten' => $this->request->getVar('kabupatenKontak'),
            'provinsi' => $this->request->getVar('provinsiKontak'),
            'kodePos' => $this->request->getVar('kodeposKontak'),
            'kodePos' => $this->request->getVar('kodePosKontak'),
            'noTelp' => $this->request->getVar('noTelpKontak'),
            'noHP' => $this->request->getVar('noHPKontak'),
            'email' => $this->request->getVar('emailKontak')
        ]);
        $session->setFlashdata('msg', 'Data Pasien Berhasil Ditambahkan!');
        return redirect()->to('admin/daftar_pasien/');
    }

    public function edit_pasien($id)
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";


        $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
        $data['kontak'] = $this->M_Kontak->where(["idPasien" => $id])->first();
        echo view('include/header', $user);
        echo view('admin/edit_pasien', $data);
        echo view('include/footer');
    }

    public function update_pasien($id)
    {
        $session = session();

        date_default_timezone_set('Asia/Jakarta');
        $this->M_Pasien->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'nik' => $this->request->getVar('nik'),
            'tempatLahir' => $this->request->getVar('tempatLahir'),
            'tanggalLahir' => $this->request->getVar('tanggalLahir'),
            'jenisKelamin' => $this->request->getVar('jenisKelamin'),
            'kewarganegaraan' => $this->request->getVar('kewarganegaraan'),
            'agama' => $this->request->getVar('agama'),
            // 'umur' => $this->request->getVar('umur'),
            'statusPernikahan' => $this->request->getVar('statusPernikahan'),
            'statusAsuransi' => $this->request->getVar('statusAsuransi'),
            'golonganDarah' => $this->request->getVar('golonganDarah'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'alamat' => $this->request->getVar('alamat'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'provinsi' => $this->request->getVar('provinsi'),
            'kodePos' => $this->request->getVar('kodepos'),
            'kodePos' => $this->request->getVar('kodePos'),
            'noTelp' => $this->request->getVar('noTelp'),
            'noHP' => $this->request->getVar('noHP'),
            'email' => $this->request->getVar('email'),
        ]);

        $kontak = $this->M_Kontak->where(["idPasien" => $id])->first();
        $this->M_Kontak->save([
            'id' => $kontak['id'],
            'idPasien' => $id,
            'nama' => $this->request->getVar('namaKontak'),
            'hubungan' => $this->request->getVar('hubunganKontak'),
            'alamat' => $this->request->getVar('alamatKontak'),
            'kelurahan' => $this->request->getVar('kelurahanKontak'),
            'kecamatan' => $this->request->getVar('kecamatanKontak'),
            'kabupaten' => $this->request->getVar('kabupatenKontak'),
            'provinsi' => $this->request->getVar('provinsiKontak'),
            'kodePos' => $this->request->getVar('kodeposKontak'),
            'kodePos' => $this->request->getVar('kodePosKontak'),
            'noTelp' => $this->request->getVar('noTelpKontak'),
            'noHP' => $this->request->getVar('noHPKontak'),
            'email' => $this->request->getVar('emailKontak')
        ]);

        $session->setFlashdata('msg', 'Data Pasien Berhasil Diubah!');
        return redirect()->to('admin/daftar_pasien/');
    }

    public function delete_pasien($id)
    {
        $session = session();
        $this->M_Pasien->delete($id);

        $kontak = $this->M_Kontak->where(["idPasien" => $id])->first();
        $this->M_Kontak->delete($kontak['id']);
        $session->setFlashdata('msg', 'Data Pasien Berhasil Dihapus!');
        return redirect()->to('admin/daftar_pasien/');
    }

    public function pasien_masuk($id)
    {
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $this->M_Pasien->save([
            'id' => $id,
            'terakhirDaftar' => date("Y-m-d H:i:s")
        ]);
        $session->setFlashdata('msg', 'Pasien Berhasil Didaftarkan!');
        return redirect()->to('admin/daftar_pasien/');
    }

    public function daftar_dokter()
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        $data['dokter'] = $this->M_Dokter->findAll();
        echo view('include/header', $user);
        echo view('admin/daftar_dokter', $data);
        echo view('include/footer');
    }

    public function search_dokter()
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        $keyword =  $this->request->getVar('keyword');
        $data['dokter'] = $this->M_Dokter->like('nama', $keyword)
            ->orLike('nik', $keyword)->findAll();
        echo view('include/header', $user);
        echo view('admin/daftar_dokter', $data);
        echo view('include/footer');
    }

    public function tambah_dokter()
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        echo view('include/header', $user);
        echo view('admin/tambah_dokter');
        echo view('include/footer');
    }

    public function data_dokter($id)
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";

        $data['dokter'] = $this->M_Dokter->where(["id" => $id])->first();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $tanggalLahir = new DateTime($data['dokter']['tanggalLahir']);
        $data['dokter']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        echo view('include/header', $user);
        echo view('admin/data_dokter', $data);
        echo view('include/footer');
    }

    public function insert_dokter()
    {
        $session = session();
        $this->M_Dokter->insert([
            'nama' => $this->request->getVar('nama'),
            'nik' => $this->request->getVar('nik'),
            'jenis' => $this->request->getVar('jenisDokter'),
            'tempatLahir' => $this->request->getVar('tempatLahir'),
            'tanggalLahir' => $this->request->getVar('tanggalLahir'),
            'jenisKelamin' => $this->request->getVar('jenisKelamin'),
            'kewarganegaraan' => $this->request->getVar('kewarganegaraan'),
            'agama' => $this->request->getVar('agama'),
            // 'umur' => $this->request->getVar('umur'),
            'statusPernikahan' => $this->request->getVar('statusPernikahan'),
            'golonganDarah' => $this->request->getVar('golonganDarah'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'alamat' => $this->request->getVar('alamat'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'provinsi' => $this->request->getVar('provinsi'),
            'kodePos' => $this->request->getVar('kodepos'),
            'kodePos' => $this->request->getVar('kodePos'),
            'noTelp' => $this->request->getVar('noTelp'),
            'noHP' => $this->request->getVar('noHP'),
            'email' => $this->request->getVar('email')
        ]);
        $id = $this->M_Dokter->getInsertID();
        $this->M_User->insert([
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'jabatan' => 'dokter',
            'id' => $id,
        ]);
        $session->setFlashdata('msg', 'Data Dokter Berhasil Ditambahkan!');
        return redirect()->to('admin/daftar_dokter/');
    }

    public function edit_dokter($id)
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";


        $data['dokter'] = $this->M_Dokter->where(["id" => $id])->first();
        echo view('include/header', $user);
        echo view('admin/edit_dokter', $data);
        echo view('include/footer');
    }

    public function update_dokter($id)
    {
        $session = session();
        $this->M_Dokter->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'nik' => $this->request->getVar('nik'),
            'jenis' => $this->request->getVar('jenisDokter'),
            'tempatLahir' => $this->request->getVar('tempatLahir'),
            'tanggalLahir' => $this->request->getVar('tanggalLahir'),
            'jenisKelamin' => $this->request->getVar('jenisKelamin'),
            'kewarganegaraan' => $this->request->getVar('kewarganegaraan'),
            'agama' => $this->request->getVar('agama'),
            // 'umur' => $this->request->getVar('umur'),
            'statusPernikahan' => $this->request->getVar('statusPernikahan'),
            'golonganDarah' => $this->request->getVar('golonganDarah'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'alamat' => $this->request->getVar('alamat'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'provinsi' => $this->request->getVar('provinsi'),
            'kodePos' => $this->request->getVar('kodepos'),
            'kodePos' => $this->request->getVar('kodePos'),
            'noTelp' => $this->request->getVar('noTelp'),
            'noHP' => $this->request->getVar('noHP'),
            'email' => $this->request->getVar('email')
        ]);
        $session->setFlashdata('msg', 'Data Dokter Berhasil Diubah!');
        return redirect()->to('admin/daftar_dokter/');
    }

    public function delete_dokter($id)
    {
        $session = session();
        $this->M_Dokter->delete($id);

        $user = $this->M_User->where(["id" => $id])->first();
        $this->M_User->delete($user['id']);
        $session->setFlashdata('msg', 'Data Dokter Berhasil Dihapus!');
        return redirect()->to('admin/daftar_dokter/');
    }

    public function daftar_perawat()
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        $data['perawat'] = $this->M_Perawat->findAll();
        echo view('include/header', $user);
        echo view('admin/daftar_perawat', $data);
        echo view('include/footer');
    }

    public function search_perawat()
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        $keyword =  $this->request->getVar('keyword');
        $data['perawat'] = $this->M_Perawat->like('nama', $keyword)
            ->orLike('nik', $keyword)->findAll();
        echo view('include/header', $user);
        echo view('admin/daftar_perawat', $data);
        echo view('include/footer');
    }

    public function tambah_perawat()
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        $data['pasien'] = $this->M_Pasien->findAll();
        echo view('include/header', $user);
        echo view('admin/tambah_perawat', $data);
        echo view('include/footer');
    }

    public function data_perawat($id)
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";

        $data['perawat'] = $this->M_Perawat->where(["id" => $id])->first();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $tanggalLahir = new DateTime($data['perawat']['tanggalLahir']);
        $data['perawat']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        echo view('include/header', $user);
        echo view('admin/data_perawat', $data);
        echo view('include/footer');
    }

    public function insert_perawat()
    {
        $session = session();
        $this->M_Perawat->insert([
            'nama' => $this->request->getVar('nama'),
            'nik' => $this->request->getVar('nik'),
            'jenis' => $this->request->getVar('jenisDokter'),
            'tempatLahir' => $this->request->getVar('tempatLahir'),
            'tanggalLahir' => $this->request->getVar('tanggalLahir'),
            'jenisKelamin' => $this->request->getVar('jenisKelamin'),
            'kewarganegaraan' => $this->request->getVar('kewarganegaraan'),
            'agama' => $this->request->getVar('agama'),
            // 'umur' => $this->request->getVar('umur'),
            'statusPernikahan' => $this->request->getVar('statusPernikahan'),
            'golonganDarah' => $this->request->getVar('golonganDarah'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'alamat' => $this->request->getVar('alamat'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'provinsi' => $this->request->getVar('provinsi'),
            'kodePos' => $this->request->getVar('kodepos'),
            'kodePos' => $this->request->getVar('kodePos'),
            'noTelp' => $this->request->getVar('noTelp'),
            'noHP' => $this->request->getVar('noHP'),
            'email' => $this->request->getVar('email')
        ]);
        $id = $this->M_Perawat->getInsertID();
        $this->M_User->insert([
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'jabatan' => 'perawat',
            'id' => $id,
        ]);
        $session->setFlashdata('msg', 'Data Perawat Berhasil Ditambahkan!');
        return redirect()->to('admin/daftar_perawat/');
    }

    public function edit_perawat($id)
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";

        $data['perawat'] = $this->M_Perawat->where(["id" => $id])->first();
        echo view('include/header', $user);
        echo view('admin/edit_perawat', $data);
        echo view('include/footer');
    }

    public function update_perawat($id)
    {
        $session = session();
        $this->M_Perawat->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'nik' => $this->request->getVar('nik'),
            'jenis' => $this->request->getVar('jenisDokter'),
            'tempatLahir' => $this->request->getVar('tempatLahir'),
            'tanggalLahir' => $this->request->getVar('tanggalLahir'),
            'jenisKelamin' => $this->request->getVar('jenisKelamin'),
            'kewarganegaraan' => $this->request->getVar('kewarganegaraan'),
            'agama' => $this->request->getVar('agama'),
            // 'umur' => $this->request->getVar('umur'),
            'statusPernikahan' => $this->request->getVar('statusPernikahan'),
            'golonganDarah' => $this->request->getVar('golonganDarah'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'alamat' => $this->request->getVar('alamat'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'provinsi' => $this->request->getVar('provinsi'),
            'kodePos' => $this->request->getVar('kodepos'),
            'kodePos' => $this->request->getVar('kodePos'),
            'noTelp' => $this->request->getVar('noTelp'),
            'noHP' => $this->request->getVar('noHP'),
            'email' => $this->request->getVar('email')
        ]);
        $session->setFlashdata('msg', 'Data Perawat Berhasil Diubah!');
        return redirect()->to('admin/daftar_perawat/');
    }

    public function delete_perawat($id)
    {
        $session = session();
        $this->M_Perawat->delete($id);

        $user = $this->M_User->where(["id" => $id])->first();
        $this->M_User->delete($user['id']);
        $session->setFlashdata('msg', 'Data Perawat Berhasil Dihapus!');
        return redirect()->to('admin/daftar_perawat/');
    }

    public function daftar_admin()
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        $data['admin'] = $this->M_Admin->findAll();
        echo view('include/header', $user);
        echo view('admin/daftar_admin', $data);
        echo view('include/footer');
    }

    public function tambah_admin()
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        echo view('include/header', $user);
        echo view('admin/tambah_admin');
        echo view('include/footer');
    }

    public function search_admin()
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        $keyword =  $this->request->getVar('keyword');
        $data['admin'] = $this->M_Admin->like('nama', $keyword)
            ->orLike('nik', $keyword)->findAll();
        echo view('include/header', $user);
        echo view('admin/daftar_admin', $data);
        echo view('include/footer');
    }

    public function data_admin($id)
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        $data['admin'] = $this->M_Admin->where(["id" => $id])->first();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $tanggalLahir = new DateTime($data['admin']['tanggalLahir']);
        $data['admin']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        echo view('include/header', $user);
        echo view('admin/data_admin', $data);
        echo view('include/footer');
    }

    public function insert_admin()
    {
        $session = session();
        $this->M_Admin->insert([
            'nama' => $this->request->getVar('nama'),
            'nik' => $this->request->getVar('nik'),
            'tempatLahir' => $this->request->getVar('tempatLahir'),
            'tanggalLahir' => $this->request->getVar('tanggalLahir'),
            'jenisKelamin' => $this->request->getVar('jenisKelamin'),
            'kewarganegaraan' => $this->request->getVar('kewarganegaraan'),
            'agama' => $this->request->getVar('agama'),
            // 'umur' => $this->request->getVar('umur'),
            'statusPernikahan' => $this->request->getVar('statusPernikahan'),
            'golonganDarah' => $this->request->getVar('golonganDarah'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'alamat' => $this->request->getVar('alamat'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'provinsi' => $this->request->getVar('provinsi'),
            'kodePos' => $this->request->getVar('kodepos'),
            'kodePos' => $this->request->getVar('kodePos'),
            'noTelp' => $this->request->getVar('noTelp'),
            'noHP' => $this->request->getVar('noHP'),
            'email' => $this->request->getVar('email')
        ]);
        $id = $this->M_Admin->getInsertID();
        $this->M_User->insert([
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'jabatan' => 'admin',
            'id' => $id,
        ]);
        $session->setFlashdata('msg', 'Data Administrator Berhasil Ditambahkan!');
        return redirect()->to('admin/daftar_admin/');
    }

    public function edit_admin($id)
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";


        $data['admin'] = $this->M_Admin->where(["id" => $id])->first();
        echo view('include/header', $user);
        echo view('admin/edit_admin', $data);
        echo view('include/footer');
    }

    public function update_admin($id)
    {
        $session = session();
        $this->M_Admin->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'nik' => $this->request->getVar('nik'),
            'tempatLahir' => $this->request->getVar('tempatLahir'),
            'tanggalLahir' => $this->request->getVar('tanggalLahir'),
            'jenisKelamin' => $this->request->getVar('jenisKelamin'),
            'kewarganegaraan' => $this->request->getVar('kewarganegaraan'),
            'agama' => $this->request->getVar('agama'),
            // 'umur' => $this->request->getVar('umur'),
            'statusPernikahan' => $this->request->getVar('statusPernikahan'),
            'golonganDarah' => $this->request->getVar('golonganDarah'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'alamat' => $this->request->getVar('alamat'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'provinsi' => $this->request->getVar('provinsi'),
            'kodePos' => $this->request->getVar('kodepos'),
            'kodePos' => $this->request->getVar('kodePos'),
            'noTelp' => $this->request->getVar('noTelp'),
            'noHP' => $this->request->getVar('noHP'),
            'email' => $this->request->getVar('email')
        ]);
        $session->setFlashdata('msg', 'Data Administrator Berhasil Diubah!');
        return redirect()->to('admin/daftar_admin/');
    }

    public function delete_admin($id)
    {
        $session = session();
        $this->M_Admin->delete($id);

        $user = $this->M_User->where(["id" => $id])->first();
        $this->M_User->delete($user['id']);
        $session->setFlashdata('msg', 'Data Administrator Berhasil Dihapus!');
        return redirect()->to('admin/daftar_admin/');
    }


    public function daftar_apoteker()
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        $data['apoteker'] = $this->M_Apoteker->findAll();
        echo view('include/header', $user);
        echo view('admin/daftar_apoteker', $data);
        echo view('include/footer');
    }

    public function search_apoteker()
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        $keyword =  $this->request->getVar('keyword');
        $data['apoteker'] = $this->M_Apoteker->like('nama', $keyword)
            ->orLike('nik', $keyword)->findAll();
        echo view('include/header', $user);
        echo view('admin/daftar_apoteker', $data);
        echo view('include/footer');
    }

    public function tambah_apoteker()
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        $data['apoteker'] = $this->M_Apoteker->findAll();
        echo view('include/header', $user);
        echo view('admin/tambah_apoteker', $data);
        echo view('include/footer');
    }

    public function data_apoteker($id)
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";
        $data['apoteker'] = $this->M_Apoteker->where(["id" => $id])->first();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $tanggalLahir = new DateTime($data['apoteker']['tanggalLahir']);
        $data['apoteker']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        echo view('include/header', $user);
        echo view('admin/data_apoteker', $data);
        echo view('include/footer');
    }

    public function insert_apoteker()
    {
        $session = session();
        $this->M_Apoteker->insert([
            'nama' => $this->request->getVar('nama'),
            'nik' => $this->request->getVar('nik'),
            'jenis' => $this->request->getVar('jenisDokter'),
            'tempatLahir' => $this->request->getVar('tempatLahir'),
            'tanggalLahir' => $this->request->getVar('tanggalLahir'),
            'jenisKelamin' => $this->request->getVar('jenisKelamin'),
            'kewarganegaraan' => $this->request->getVar('kewarganegaraan'),
            'agama' => $this->request->getVar('agama'),
            // 'umur' => $this->request->getVar('umur'),
            'statusPernikahan' => $this->request->getVar('statusPernikahan'),
            'golonganDarah' => $this->request->getVar('golonganDarah'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'alamat' => $this->request->getVar('alamat'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'provinsi' => $this->request->getVar('provinsi'),
            'kodePos' => $this->request->getVar('kodepos'),
            'kodePos' => $this->request->getVar('kodePos'),
            'noTelp' => $this->request->getVar('noTelp'),
            'noHP' => $this->request->getVar('noHP'),
            'email' => $this->request->getVar('email')
        ]);
        $id = $this->M_Apoteker->getInsertID();
        $this->M_User->insert([
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'jabatan' => 'apoteker',
            'id' => $id,
        ]);
        $session->setFlashdata('msg', 'Data Perawat Berhasil Ditambahkan!');
        return redirect()->to('admin/daftar_apoteker/');
    }

    public function edit_apoteker($id)
    {
        $session = session();
        $user = $this->M_Admin->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "ADMINISTRATOR";

        $data['apoteker'] = $this->M_Apoteker->where(["id" => $id])->first();
        echo view('include/header', $user);
        echo view('admin/edit_apoteker', $data);
        echo view('include/footer');
    }

    public function update_apoteker($id)
    {
        $session = session();
        $this->M_Apoteker->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'nik' => $this->request->getVar('nik'),
            'jenis' => $this->request->getVar('jenisDokter'),
            'tempatLahir' => $this->request->getVar('tempatLahir'),
            'tanggalLahir' => $this->request->getVar('tanggalLahir'),
            'jenisKelamin' => $this->request->getVar('jenisKelamin'),
            'kewarganegaraan' => $this->request->getVar('kewarganegaraan'),
            'agama' => $this->request->getVar('agama'),
            // 'umur' => $this->request->getVar('umur'),
            'statusPernikahan' => $this->request->getVar('statusPernikahan'),
            'golonganDarah' => $this->request->getVar('golonganDarah'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'alamat' => $this->request->getVar('alamat'),
            'kelurahan' => $this->request->getVar('kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'provinsi' => $this->request->getVar('provinsi'),
            'kodePos' => $this->request->getVar('kodepos'),
            'kodePos' => $this->request->getVar('kodePos'),
            'noTelp' => $this->request->getVar('noTelp'),
            'noHP' => $this->request->getVar('noHP'),
            'email' => $this->request->getVar('email')
        ]);
        $session->setFlashdata('msg', 'Data Perawat Berhasil Diubah!');
        return redirect()->to('admin/daftar_apoteker/');
    }

    public function delete_apoteker($id)
    {
        $session = session();
        $this->M_Apoteker->delete($id);

        $user = $this->M_User->where(["id" => $id])->first();
        $this->M_User->delete($user['id']);
        $session->setFlashdata('msg', 'Data Perawat Berhasil Dihapus!');
        return redirect()->to('admin/daftar_apoteker/');
    }
}
