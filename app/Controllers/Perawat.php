<?php

namespace App\Controllers;

use DateTime;

class Perawat extends BaseController
{
    public function daftar_pasien()
    {
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $user = $this->M_Perawat->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "PERAWAT";
        // dd(date("Y-m-d"));
        $data['pasien'] = $this->M_Pasien
            ->where('terakhirDaftar >=', date("Y-m-d"))
            ->orderBy('terakhirDaftar', 'desc')->findAll();
        echo view('include/header', $user);
        echo view('perawat/daftar_pasien', $data);
        echo view('include/footer');
    }

    public function Assesment($id)
    {
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $user = $this->M_Perawat->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "PERAWAT";

        $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
        $data['assesment'] = $this->M_Assesment->where(["idPasien" => $id])->orderBy('tanggal', 'desc')->first();
        $terakhirDaftar = date_format(new DateTime($data['assesment']['tanggal']), 'd/m/Y');
        $now = date("d/m/Y");
        if ($data['assesment']) {
            if ($now == $terakhirDaftar) {
                $data['sameDay'] = true;
            }
        }

        $tanggalLahir = new DateTime($data['pasien']['tanggalLahir']);
        $data['pasien']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        $data['pasien']['tanggalLahir'] = date_format($tanggalLahir, "d/m/Y");
        echo view('include/header', $user);
        echo view('perawat/assesment', $data);
        echo view('include/footer');
    }

    public function insert_assesment($id)
    {
        $session = session();
        date_default_timezone_set('Asia/Jakarta');

        // $beratBadan = $this->request->getVar('beratBadan');
        // $tinggiBadan = $this->request->getVar('tinggiBadan');
        // $imt = floatval($beratBadan) / floatval($tinggiBadan);
        // dd($imt);
        try {
            $this->M_Assesment->save([
                'idPasien' => $id,
                'idPerawat' => $_SESSION['id'],
                'tanggal' => date("Y-m-d H:i:s"),
                'keluhanUtama' => $this->request->getVar('keluhanUtama'),
                'tekananDarah' => $this->request->getVar('tekananDarah'),
                'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
                'suhu' => $this->request->getVar('suhu'),
                'frekuensiNafas' => $this->request->getVar('frekuensiNafas'),
                'skorNyeri' => $this->request->getVar('skorNyeri'),
                'beratBadan' => $this->request->getVar('beratBadan'),
                'tinggiBadan' => $this->request->getVar('tinggiBadan'),
                // 'IMT' => $this->request->getVar('imt'),
                // 'khususPediatri' => $this->request->getVar('pediatri'),
                'lingkarKepala' => $this->request->getVar('lingkarKepala'),
            ]);
            $this->M_Pasien->save([
                'id' => $id,
                'assesment' => date("Y-m-d H:i:s")
            ]);
            $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
            $log = 'Melakukan assessment perawat kepada pasien dengan id ' . $id . ' a/n ' .  $data['pasien']['nama'];

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Perawat',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Assesment Berhasil Ditambahkan');
        } catch (\Exception $ex) {
            $session->setFlashdata('success', "Assesment Gagal Ditambahkan\n" . $ex);
        } finally {

            return redirect()->to('perawat/daftar_pasien/');
        }
    }

    public function search_pasien()
    {
        $session = session();
        $user = $this->M_Perawat->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "PERAWAT";
        $keyword =  $this->request->getVar('keyword');

        $data['pasien'] = $this->M_Pasien->getSearch($keyword);
        if ($data['pasien']) {

            echo view('include/header', $user);
            echo view('perawat/daftar_pasien', $data);
            echo view('include/footer');
        } else {
            $session->setFlashdata('error', 'Pasien Tidak Ditemukan');
            return redirect()->to('perawat/daftar_pasien');
        }
    }
}
