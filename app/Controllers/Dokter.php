<?php

namespace App\Controllers;

class Dokter extends BaseController
{
    public function daftar_pasien()
    {
        $session = session();
        $user = $this->M_Dokter->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "DOKTER";
        $data['pasien'] = $this->M_Pasien->orderBy('terakhirDaftar', 'desc')->findAll();
        echo view('include/header', $user);
        echo view('dokter/daftar_pasien', $data);
        echo view('include/footer');
    }

    public function search_pasien()
    {
        $session = session();
        $user = $this->M_Dokter->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "DOKTER";
        $keyword =  $this->request->getVar('keyword');
        $data['pasien'] = $this->M_Pasien->like('nama', $keyword)
            ->orLike('nik', $keyword)
            ->orderBy('terakhirDaftar', 'desc')->findAll();
        echo view('include/header', $user);
        echo view('dokter/daftar_pasien', $data);
        echo view('include/footer');
    }

    public function Soap($id)
    {
        $session = session();
        $user = $this->M_Dokter->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "DOKTER";

        $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
        $data['template'] = $this->M_Template->where(["idDokter" => $_SESSION['id']])->findAll();
        $data['assesment'] = $this->M_Assesment->where(["idPasien" => $id])->orderBy('tanggal', 'desc')->first();
        echo view('include/header', $user);
        echo view('dokter/soap', $data);
        echo view('include/footer');
    }

    public function insert_soap($id)
    {
        // dd($this->request->getVar('resep'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $data['assesment'] = $this->M_Assesment->where(["idPasien" => $id])->orderBy('tanggal', 'desc')->first();
        $this->M_Soap->insert([
            'idPasien' => $id,
            'idAssesment' => $data['assesment']['id'],
            'idDokter' => $_SESSION['id'],
            'tanggal' => date("Y-m-d H:i:s"),
            'subjective' => $this->request->getVar('subjective'),
            'objective' => $this->request->getVar('objective'),
            'assesment' => $this->request->getVar('assesment'),
            'planning' => $this->request->getVar('planning'),
        ]);
        $id_soap = $this->M_Soap->getInsertID();
        $this->M_Resep->insert([
            'idPasien' => $id,
            'idDokter' => $_SESSION['id'],
            'idSOAP' => $id_soap,
            'resep' => $this->request->getVar('resep'),
        ]);

        $session->setFlashdata('msg', 'Data Rekam Medis Berhasil Ditambahkan!');
        return redirect()->to('dokter/daftar_pasien/');
    }

    public function Riwayat($id)
    {
        $session = session();
        $user = $this->M_Dokter->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "DOKTER";

        $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
        $data['assesment'] = $this->M_Assesment->where(["idPasien" => $id])->orderBy('tanggal', 'desc')->first();
        $data['soap'] = $this->M_Soap->getData($id);
        // dd($data['soap']);
        echo view('include/header', $user);
        echo view('dokter/riwayat', $data);
        echo view('include/footer');
    }

    public function edit_soap($id)
    {
        $session = session();
        $user = $this->M_Dokter->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "DOKTER";

        $data['soap'] = $this->M_Soap->where(["id" => $id])->first();
        $data['pasien'] = $this->M_Pasien->where(["id" => $data['soap']['idPasien']])->first();
        echo view('include/header', $user);
        echo view('dokter/edit_soap', $data);
        echo view('include/footer');
    }

    public function update_soap($id)
    {

        $session = session();
        $this->M_Soap->save([
            'id' => $id,
            'subjective' => $this->request->getVar('subjective'),
            'objective' => $this->request->getVar('objective'),
            'assesment' => $this->request->getVar('assesment'),
            'planning' => $this->request->getVar('planning'),
        ]);

        $soap = $this->M_Soap->where(["id" => $id])->first();

        $session->setFlashdata('msg', 'Data Rekam Medis Berhasil Diubah!');
        return redirect()->to('dokter/riwayat/' . $soap['idPasien']);
    }

    public function template()
    {
        $session = session();
        $user = $this->M_Dokter->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "DOKTER";

        $data['template'] = $this->M_Template->where('idDokter', $_SESSION['id'])->findAll();
        echo view('include/header', $user);
        echo view('dokter/template', $data);
        echo view('include/footer');
    }

    public function tambah_template()
    {
        $session = session();
        $user = $this->M_Dokter->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "DOKTER";

        // $data['template'] = $this->M_Template->where('idDokter', $_SESSION['id'])->first();
        echo view('include/header', $user);
        echo view('dokter/tambah_template');
        echo view('include/footer');
    }

    public function insert_template()
    {
        $session = session();
        $this->M_Template->save([
            'idDokter' => $_SESSION['id'],
            'keyword' => $this->request->getVar('keyword'),
            'subjective' => $this->request->getVar('subjective'),
            'objective' => $this->request->getVar('objective'),
            'assesment' => $this->request->getVar('assesment'),
            'planning' => $this->request->getVar('planning'),
        ]);

        $session->setFlashdata('msg', 'Template Berhasil Ditambahkan!');
        return redirect()->to('dokter/template');
    }

    public function edit_template($id)
    {
        $session = session();
        $user = $this->M_Dokter->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "DOKTER";

        $data['template'] = $this->M_Template->where('id', $id)->first();
        echo view('include/header', $user);
        echo view('dokter/edit_template', $data);
        echo view('include/footer');
    }

    public function update_template($id)
    {
        $session = session();
        $this->M_Template->save([
            'id' => $id,
            'idDokter' => $_SESSION['id'],
            'keyword' => $this->request->getVar('keyword'),
            'subjective' => $this->request->getVar('subjective'),
            'objective' => $this->request->getVar('objective'),
            'assesment' => $this->request->getVar('assesment'),
            'planning' => $this->request->getVar('planning'),
        ]);

        $session->setFlashdata('msg', 'Template Berhasil Diubah!');
        return redirect()->to('dokter/template');
    }
}
