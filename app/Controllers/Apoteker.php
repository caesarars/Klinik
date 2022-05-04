<?php

namespace App\Controllers;

use DateTime;
use TCPDF;

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
        if ($data['pasien']) {

            echo view('include/header', $user);
            echo view('apoteker/daftar_pasien', $data);
            echo view('include/footer');
        } else {
            $session->setFlashdata('msg', 'Pasien Tidak Ditemukan!');
            return redirect()->to('apoteker/daftar_pasien');
        }
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
        $data['assesment'] = $this->M_Assesment->where(["idPasien" => $id])->orderBy('tanggal', 'desc')->first();
        $data['resep'] = $this->M_Resep->where(["idPasien" => $id])
            ->orderBy("id", 'DESC')->first();
        // dd($data['resep']);
        if (!$data['resep']) {
            $session->setFlashdata('msg', 'Belum ada resep');
            return redirect()->to('/apoteker/daftar_pasien');
        }
        echo view('include/header', $user);
        echo view('apoteker/resep', $data);
        echo view('include/footer');
    }

    // public function printResep($id)
    // {
    //     $session = session();
    //     $user = $this->M_Apoteker->where('id', $_SESSION['id'])->first();
    //     $user["jabatan"] = "APOTEKER";

    //     $data['pasien'] = $this->M_Pasien->where(["id" => $id])->first();
    //     date_default_timezone_set('Asia/Jakarta');
    //     $currentDate = new DateTime();
    //     $tanggalLahir = new DateTime($data['pasien']['tanggalLahir']);
    //     $data['pasien']['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
    //     $data['pasien']['tanggalLahir'] = date_format($tanggalLahir, "d/m/Y");
    //     $data['resep'] = $this->M_Resep->where(["idPasien" => $id])->first();

    //     $html =  view('apoteker/v_resep', $data);
    //     $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    //     $pdf->addPage();
    //     $pdf->writeHTML($html);
    //     ob_end_clean();
    //     $this->response->setContentType('application/pdf');
    //     $pdf->Output('resep.pdf', 'I');
    // }

    public function printResep($id)
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
        $data['assesment'] = $this->M_Assesment->where(["idPasien" => $id])->orderBy('tanggal', 'desc')->first();
        $data['resep'] = $this->M_Resep->where(["idPasien" => $id])
            ->orderBy("id", 'DESC')->first();

        $data['resep']['resep'] =  explode("\n", $data['resep']['resep']);
        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setId($id);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Klinik dr. Farabi');
        $pdf->SetTitle("Resep " . $data['pasien']['nama']);
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('times', '', 10);
        $pdf->setCellHeightRatio(0.8);
        $pdf->SetMargins(2, 5, 2, 5,  false);
        //load the html
        $html =  view('apoteker/resepHTML', $data);

        // add a page
        $pdf->AddPage('P', 'A6');

        // print the HTML
        $pdf->writeHTML($html, true, true, true, true, '');

        // // print a block of text using Write()
        // $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

        // ---------------------------------------------------------

        $this->response->setContentType('application/pdf');
        //Close and output PDF document
        $pdf->Output('example_003.pdf', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
    }
}

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{
    private $id;

    public function setId($id)
    {
        $this->id = $id;
    }
    //Page header
    public function Header()
    {
        // Logo
        // $image_file = K_PATH_IMAGES . 'logo_example.jpg';
        $this->Image('images/Old_Nike_logo.jpg', 5, 10, 20, '', 'JPG', '', 'T', false, 100, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 10);
        // Title
        $this->Cell(0, 8, 'Klinik dr. Farabi', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
        // Set font
        $this->SetFont('helvetica', '', 10);
        // Title
        $this->Cell(0, 8, 'Ruko Peson View Blok i no 3', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 8, 'Jl. Ir. H Juanda Mekarjaya Sukmajaya Depok', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 8, 'Telephone : 08-11111-6504', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer()
    {
        $M_Pasien = model('App\Models\M_pasien');
        $M_Assesment = model('App\Models\M_Assesment');

        $pasien = $M_Pasien->where(["id" => $this->id])->first();
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = new DateTime();
        $tanggalLahir = new DateTime($pasien['tanggalLahir']);
        $pasien['umur'] = $tanggalLahir->diff($currentDate)->format('%y Tahun %m Bulan %d Hari');
        $assesment = $M_Assesment->where(["idPasien" => $this->id])->orderBy('tanggal', 'desc')->first();

        // Position at 15 mm from bottom
        $this->SetY(-25);
        // Set font
        $this->SetFont('helvetica', '', 10);

        $style = array('width' => 0.8, 'color' => array(0, 0, 0));
        $this->Line(3, 115, 102, 115, $style);
        $this->Cell(0, 8, "Pro              : " . $pasien['nama'], 0, 2, 'L', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 8, 'Umur /BB    : ' . $pasien['umur'] . " /" . $assesment['beratBadan'] . " Kg", 0, 2, 'L', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 20, 'Alamat         : ' . $pasien['alamat'], 0, 2, 'L', 0, '', 0, false, 'M', 'M');

        // Set font
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 15, 'Klinik dr. Farabi - www.klinikdokterfarabi.com', 0, 2, 'R', 0, '', 0, false, 'M', 'M');
    }
}
