<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pasien extends Model
{
    protected $table = 'tb_pasien';
    protected $allowedFields = ['id', 'nama', 'nik', 'tempatLahir', 'tanggalLahir', 'jenisKelamin', 'kewarganegaraan', 'agama', 'statusPernikahan', 'statusAsuransi', 'golonganDarah', 'pendidikan', 'alamat', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'kodePos', 'noTelp', 'noHP', 'email', 'terakhirDaftar'];

    public  function getSearch($keyword)
    {
        return $this->select('*')
            ->where('id =', $keyword)
            ->orlike('nama', $keyword)
            ->orwhere('nik =', $keyword)
            ->orderBy('terakhirDaftar', 'desc')
            ->get()->getResultArray();
    }
}
