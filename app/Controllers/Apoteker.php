<?php

namespace App\Controllers;

use DateTime;

class Apoteker extends BaseController
{
    public function daftar_pasien()
    {
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $user = $this->M_Apoteker->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "APOTEKER";
        $data['pasien'] = $this->M_Pasien
            ->where('terakhirDaftar >=', date("Y-m-d"))
            ->orderBy('terakhirDaftar', 'desc')->findAll();
        echo view('include/header', $user);
        echo view('apoteker/daftar_pasien', $data);
        echo view('include/footer');
    }

    public function search_pasien()
    {
        $session = session();
        $user = $this->M_Apoteker->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "APOTEKER";
        $keyword =  $this->request->getVar('keyword');

        $data['pasien'] = $this->M_Pasien->getSearch($keyword);
        echo view('include/header', $user);
        echo view('apoteker/daftar_pasien', $data);
        echo view('include/footer');
    }

    public function resep($id)
    {
        $session = session();
        $user = $this->M_Apoteker->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "APOTEKER";

        $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $tanggalLahir = new DateTime($data['pasien']['tanggalLahir']);
        $data['pasien']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        $data['pasien']['tanggalLahir'] = date_format($tanggalLahir, "d/m/Y");
        $data['resep'] = $this->M_Resep->where(["idPasien" => $id])->first();
        // dd($data['resep']);
        echo view('include/header', $user);
        echo view('apoteker/resep', $data);
        echo view('include/footer');
    }
}
