<?php

namespace App\Controllers;

use DateTime;
use PhpParser\Node\Stmt\Finally_;

class Dokter extends BaseController
{
    public function daftar_pasien()
    {
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $user = $this->M_Dokter->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "DOKTER";
        $data['pasien'] = $this->M_Pasien
            ->where('terakhirDaftar >=', date("Y-m-d"))
            ->orderBy('terakhirDaftar', 'desc')->findAll();
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
        $data['pasien'] = $this->M_Pasien->getSearch($keyword);
        if ($data['pasien']) {
            echo view('include/header', $user);
            echo view('dokter/daftar_pasien', $data);
            echo view('include/footer');
        } else {
            $session->setFlashdata('error', 'Pasien Tidak Ditemukan');
            return redirect()->to('Dokter/daftar_pasien');
        }
    }

    public function Soap($id)
    {
        $session = session();
        $user = $this->M_Dokter->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "DOKTER";

        $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $tanggalLahir = new DateTime($data['pasien']['tanggalLahir']);
        $data['pasien']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        $data['pasien']['tanggalLahir'] = date_format($tanggalLahir, "d/m/Y");
        $data['template'] = $this->M_Template->where(["idDokter" => $_SESSION['id']])->findAll();
        $data['templateResep'] = $this->M_TemplateResep->where(["idDokter" => $_SESSION['id']])->findAll();
        $data['assesment'] = $this->M_Assesment->where(["idPasien" => $id])->orderBy('tanggal', 'desc')->first();
        if ($data['assesment']) {
            $beratBadan = (float)str_replace(",", ".", $data['assesment']['beratBadan']);
            $tinggiBadan = (float)str_replace(",", ".", $data['assesment']['tinggiBadan']);
            // dd($tinggiBadan);
            if ((is_numeric($beratBadan)) and (is_numeric($tinggiBadan)) and ($tinggiBadan > 0)) {
                $IMT = $beratBadan / (sqrt($tinggiBadan / 100));
                $data['assesment']['IMT'] = number_format($IMT, 2, ',');
            } else {
                $data['assesment']['IMT'] = '';
            }
            echo view('include/header', $user);
            echo view('dokter/soap', $data);
            echo view('include/footer');
        } else {
            $session->setFlashdata('error', 'Pasien Belum Melakukan Assesment Perawat');
            return redirect()->to('Dokter/daftar_pasien');
        }
    }

