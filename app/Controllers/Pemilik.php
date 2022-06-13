<?php

namespace App\Controllers;

use DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pemilik extends BaseController
{

    public function daftar_dokter()
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        $data['dokter'] = $this->M_Dokter->findAll();
        echo view('include/header', $user);
        echo view('pemilik/daftar_dokter', $data);
        echo view('include/footer');
    }

    public function search_dokter()
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        $keyword =  $this->request->getVar('keyword');
        $data['dokter'] = $this->M_Dokter->like('nama', $keyword)
            ->orLike('nik', $keyword)->findAll();
        if ($data['dokter']) {
            echo view('include/header', $user);
            echo view('pemilik/daftar_dokter', $data);
            echo view('include/footer');
        } else {
            $session->setFlashdata('error', 'Dokter Tidak Ditemukan');
            return redirect()->to('pemilik/daftar_dokter');
        }
    }

    public function tambah_dokter()
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        echo view('include/header', $user);
        echo view('pemilik/tambah_dokter');
        echo view('include/footer');
    }

    public function data_dokter($id)
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";

        $data['dokter'] = $this->M_Dokter->where(["id" => $id])->first();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $tanggalLahir = new DateTime($data['dokter']['tanggalLahir']);
        $data['dokter']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        echo view('include/header', $user);
        echo view('pemilik/data_dokter', $data);
        echo view('include/footer');
    }

    public function insert_dokter()
    {
        $session = session();
        if ($this->M_User->where(["username" => $this->request->getVar('username')])->first()) {
            $session->setFlashdata('error', 'Username Sudah Terdaftar');
            return redirect()->back()->withInput();
        } else {
            try {
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
                $log = 'Menambahkan data dokter dengan id ' . $id . ' a/n ' .  $this->request->getVar('nama');

                $this->M_Log->insert([
                    'idUser' => $_SESSION['id'],
                    'jabatan' => 'Super Admin',
                    'log' => $log,
                    'tanggal' => date("Y-m-d H:i:s")
                ]);
                $session->setFlashdata('success', 'Data Dokter Berhasil Ditambahkan');
            } catch (\Exception $ex) {
                $session->setFlashdata('error', "Data Dokter Gagal Ditambahkan\n" . $ex);
            } finally {

                return redirect()->to('pemilik/daftar_dokter/');
            }
        }
    }

    public function edit_dokter($id)
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";


        $data['dokter'] = $this->M_Dokter->where(["id" => $id])->first();
        echo view('include/header', $user);
        echo view('pemilik/edit_dokter', $data);
        echo view('include/footer');
    }

    public function update_dokter($id)
    {
        $session = session();
        try {
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
            $log = 'Mengubah data dokter dengan id ' . $id;

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Super Admin',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Data Dokter Berhasil Diubah');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Data Dokter Gagal Diubah\n" . $ex);
        } finally {

            return redirect()->to('pemilik/daftar_dokter/');
        }
    }

    public function delete_dokter($id)
    {
        $session = session();
        try {
            $this->M_Dokter->delete($id);

            $user = $this->M_User->where(["id" => $id])->first();
            $this->M_User->where(['id' => $user['id'], 'jabatan' => 'dokter'])->delete();

            $log = 'Menghapus data dokter dengan id ' . $id;

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Super Admin',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Data Dokter Berhasil Dihapus');
        } catch (\Exception $ex) {

            $session->setFlashdata('error', "Data Dokter Gagal Dihapus\n" . $ex);
        } finally {
            return redirect()->to('pemilik/daftar_dokter/');
        }
    }

    public function daftar_perawat()
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        $data['perawat'] = $this->M_Perawat->findAll();
        echo view('include/header', $user);
        echo view('pemilik/daftar_perawat', $data);
        echo view('include/footer');
    }

    public function search_perawat()
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        $keyword =  $this->request->getVar('keyword');
        $data['perawat'] = $this->M_Perawat->like('nama', $keyword)
            ->orLike('nik', $keyword)->findAll();
        if ($data['perawat']) {
            echo view('include/header', $user);
            echo view('pemilik/daftar_perawat', $data);
            echo view('include/footer');
        } else {
            $session->setFlashdata('error', 'Perawat Tidak Ditemukan');
            return redirect()->to('pemilik/daftar_perawat');
        }
    }

    public function tambah_perawat()
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        $data['pasien'] = $this->M_Pasien->findAll();
        echo view('include/header', $user);
        echo view('pemilik/tambah_perawat', $data);
        echo view('include/footer');
    }

    public function data_perawat($id)
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";

        $data['perawat'] = $this->M_Perawat->where(["id" => $id])->first();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $tanggalLahir = new DateTime($data['perawat']['tanggalLahir']);
        $data['perawat']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        echo view('include/header', $user);
        echo view('pemilik/data_perawat', $data);
        echo view('include/footer');
    }

    public function insert_perawat()
    {
        $session = session();
        if ($this->M_User->where(["username" => $this->request->getVar('username')])->first()) {
            $session->setFlashdata('error', 'Username Sudah Terdaftar');
            return redirect()->back()->withInput();
        } else {
            try {
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
                $log = 'Menambahkan data Perawat dengan id ' . $id . ' a/n ' . $this->request->getVar('nama');

                $this->M_Log->insert([
                    'idUser' => $_SESSION['id'],
                    'jabatan' => 'Super Admin',
                    'log' => $log,
                    'tanggal' => date("Y-m-d H:i:s")
                ]);
                $session->setFlashdata('success', 'Data Perawat Berhasil Ditambahkan');
            } catch (\Exception $ex) {
                $session->setFlashdata('error', "Data Perawat Gagal Ditambahkan\n" . $ex);
            } finally {

                return redirect()->to('pemilik/daftar_perawat/');
            }
        }
    }

    public function edit_perawat($id)
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";

        $data['perawat'] = $this->M_Perawat->where(["id" => $id])->first();
        echo view('include/header', $user);
        echo view('pemilik/edit_perawat', $data);
        echo view('include/footer');
    }

    public function update_perawat($id)
    {
        $session = session();
        try {
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
            $log = 'Mengubah data Perawat dengan id ' . $id;

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Super Admin',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Data Perawat Berhasil Diubah');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Data Perawat Gagal Diubah\n" . $ex);
        } finally {
            return redirect()->to('pemilik/daftar_perawat/');
        }
    }

    public function delete_perawat($id)
    {
        $session = session();
        try {
            $this->M_Perawat->delete($id);

            $user = $this->M_User->where(["id" => $id])->first();
            $this->M_User->where(['id' => $user['id'], 'jabatan' => 'perawat'])->delete();

            $log = 'Menghapus data Perawat dengan id ' . $id;

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Super Admin',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Data Perawat Berhasil Dihapus');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Data Perawat Gagal Dihapus\n" . $ex);
        } finally {

            return redirect()->to('pemilik/daftar_perawat/');
        }
    }

    public function daftar_admin()
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        $data['admin'] = $this->M_Admin->findAll();
        echo view('include/header', $user);
        echo view('pemilik/daftar_admin', $data);
        echo view('include/footer');
    }

    public function tambah_admin()
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        echo view('include/header', $user);
        echo view('pemilik/tambah_admin');
        echo view('include/footer');
    }

    public function search_admin()
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        $keyword =  $this->request->getVar('keyword');
        $data['admin'] = $this->M_Admin->like('nama', $keyword)
            ->orLike('nik', $keyword)->findAll();
        if ($data['admin']) {
            echo view('include/header', $user);
            echo view('pemilik/daftar_admin', $data);
            echo view('include/footer');
        } else {
            $session->setFlashdata('error', 'Admin Tidak Ditemukan');
            return redirect()->to('pemilik/daftar_admin');
        }
    }

    public function data_admin($id)
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        $data['admin'] = $this->M_Admin->where(["id" => $id])->first();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $tanggalLahir = new DateTime($data['admin']['tanggalLahir']);
        $data['admin']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        echo view('include/header', $user);
        echo view('pemilik/data_admin', $data);
        echo view('include/footer');
    }

    public function insert_admin()
    {
        $session = session();

        if ($this->M_User->where(["username" => $this->request->getVar('username')])->first()) {
            $session->setFlashdata('error', 'Username Sudah Terdaftar');
            return redirect()->back()->withInput();
        } else {
            try {
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
                $log = 'Menambahkan data Administrator dengan id ' . $id . ' a/n ' . $this->request->getVar('nama');

                $this->M_Log->insert([
                    'idUser' => $_SESSION['id'],
                    'jabatan' => 'Super Admin',
                    'log' => $log,
                    'tanggal' => date("Y-m-d H:i:s")
                ]);
                $session->setFlashdata('success', 'Data Administrator Berhasil Ditambahkan');
            } catch (\Exception $ex) {
                $session->setFlashdata('error', "Data Administrator Gagal Ditambahkan\n" . $ex);
            } finally {

                return redirect()->to('pemilik/daftar_admin/');
            }
        }
    }

    public function edit_admin($id)
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";


        $data['admin'] = $this->M_Admin->where(["id" => $id])->first();
        echo view('include/header', $user);
        echo view('pemilik/edit_admin', $data);
        echo view('include/footer');
    }

    public function update_admin($id)
    {
        $session = session();
        try {
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
            $log = 'Mengubah data Administrator dengan id ' . $id;

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Super Admin',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Data Administrator Berhasil Diubah');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Data Administrator Gagal Diubah\n" . $ex);
        } finally {
            return redirect()->to('pemilik/daftar_admin/');
        }
    }

    public function delete_admin($id)
    {
        $session = session();
        try {
            $this->M_Admin->delete($id);

            $user = $this->M_User->where(["id" => $id])->first();
            $this->M_User->where(['id' => $user['id'], 'jabatan' => 'admin'])->delete();
            $log = 'Menghapus data Administrator dengan id ' . $id;

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Super Admin',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Data Administrator Berhasil Dihapus');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Data Administrator gagal Dihapus\n" . $ex);
        } finally {

            return redirect()->to('pemilik/daftar_admin/');
        }
    }


    public function daftar_apoteker()
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        $data['apoteker'] = $this->M_Apoteker->findAll();
        echo view('include/header', $user);
        echo view('pemilik/daftar_apoteker', $data);
        echo view('include/footer');
    }

    public function search_apoteker()
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        $keyword =  $this->request->getVar('keyword');
        $data['apoteker'] = $this->M_Apoteker->like('nama', $keyword)
            ->orLike('nik', $keyword)->findAll();
        if ($data['apoteker']) {
            echo view('include/header', $user);
            echo view('pemilik/daftar_apoteker', $data);
            echo view('include/footer');
        } else {
            $session->setFlashdata('error', 'Apoteker Tidak Ditemukan');
            return redirect()->to('pemilik/daftar_apoteker');
        }
    }

    public function tambah_apoteker()
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        $data['apoteker'] = $this->M_Apoteker->findAll();
        echo view('include/header', $user);
        echo view('pemilik/tambah_apoteker', $data);
        echo view('include/footer');
    }

    public function data_apoteker($id)
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        $data['apoteker'] = $this->M_Apoteker->where(["id" => $id])->first();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $tanggalLahir = new DateTime($data['apoteker']['tanggalLahir']);
        $data['apoteker']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        echo view('include/header', $user);
        echo view('pemilik/data_apoteker', $data);
        echo view('include/footer');
    }

    public function insert_apoteker()
    {
        $session = session();

        if ($this->M_User->where(["username" => $this->request->getVar('username')])->first()) {
            $session->setFlashdata('error', 'Username Sudah Terdaftar');
            return redirect()->back()->withInput();
        } else {
            try {
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
                $log = 'Menambahkan data Perawat dengan id ' . $id . ' a/n ' . $this->request->getVar('nama');

                $this->M_Log->insert([
                    'idUser' => $_SESSION['id'],
                    'jabatan' => 'Super Admin',
                    'log' => $log,
                    'tanggal' => date("Y-m-d H:i:s")
                ]);
                $session->setFlashdata('success', 'Data Perawat Berhasil Ditambahkan');
            } catch (\Exception $ex) {
                $session->setFlashdata('error', "Data Perawat Gagal Ditambahkan\n" . $ex);
            } finally {
                return redirect()->to('pemilik/daftar_apoteker/');
            }
        }
    }

    public function edit_apoteker($id)
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";

        $data['apoteker'] = $this->M_Apoteker->where(["id" => $id])->first();
        echo view('include/header', $user);
        echo view('pemilik/edit_apoteker', $data);
        echo view('include/footer');
    }

    public function update_apoteker($id)
    {
        $session = session();
        try {
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
            $log = 'Mengubah data Perawat dengan id ' . $id;

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Super Admin',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Data Perawat Berhasil Diubah');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Data Perawat Gagal Diubah\n" . $ex);
        } finally {
            return redirect()->to('pemilik/daftar_apoteker/');
        }
    }

    public function delete_apoteker($id)
    {
        $session = session();
        try {
            $this->M_Apoteker->delete($id);

            $user = $this->M_User->where(["id" => $id])->first();
            $this->M_User->where(['id' => $user['id'], 'jabatan' => 'apoteker'])->delete();
            $log = 'Menghapus data Perawat dengan id ' . $id;

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Super Admin',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Data Perawat Berhasil Dihapus');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Data Perawat Gagal Dihapus\n" . $ex);
        } finally {

            return redirect()->to('pemilik/daftar_apoteker/');
        }
    }
    public function export_soap()
    {
        $session = session();
        $user = $this->M_Pemilik->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "SUPER ADMIN";
        // $data['apoteker'] = $this->M_Apoteker->findAll();
        echo view('include/header', $user);
        echo view('pemilik/export_soap');
        echo view('include/footer');
    }


    public function export_data_soap()
    {
        $dari = $this->request->getVar('tanggalDari');
        $hingga = $this->request->getVar('tanggalHingga');
        $namaFile = 'Data Rekam Medis ' . date_format(date_create($dari), 'dmY') . ' ' . date_format(date_create($hingga), 'dmY');
        $inputFileType = 'xlsx'; // Xlsx - Xml - Ods - Slk - Gnumeric - Csv
        $inputFileName = './format_excel/data_soap.xlsx';

        $soap = $this->M_Soap->getAllData($dari, $hingga);
        // dd($soap);
        /**  Identify the type of $inputFileName  **/
        $inputFileType = IOFactory::identify($inputFileName);
        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);

        $sheet = $spreadsheet->getActiveSheet();
        $numRow = 3;
        foreach ($soap as $soap) {
            $perawat = $this->M_Perawat->where('id', 1)->first();
            $sheet->setCellValue('A' . $numRow, $soap['idPasien']);
            $sheet->setCellValue('B' . $numRow, $soap['namaPasien']);
            $sheet->setCellValue('C' . $numRow, $perawat['nama']);
            $sheet->setCellValue('D' . $numRow, $soap['tanggalAssesment']);
            $sheet->setCellValue('E' . $numRow, $soap['keluhanUtama']);
            $sheet->setCellValue('F' . $numRow, $soap['tekananDarah']);
            $sheet->setCellValue('G' . $numRow, $soap['frekuensiNadi']);
            $sheet->setCellValue('H' . $numRow, $soap['suhu']);
            $sheet->setCellValue('I' . $numRow, $soap['frekuensiNafas']);
            $sheet->setCellValue('J' . $numRow, $soap['skorNyeri']);
            $sheet->setCellValue('K' . $numRow, $soap['beratBadan']);
            $sheet->setCellValue('L' . $numRow, $soap['tinggiBadan']);
            $sheet->setCellValue('M' . $numRow, $soap['lingkarKepala']);
            $sheet->setCellValue('N' . $numRow, $soap['namaDokter']);
            $sheet->setCellValue('O' . $numRow, $soap['tanggalSOAP']);
            $sheet->setCellValue('P' . $numRow, $soap['subjective']);
            $sheet->setCellValue('Q' . $numRow, $soap['objective']);
            $sheet->setCellValue('R' . $numRow, $soap['assesment']);
            $sheet->setCellValue('S' . $numRow, $soap['planning']);
            $sheet->setCellValue('T' . $numRow, $soap['resep']);
            $numRow++;
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $namaFile . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        die;
    }

    public function export_data_pasien()
    {
        $pasien = $this->M_Pasien->findAll();
        $inputFileType = 'xlsx'; // Xlsx - Xml - Ods - Slk - Gnumeric - Csv
        $inputFileName = './format_excel/data_pasien.xlsx';

        /**  Identify the type of $inputFileName  **/
        $inputFileType = IOFactory::identify($inputFileName);
        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);

        $sheet = $spreadsheet->getActiveSheet();
        $numRow = 2;
        $no = 1;

        foreach ($pasien as $pasien) {
            $sheet->setCellValue('A' . $numRow, $pasien['id']);
            $sheet->setCellValue('B' . $numRow, $pasien['nama']);
            $sheet->setCellValue('C' . $numRow, $pasien['nik']);
            $sheet->setCellValue('D' . $numRow, $pasien['tempatLahir']);
            $sheet->setCellValue('E' . $numRow, $pasien['tanggalLahir']);
            $sheet->setCellValue('F' . $numRow, $pasien['jenisKelamin']);
            $sheet->setCellValue('G' . $numRow, $pasien['kewarganegaraan']);
            $sheet->setCellValue('H' . $numRow, $pasien['agama']);
            $sheet->setCellValue('I' . $numRow, $pasien['statusPernikahan']);
            $sheet->setCellValue('J' . $numRow, $pasien['statusAsuransi']);
            $sheet->setCellValue('K' . $numRow, $pasien['golonganDarah']);
            $sheet->setCellValue('L' . $numRow, $pasien['pendidikan']);
            $sheet->setCellValue('M' . $numRow, $pasien['alamat']);
            $sheet->setCellValue('N' . $numRow, $pasien['kelurahan']);
            $sheet->setCellValue('O' . $numRow, $pasien['kecamatan']);
            $sheet->setCellValue('P' . $numRow, $pasien['kabupaten']);
            $sheet->setCellValue('Q' . $numRow, $pasien['provinsi']);
            $sheet->setCellValue('R' . $numRow, $pasien['kodePos']);

            $numRow++;
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=Data Pasien.xlsx');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        die;
    }
}
