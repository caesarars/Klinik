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
        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 003');
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
        $pdf->SetFont('times', 'BI', 12);

        // add a page
        $pdf->AddPage();

        // set some text to print
        $txt = <<<EOD
       
        
TCPDF Example 003

Custom page header and footer are defined by extending the TCPDF class and overriding the Header() and Footer() methods.
EOD;

        // print a block of text using Write()
        $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

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

    //Page header
    public function Header()
    {
        // Logo
        // $image_file = K_PATH_IMAGES . 'logo_example.jpg';
        $this->Image('images/Old_Nike_logo.jpg', 10, 10, 40, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 15);
        // Title
        $this->Cell(0, 15, 'Klinik dr. Farabi', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
        // Set font
        $this->SetFont('helvetica', '', 15);
        // Title
        $this->Cell(0, 15, 'Ruko Peson View Blok i no 3', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 15, 'Jl. Ir. H Juanda Mekarjaya SUkmajaya Depok', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 15, 'Telephone : 08-11111-6504', 0, 2, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
