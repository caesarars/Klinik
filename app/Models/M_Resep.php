<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Resep extends Model
{
    protected $table = 'resep';
    protected $allowedFields = ['id', 'idPasien', 'idDokter', 'idSOAP', 'resep', 'tanggal'];
}
