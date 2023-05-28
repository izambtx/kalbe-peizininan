<?php

namespace App\Models;

use CodeIgniter\Model;

class AktifasiModel extends Model
{
    protected $table      = 'aktifasi_fasilitas';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['id_izin', 'on_by', 'off_by', 'PIC', 'PIC_2', 'PIC_3', 'engineer', 'ketua_ert', 'note_off', 'note_on', 'on_at', 'off_at', 'approved_at', 'approved_at_2', 'approved_at_3', 'checked_at', 'agreed_at'];

    public function getAktifasi($id = false)
    {
        if ($id == false) {
            return $this->join('users', 'users.id = aktifasi_fasilitas.off_by')->orderBy('id_izin')->findAll();
        }
        // dd($id);
        return $this->where('id_izin', $id)->first();
    }

    public function getUserAktifasi($id = false)
    {
        if ($id == false) {
            return $this->join('users', 'users.id = aktifasi_fasilitas.on_by')->orderBy('id_izin')->findAll();
        }

        return $this->join('users', 'users.id = aktifasi_fasilitas.on_by')->where('id_izin', $id)->first();
    }
    public function getUserAktifasi2($id = false)
    {
        if ($id == false) {
            return $this->join('users', 'users.id = aktifasi_fasilitas.PIC')->orderBy('id_izin')->findAll();
        }

        return $this->join('users', 'users.id = aktifasi_fasilitas.PIC')->where('id_izin', $id)->first();
    }

    public function getUserAktifasi3($id = false)
    {
        if ($id == false) {
            return $this->join('users', 'users.id = aktifasi_fasilitas.engineer')->orderBy('id_izin')->findAll();
        }

        return $this->join('users', 'users.id = aktifasi_fasilitas.engineer')->where('id_izin', $id)->first();
    }

    public function getUserAktifasi4($id = false)
    {
        if ($id == false) {
            return $this->join('users', 'users.id = aktifasi_fasilitas.ketua_ert')->orderBy('id_izin')->findAll();
        }

        return $this->join('users', 'users.id = aktifasi_fasilitas.ketua_ert')->where('id_izin', $id)->first();
    }

    public function getUserAktifasi5($id = false)
    {
        if ($id == false) {
            return $this->join('users', 'users.id = aktifasi_fasilitas.off_by')->orderBy('id_izin')->findAll();
        }

        return $this->join('users', 'users.id = aktifasi_fasilitas.off_by')->where('id_izin', $id)->first();
    }

    public function getUserAktifasi6($id = false)
    {
        if ($id == false) {
            return $this->join('users', 'users.id = aktifasi_fasilitas.PIC_2')->orderBy('id_izin')->findAll();
        }

        return $this->join('users', 'users.id = aktifasi_fasilitas.PIC_2')->where('id_izin', $id)->first();
    }

    public function getUserAktifasi7($id = false)
    {
        if ($id == false) {
            return $this->join('users', 'users.id = aktifasi_fasilitas.PIC_3')->orderBy('id_izin')->findAll();
        }

        return $this->join('users', 'users.id = aktifasi_fasilitas.PIC_3')->where('id_izin', $id)->first();
    }
}