    public function insert_soap($id)
    {
        // dd($this->request->getVar('resep'));
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $data['assesment'] = $this->M_Assesment->where(["idPasien" => $id])->orderBy('tanggal', 'desc')->first();
        try {
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
            if ($this->request->getVar('resep') != '') {

                $id_soap = $this->M_Soap->getInsertID();
                $this->M_Resep->insert([
                    'idPasien' => $id,
                    'idDokter' => $_SESSION['id'],
                    'idSOAP' => $id_soap,
                    'resep' => $this->request->getVar('resep'),
                    'tanggal' => date("Y-m-d H:i:s"),
                ]);
            }
            $this->M_Pasien->save([
                'id' => $id,
                'soap' => date("Y-m-d H:i:s")
            ]);
            $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
            $log = 'Menambahkan Rekam Medis Pasien dengan id ' . $id . ' a/n ' .  $data['pasien']['nama'];

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Dokter',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Data Rekam Medis Berhasil Ditambahkan');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Data Rekam Medis Gagal Ditambahkan\n" . $ex);
        } finally {
            return redirect()->to('dokter/daftar_pasien/');
        }
    }

    public function Riwayat($id)
    {
        $session = session();
        $user = $this->M_Dokter->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "DOKTER";

        $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $tanggalLahir = new DateTime($data['pasien']['tanggalLahir']);
        $data['pasien']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        $data['pasien']['tanggalLahir'] = date_format($tanggalLahir, "d/m/Y");
        $data['assesment'] = $this->M_Assesment->where(["idPasien" => $id])->orderBy('tanggal', 'desc')->first();
        $beratBadan = (float)str_replace(",", ".", $data['assesment']['beratBadan']);
        $tinggiBadan = (float)str_replace(",", ".", $data['assesment']['tinggiBadan']);
        if ((is_numeric($beratBadan)) and (is_numeric($tinggiBadan)) and ($tinggiBadan > 0)) {
            $IMT = $beratBadan / (sqrt($tinggiBadan / 100));
            $data['assesment']['IMT'] = number_format($IMT, 2, ',');
        } else {
            $data['assesment']['IMT'] = '';
        }
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
        $data['resep'] = $this->M_Resep->where(["idSOAP" => $id])->first();
        if (!$data['resep']) {
            $data['resep']['resep'] = '';
        }
        // dd($data['resep']);
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $tanggalLahir = new DateTime($data['pasien']['tanggalLahir']);
        $data['pasien']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        $data['pasien']['tanggalLahir'] = date_format($tanggalLahir, "d/m/Y");
        $data['template'] = $this->M_Template->where(["idDokter" => $_SESSION['id']])->findAll();
        $data['templateResep'] = $this->M_TemplateResep->where(["idDokter" => $_SESSION['id']])->findAll();
        $data['assesment'] = $this->M_Assesment->where(["idPasien" => $data['soap']['idPasien'], "id" => $data['soap']['idAssesment']])->orderBy('tanggal', 'desc')->first();
        if ($data['assesment']) {
            $beratBadan = (float)str_replace(",", ".", $data['assesment']['beratBadan']);
            $tinggiBadan = (float)str_replace(",", ".", $data['assesment']['tinggiBadan']);
            if ((is_numeric($beratBadan)) and (is_numeric($tinggiBadan)) and ($tinggiBadan > 0)) {
                $IMT = $beratBadan / (sqrt($tinggiBadan / 100));
                $data['assesment']['IMT'] = number_format($IMT, 2, ',');
            } else {
                $data['assesment']['IMT'] = '';
            }
            echo view('include/header', $user);
            echo view('dokter/edit_soap', $data);
            echo view('include/footer');
        } else {
            $session->setFlashdata('error', 'Riwayat Assesment Tidak Ada');
            return redirect()->to('Dokter/daftar_pasien');
        }
    }

    public function update_soap($id)
    {

        $session = session();
        try {
            $this->M_Soap->save([
                'id' => $id,
                'subjective' => $this->request->getVar('subjective'),
                'objective' => $this->request->getVar('objective'),
                'assesment' => $this->request->getVar('assesment'),
                'planning' => $this->request->getVar('planning'),
            ]);
            $soap = $this->M_Soap->where(["id" => $id])->first();
            $resep = $this->M_Resep->where(["idSOAP" => $id])->first();
            // dd($resep);
            if ($resep) {
                $this->M_Resep->save([
                    'id' => $resep['id'],
                    'idDokter' => $_SESSION['id'],
                    'idSOAP' => $id,
                    'resep' => $this->request->getVar('resep'),
                ]);
            } else {
                $this->M_Resep->save([
                    'idDokter' => $_SESSION['id'],
                    'idSOAP' => $id,
                    'resep' => $this->request->getVar('resep'),
                ]);
            }
            $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
            $log = 'Menambahkan Rekam Medis Pasien dengan id ' . $id . ' a/n ' .  $data['pasien']['nama'];

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Dokter',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Data Rekam Medis Berhasil Diubah');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Data Rekam Medis Gagal Diubah\n" . $ex);
        } finally {
            return redirect()->to('dokter/riwayat/' . $soap['idPasien']);
        }
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
        try {
            $this->M_Template->save([
                'idDokter' => $_SESSION['id'],
                'keyword' => $this->request->getVar('keyword'),
                'subjective' => $this->request->getVar('subjective'),
                'objective' => $this->request->getVar('objective'),
                'assesment' => $this->request->getVar('assesment'),
                'planning' => $this->request->getVar('planning'),
            ]);
            $log = 'Menambahkan template rekam medis dengan keyword = ' . $this->request->getVar('keyword');

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Dokter',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Template Berhasil Diubah');
        } catch (\Exception $ex) {

            $session->setFlashdata('error', "Template Gagal Diubah\n" . $ex);
        } finally {
            return redirect()->to('dokter/template');
        }
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
        try {
            $this->M_Template->save([
                'id' => $id,
                'idDokter' => $_SESSION['id'],
                'keyword' => $this->request->getVar('keyword'),
                'subjective' => $this->request->getVar('subjective'),
                'objective' => $this->request->getVar('objective'),
                'assesment' => $this->request->getVar('assesment'),
                'planning' => $this->request->getVar('planning'),
            ]);

            $log = 'Mengubah template soap dengan id = ' . $id;

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Dokter',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Template Berhasil Diubah');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Template Gagal Diubah\n" . $ex);
        } finally {
            return redirect()->to('dokter/template');
        }
    }

    public function delete_template($id)
    {
        $session = session();
        try {

            $this->M_Template->delete($id);
            $log = 'Menghapus template rekam medis dengan id = ' . $id;

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Dokter',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Template Berhasil Dihapus');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Template Gagal Dihapus\n" . $ex);
        } finally {
            return redirect()->to('dokter/template');
        }
    }

    public function template_resep()
    {
        $session = session();
        $user = $this->M_Dokter->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "DOKTER";

        $data['template'] = $this->M_TemplateResep->where('idDokter', $_SESSION['id'])->findAll();
        echo view('include/header', $user);
        echo view('dokter/template_resep', $data);
        echo view('include/footer');
    }

    public function tambah_template_resep()
    {
        $session = session();
        $user = $this->M_Dokter->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "DOKTER";

        // $data['template'] = $this->M_Template->where('idDokter', $_SESSION['id'])->first();
        echo view('include/header', $user);
        echo view('dokter/tambah_template_resep');
        echo view('include/footer');
    }

    public function insert_template_resep()
    {
        $session = session();
        try {

            $this->M_TemplateResep->save([
                'idDokter' => $_SESSION['id'],
                'keyword' => $this->request->getVar('keyword'),
                'resep' => $this->request->getVar('resep'),
            ]);
            $log = 'Menambahkan template resep dengan keyword = ' . $this->request->getVar('keyword');

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Dokter',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Template Resep Berhasil Diubah');
        } catch (\Exception $ex) {
            $session->setFlashdata('success', "Template Resep Gagal Diubah\n" . $ex);
        } finally {
            return redirect()->to('dokter/template_resep');
        }
    }

    public function edit_template_resep($id)
    {
        $session = session();
        $user = $this->M_Dokter->where('id', $_SESSION['id'])->first();
        $user["jabatan"] = "DOKTER";

        $data['template'] = $this->M_TemplateResep->where('id', $id)->first();
        echo view('include/header', $user);
        echo view('dokter/edit_template_resep', $data);
        echo view('include/footer');
    }

    public function update_template_resep($id)
    {
        $session = session();
        try {
            $this->M_TemplateResep->save([
                'id' => $id,
                'idDokter' => $_SESSION['id'],
                'keyword' => $this->request->getVar('keyword'),
                'resep' => $this->request->getVar('resep'),
            ]);
            $log = 'mengubah template resep dengan id = ' . $id;

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Dokter',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Template Resep Berhasil Diubah');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Template Resep Gagal Diubah\n" . $ex);
        } finally {

            return redirect()->to('dokter/template_resep');
        }
    }

    public function delete_template_resep($id)
    {
        $session = session();
        try {
            $this->M_TemplateResep->delete($id);
            $log = 'Menghapus template resep dengan id = ' . $id;

            $this->M_Log->insert([
                'idUser' => $_SESSION['id'],
                'jabatan' => 'Dokter',
                'log' => $log,
                'tanggal' => date("Y-m-d H:i:s")
            ]);
            $session->setFlashdata('success', 'Template Resep Berhasil Dihapus');
        } catch (\Exception $ex) {
            $session->setFlashdata('error', "Template Resep Gagal Dihapus\n" . $ex);
        } finally {

            return redirect()->to('dokter/template_resep');
        }
    }
}
