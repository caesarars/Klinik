<?php

namespace App\Models;

use CodeIgniter\Model;

class M_TemplateResep extends Model
{
    protected $table = 'template_resep';
    protected $allowedFields = ['id', 'idDokter', 'keyword', 'resep'];
}
