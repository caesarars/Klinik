<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pemilik extends Model
{
    protected $table = 'tb_pemilik';
    protected $allowedFields = ['id', 'nama', 'nik', 'tempatLahir', 'tanggalLahir', 'jenisKelamin', 'kewarganegaraan', 'agama', 'statusPernikahan', 'golonganDarah', 'pendidikan', 'alamat', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'kodePos', 'noTelp', 'noHP', 'email'];
}
