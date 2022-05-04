<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class FilterApoteker implements FilterInterface
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
        if (session()->get('jabatan') == "apoteker") {
            // dd(session()->get('jabatan'));

            // session()->setFlashdata('msg', 'Anda Belum Login, Silahkan Login Dulu !');
            return redirect()->to('/apoteker/daftar_pasien');
        }
    }
}
