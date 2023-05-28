<?php

namespace App\Models;

use CodeIgniter\Model;

class ExtendModel extends Model
{
    protected $table      = 'extend_izin';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['id_izin', 'date_request', 'alasan', 'pembuat', 'extend'];

    public function getExtend($id = false)
    {
        return $this->where(['id_izin' => $id])->orderBy('created_at')->findAll();
    }
}
