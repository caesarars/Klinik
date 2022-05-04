<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class FilterDokter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('msg', 'Anda Belum Login, Silahkan Login Dulu !');
            return redirect()
                ->to('');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (session()->get('jabatan') == "dokter") {
            // dd(session()->get('jabatan'));

            // session()->setFlashdata('msg', 'Anda Belum Login, Silahkan Login Dulu !');
            return redirect()->to('/dokter/daftar_pasien');
        }
    }
}
