<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Dokter extends Model
{
    protected $table = 'tb_dokter';
    protected $allowedFields = ['id', 'nama', 'nik', 'jenis', 'tempatLahir', 'tanggalLahir', 'jenisKelamin', 'kewarganegaraan', 'agama', 'umur', 'statusPernikahan', 'golonganDarah', 'pendidikan', 'alamat', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'kodePos', 'noTelp', 'noHP', 'email'];
}
