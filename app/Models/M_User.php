<?php

namespace App\Models;

use CodeIgniter\Model;

class M_User extends Model
{
    protected $table = 'tb_user';
    protected $allowedFields = ['username', 'password', 'jabatan', 'id'];
}
