<?php

namespace App\Controllers;

class Perawat extends BaseController
{
    public function daftar_pasien()
    {
        $session = session();
        $user = $this->M_Perawat->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "PERAWAT";
        $data['pasien'] = $this->M_Pasien->orderBy('terakhirDaftar', 'desc')->findAll();
        echo view('include/header', $user);
        echo view('perawat/daftar_pasien', $data);
        echo view('include/footer');
    }

    public function Assesment($id)
    {
        $session = session();
        $user = $this->M_Perawat->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "PERAWAT";

        $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
        echo view('include/header', $user);
        echo view('perawat/assesment', $data);
        echo view('include/footer');
    }

    public function insert_assesment($id)
    {
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $this->M_Assesment->save([
            'idPasien' => $id,
            'idPerawat' => $_SESSION['id'],
            'tanggal' => date("Y-m-d H:i:s"),
            'tekananDarah' => $this->request->getVar('tekananDarah'),
            'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
            'suhu' => $this->request->getVar('suhu'),
            'frekuensiNafas' => $this->request->getVar('frekuensiNafas'),
            'skorNyeri' => $this->request->getVar('skorNyeri'),
            'beratBadan' => $this->request->getVar('beratBadan'),
            'tinggiBadan' => $this->request->getVar('tinggiBadan'),
            'IMT' => $this->request->getVar('imt'),
            'khususPediatri' => $this->request->getVar('pediatri'),
            'lingkarKepala' => $this->request->getVar('lingkarKepala'),
        ]);

        $session->setFlashdata('msg', 'Assesment Berhasil Ditambahkan!');
        return redirect()->to('perawat/daftar_pasien/');
    }

    public function search_pasien()
    {
        $session = session();
        $user = $this->M_Perawat->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "PERAWAT";
        $keyword =  $this->request->getVar('keyword');
        $data['pasien'] = $this->M_Pasien->like('nama', $keyword)
            ->orLike('nik', $keyword)
            ->orderBy('terakhirDaftar', 'desc')->findAll();
        echo view('include/header', $user);
        echo view('perawat/daftar_pasien', $data);
        echo view('include/footer');
    }
}
