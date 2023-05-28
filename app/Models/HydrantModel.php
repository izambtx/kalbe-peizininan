<?php

namespace App\Models;

use CodeIgniter\Model;

class HydrantModel extends Model
{
    protected $table      = 'izin_fasilitas';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = [
        'id_kategori', 'lokasi', 'lokasi_2', 'lokasi_3', 'jumlah_titik',
        'waktu_penggunaan', 'non_aktif', 'keperluan', 'target_waktu', 'rencana_antisipasi', 'status',
        'no_registrasi', 'aktif', 'pembuat', 'PIC', 'engineer', 'ketua_ert', 'approved_at', 'checked_at',
        'evaluated_at', 'agreed_at'
    ];

    public function getHydrant($id = false)
    {
        if ($id == false) {
            return $this->orderBy('created_at')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getRegNoHydrant($id = false)
    {

        return $this->where(['pembuat' => user_id()])->where(['id_kategori' => 2])->countAllResults();
    }

    public function getCountHydrant($id = false)
    {

        return $this->where(['pembuat' => user_id()])->where(['id_kategori' => 2])->countAllResults();
    }



    public function getCountYearMonth($year, $month)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('YEAR(created_at)', $year)->where('MONTH(created_at)', $month)->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalYearMonth($year, $month)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('YEAR(created_at)', $year)->where('MONTH(created_at)', $month)->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotalMonthYear($year, $month)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('YEAR(created_at)', $year)->where('MONTH(created_at)', $month)->orderBy('created_at', 'ASC')->countAllResults();
    }



    public function getCountPemohon($year, $month, $creator)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('YEAR(created_at)', $year)->where('MONTH(created_at)', $month)->where('pembuat', $creator)->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalPemohon($year, $month, $creator)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('YEAR(created_at)', $year)->where('MONTH(created_at)', $month)->where('pembuat', $creator)->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotalCreator($year, $month, $creator)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('YEAR(created_at)', $year)->where('MONTH(created_at)', $month)->where('pembuat', $creator)->orderBy('created_at', 'ASC')->countAllResults();
    }



    public function getCountMonthlyPic($month, $year, $pic)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['PIC' => $pic])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalMonthlyPic($month, $year, $pic)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['PIC' => $pic])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotalPic($month, $year, $pic)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['PIC' => $pic])->orderBy('created_at', 'ASC')->countAllResults();
    }



    public function getCountMonthlyEng($month, $year, $eng)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['engineer' => $eng])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalMonthlyEng($month, $year, $eng)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['engineer' => $eng])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotalEng($month, $year, $eng)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['engineer' => $eng])->orderBy('created_at', 'ASC')->countAllResults();
    }



    public function getCountMonthlyUsers($month, $year, $users)
    {
        return $this->selectCount('id')->where('id_kategori', '2')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['ketua_ert' => $users])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalMonthlyUsers($month, $year, $users)
    {
        return $this->selectCount('id')->where('id_kategori', '2')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['ketua_ert' => $users])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotalUsers($month, $year, $users)
    {
        return $this->selectCount('id')->where('id_kategori', '2')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['ketua_ert' => $users])->orderBy('created_at', 'ASC')->countAllResults();
    }



    public function getCountMonthlyOHSE($month, $year, $users)
    {
        return $this->selectCount('id')->where('id_kategori', '2')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['ohse' => $users])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalMonthlyOHSE($month, $year, $users)
    {
        return $this->selectCount('id')->where('id_kategori', '2')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['ohse' => $users])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotalOHSE($month, $year, $users)
    {
        return $this->selectCount('id')->where('id_kategori', '2')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['ohse' => $users])->orderBy('created_at', 'ASC')->countAllResults();
    }



    public function getCountMonthlyLoc($month, $year, $lokasi)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['lokasi' => $lokasi])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalMonthlyLoc($month, $year, $lokasi)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['lokasi' => $lokasi])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotalLoc($month, $year, $lokasi)
    {
        return $this->selectCount('id')->where('id_kategori', 2)->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['lokasi' => $lokasi])->orderBy('created_at', 'ASC')->countAllResults();
    }
}
