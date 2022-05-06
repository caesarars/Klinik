<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Assesment extends Model
{
    protected $table = 'assesment';
    protected $allowedFields = ['id', 'idPasien', 'idPerawat', 'tanggal', 'keluhanUtama', 'tekananDarah', 'frekuensiNadi', 'suhu', 'frekuensiNafas', 'skorNyeri', 'beratBadan', 'tinggiBadan', 'lingkarKepala'];
}
