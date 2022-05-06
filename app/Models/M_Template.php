<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Template extends Model
{
    protected $table = 'template_soap';
    protected $allowedFields = ['id', 'idDokter', 'keyword', 'subjective', 'objective', 'assesment', 'planning', 'resep'];
}
