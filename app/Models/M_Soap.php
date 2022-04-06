<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Soap extends Model
{
    protected $table = 'soap';
    protected $allowedFields = ['id', 'idPasien', 'idAssesment', 'idDokter', 'tanggal', 'subjective', 'objective', 'assesment', 'planning'];


    public  function getData($id)
    {
        return $this->select('*, soap.id, soap.idPasien, soap.idAssesment, soap.idDokter, soap.tanggal')
            ->join('tb_dokter', 'tb_dokter.id=soap.idDokter')
            ->join('assesment', 'assesment.id=soap.idAssesment')
            ->where(["soap.idPasien" => $id])
            ->orderBy('soap.tanggal', 'desc')
            ->get()->getResultArray();
    }
}
