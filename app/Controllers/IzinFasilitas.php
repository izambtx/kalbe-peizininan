<?php

namespace App\Controllers;

use App\Controllers;
use Config\Services;
use Myth\Auth\Entities\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\KategoriModel;


class IzinFasilitas extends BaseController
{
    protected $db, $builder, $usersModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('izin_fasilitas');
        $this->kategoriModel = new KategoriModel();
    }

    public function index($id = false)
    {
        $data = [
            'title' => 'Dashboard',
            'kategori' => $this->kategoriModel->getKategori()
        ];

        return view('dashboard', $data);
    }
}
