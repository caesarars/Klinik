<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Resep extends Model
{
    protected $table = 'resep';
    protected $allowedFields = ['id', 'idPasien', 'idDokter', 'idSOAP', 'resep', 'tanggal'];

    public  function getPasien($tanggal)
    {
        $sql = $this->select('*')
            ->join('tb_pasien', 'tb_pasien.id=resep.idPasien')
            ->where("tb_pasien.terakhirDaftar >=",  $tanggal)
            ->where("resep.tanggal >=",  $tanggal)
            ->orderBy('resep.tanggal', 'desc');
        return $sql->get()->getResultArray();
    }
}
