<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiModel extends Model
{
    protected $table      = 'lokasi';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['nama_lokasi'];

    public function getLokasi($id = false)
    {
        if ($id == false) {
            return $this->orderBy('nama_lokasi')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getPicLokasi($id = false)
    {

        return $this->join('izin_fasilitas', 'izin_fasilitas.lokasi = lokasi.id')->join('users', 'users.id = lokasi.PIC')->where(['izin_fasilitas.id' => $id])->first();
    }
}
