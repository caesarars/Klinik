<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Kontak extends Model
{
    protected $table = 'kontak_darurat';
    protected $allowedFields = ['id', 'idPasien', 'nama', 'hubungan', 'alamat', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'kodePos', 'noTelp', 'noHP', 'email'];
}
