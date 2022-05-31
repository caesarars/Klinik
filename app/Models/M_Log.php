<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Log extends Model
{
    protected $table = 'log';
    protected $allowedFields = ['id', 'idUser', 'jabatan', 'log', 'tanggal'];
}
