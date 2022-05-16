<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Assessment extends Model
{
    protected $table = 'tb_assessment';
    protected $allowedFields = ['id', 'idPasien', 'idPerawat', 'tanggal', 'keluhanUtama', 'tekananDarah', 'frekuensiNadi', 'suhu', 'frekuensiNafas', 'skorNyeri', 'beratBadan', 'tinggiBadan', 'lingkarKepala'];
}
