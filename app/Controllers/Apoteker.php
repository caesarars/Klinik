<?php

namespace App\Controllers;

class Apoteker extends BaseController
{
    public function daftar_pasien()
    {
        $session = session();
        $user = $this->M_Perawat->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "APOTEKER";
        $data['pasien'] = $this->M_Pasien->orderBy('terakhirDaftar', 'desc')->findAll();
        echo view('include/header', $user);
        echo view('apoteker/daftar_pasien', $data);
        echo view('include/footer');
    }

    public function search_pasien()
    {
        $session = session();
        $user = $this->M_Perawat->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "APOTEKER";
        $keyword =  $this->request->getVar('keyword');
        $data['pasien'] = $this->M_Pasien->like('nama', $keyword)
            ->orLike('nik', $keyword)
            ->orderBy('terakhirDaftar', 'desc')->findAll();
        echo view('include/header', $user);
        echo view('apoteker/daftar_pasien', $data);
        echo view('include/footer');
    }

    public function resep($id)
    {
        $session = session();
        $user = $this->M_Perawat->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "APOTEKER";

        $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
        echo view('include/header', $user);
        echo view('apoteker/resep', $data);
        echo view('include/footer');
    }
}
