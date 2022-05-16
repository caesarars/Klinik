<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Assesment extends Model
{
<<<<<<< HEAD:app/Models/M_Assessment.php
    protected $table = 'tb_assessment';
=======
    protected $table = 'assesment';
>>>>>>> parent of 654dd2e (finalisasi):app/Models/M_Assesment.php
    protected $allowedFields = ['id', 'idPasien', 'idPerawat', 'tanggal', 'keluhanUtama', 'tekananDarah', 'frekuensiNadi', 'suhu', 'frekuensiNafas', 'skorNyeri', 'beratBadan', 'tinggiBadan', 'lingkarKepala'];
}
