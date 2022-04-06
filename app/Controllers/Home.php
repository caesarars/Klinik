<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function index()
    {
        // echo view('include/header');
        echo view('login');
        // echo view('include/footer');
    }

    public function login()
    {
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $user = $this->M_User->where('username', $username)->first();
        if ($user) {
            $pass = $user['password'];
            // $verify_pass = password_verify($password, $pass);
            if ($password == $pass) {
                $ses_data = [
                    'id'       => $user['id'],
                    'username'     => $user['username'],
                    'jabatan'    => $user['jabatan'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                if ($ses_data['jabatan'] == 'admin') {
                    $admin = $this->M_Admin->where('id', $ses_data['id'])->first();
                    return redirect()->to('admin/tambah_pasien/');
                } elseif ($ses_data['jabatan'] == 'dokter') {
                    $dokter = $this->M_Dokter->where('id', $ses_data['id'])->first();
                    return redirect()->to('dokter/daftar_pasien/');
                } elseif ($ses_data['jabatan'] == 'perawat') {
                    $perawat = $this->M_Perawat->where('id', $ses_data['id'])->first();
                    return redirect()->to('Perawat/daftar_pasien/');
                } elseif ($ses_data['jabatan'] == 'apoteker') {
                    $apoteker = $this->M_Apoteker->where('id', $ses_data['id'])->first();
                    return redirect()->to('apoteker/daftar_pasien/');
                }
            } else {
                $session->setFlashdata('msg', 'Password Anda Salah!');
                return redirect()->to('');
            }
        } else {
            $session->setFlashdata('msg', 'Akun Tidak Ditemukan!');
            return redirect()->to('');
        }
        // print_r($user);
        // if ($user) {
        //     echo view('Dokter/daftar_pasien');
        // } else {
        //     $this->session->set_flashdata('salah_login', '1');
        //     redirect('login', 'refresh');
        // }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('');
    }
}
