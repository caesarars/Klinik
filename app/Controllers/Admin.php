<?php

namespace App\Controllers;

use DateTime;
use PhpParser\Node\Stmt\Finally_;

class Admin extends BaseController
{

    public function tambah_pasien()
    {
        $session = session();
        // dd(session()->get('logged_in'));
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
        if ($data['pasien']) {

            echo view('include/header', $user);
            echo view('admin/daftar_pasien', $data);
            echo view('include/footer');
        } else {
            $session->setFlashdata('error', 'Pasien Tidak Ditemukan');
            return redirect()->to('admin/daftar_pasien');
        }
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
        date_default_timezone_set('Asia/Jakarta');
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
            'terakhirDaftar' => date("Y-m-d H:i:s"),
            'assesment' => null,
            'soap' => null
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

        $log = 'Menambahkan Pasien dengan id ' . $id . ' a/n ' .  $this->request->getVar('nama');

        $this->M_Log->insert([
            'idUser' => $_SESSION['id'],
            'jabatan' => 'Administrator',
            'log' => $log,
            'tanggal' => date("Y-m-d H:i:s")
        ]);
        $session->setFlashdata('success', 'Data Pasien Berhasil Ditambahkan');
        // } catch (\Exception $ex) {
        // $session->setFlashdata('error', "Data Pasien Gagal Ditambahkan\n" . $ex);
        // } finally {
        return redirect()->to('admin/daftar_pasien/');
        // }
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
        try {
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

            $log = 'Mengubah Pasien dengan id ' . $id . ' a/n ' .  $this->request->getVar('nama');

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Administrator',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Data Pasien Berhasil Diubah');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Data Pasien Gagal Diubah\n" . $ex);
        } finally {
            return redirect()->to('admin/daftar_pasien/');
        }
    }

    // public function delete_pasien($id)
    // {
    //     $session = session();
    //     $this->M_Pasien->delete($id);

    //     $kontak = $this->M_Kontak->where(["idPasien" => $id])->first();
    //     $this->M_Kontak->delete($kontak['id']);
    //     $session->setFlashdata('success', 'Data Pasien Berhasil Dihapus');
    //     return redirect()->to('admin/daftar_pasien/');
    // }

    public function pasien_masuk($id)
    {
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        try {
            $this->M_Pasien->save([
                'id' => $id,
                'terakhirDaftar' => date("Y-m-d H:i:s"),
                'assesment' => null,
                'soap' => null
            ]);
            $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
            $log = 'Mendaftarkan Pasien dengan id ' . $id . ' a/n ' .  $data['pasien']['nama'];

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Administrator',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Pasien Berhasil Didaftarkan');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Pasien Gagal Didaftarkan\n" . $ex);
        } finally {
            return redirect()->to('admin/daftar_pasien/');
        }
    }
}
