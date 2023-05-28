<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $table      = 'detail_status';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['id_izin', 'status', 'id_user'];

    public function getStatus($id = false)
    {
        // if ($id == false) {
        //     return $this->orderBy('id_izin')->findAll();
        // }

        // $this->builder->select('izin_fasilitas.*, detail_status.*, users.username');
        // $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
        // $this->builder->where('izin_fasilitas.id', $id);
        // $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
        // $query = $this->builder->get();

        // return $query;
        return $this->select('detail_status.*, users.username')->join('users', 'users.id = detail_status.id_user')->where(['id_izin' => $id])->orderBy('created_at')->findAll();
    }
}
