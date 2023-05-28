<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoPeModel extends Model
{
    protected $table      = 'foto_izin_fasilitas';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['id_izin', 'id_kategori', 'nama_foto', 'keterangan', 'pembuat'];

    public function getFotoPe($id = false)
    {
        if ($id == false) {
            return $this->orderBy('nama_foto')->findAll();
        }

        return $this->where(['id_izin' => $id])->where(['id_kategori' => 1])->findAll();
    }

    public function getCountFotoPe($id = 0)
    {
        return $this->where(['id_izin' => $id])->where(['id_kategori' => 1])->countAllResults();
    }
}
