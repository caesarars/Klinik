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
    public  function getAllData($dari, $hingga)
    {
        return $this->select(
            'tb_pasien.id as idPasien, ' .
                'tb_pasien.nama as namaPasien, ' .
                'assesment.idPerawat, ' .
                'assesment.tanggal as tanggalAssesment, ' .
                'assesment.keluhanUtama, ' .
                'assesment.tekananDarah, ' .
                'assesment.frekuensiNadi, ' .
                'assesment.suhu, ' .
                'assesment.frekuensiNafas, ' .
                'assesment.skorNyeri, ' .
                'assesment.beratBadan, ' .
                'assesment.tinggiBadan, ' .
                'assesment.lingkarKepala, ' .
                'tb_dokter.nama as namaDokter, ' .
                'soap.tanggal as tanggalSOAP, ' .
                'soap.subjective, ' .
                'soap.objective, ' .
                'soap.assesment, ' .
                'soap.planning, ' .
                'resep.resep '
        )
            ->join('assesment', 'assesment.id=soap.idAssesment')
            ->join('tb_pasien', 'tb_pasien.id=soap.idPasien')
            ->join('tb_dokter', 'tb_dokter.id=soap.idDokter')
            ->join('resep', 'resep.idSOAP=soap.id')
            ->where('soap.tanggal >=', date($dari))
            ->where('soap.tanggal <=', date($hingga))
            // ->join('tb_perawat', 'tb_perawat.id=assesment.idPerawat')
            ->orderBy('idPasien', 'asc')
            ->get()->getResultArray();
    }
}
