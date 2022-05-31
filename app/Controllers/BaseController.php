<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        $this->M_Admin = new \App\Models\M_Admin();
        $this->M_Pasien = new \App\Models\M_Pasien();
        $this->M_Dokter = new \App\Models\M_Dokter();
        $this->M_Perawat = new \App\Models\M_Perawat();
        $this->M_Kontak = new \App\Models\M_Kontak();
        $this->M_User = new \App\Models\M_User();
        $this->M_Soap = new \App\Models\M_Soap();
        $this->M_Assesment = new \App\Models\M_Assesment();
        $this->M_Template = new \App\Models\M_Template();
        $this->M_Apoteker = new \App\Models\M_Apoteker();
        $this->M_Resep = new \App\Models\M_Resep();
        $this->M_Pemilik = new \App\Models\M_Pemilik();
        $this->M_TemplateResep = new \App\Models\M_TemplateResep();
        $this->M_Log = new \App\Models\M_Log();
    }
}
