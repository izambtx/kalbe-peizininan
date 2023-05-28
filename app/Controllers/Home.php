<?php

namespace App\Controllers;

use App\Controllers;
use Config\Services;
use Myth\Auth\Entities\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\UsersModel;
use App\Models\LokasiModel;
use App\Models\PintuModel;
use App\Models\HydrantModel;
use App\Models\SmokeModel;
use App\Models\FireModel;

class Home extends BaseController
{
    protected $db, $builder, $usersModel;
    protected $kategoriModel;
    protected $lokasiModel;
    protected $pintuModel;
    protected $hydrantModel;
    protected $smokeModel;
    protected $fireModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->usersModel = new UsersModel();
        $this->lokasiModel = new LokasiModel();
        $this->pintuModel = new PintuModel();
        $this->hydrantModel = new HydrantModel();
        $this->smokeModel = new SmokeModel();
        $this->fireModel = new FireModel();
    }

    public function index()
    {
        return redirect()->to('/Home');
    }

    public function home($id = false)
    {

        if (in_groups('supervisor')) {
            $data = [
                'title' => 'Home',
                'countPintu' => $this->pintuModel->getCountPintu(),
                'countHydrant' => $this->hydrantModel->getCountHydrant(),
                'countSmoke' => $this->smokeModel->getCountSmoke(),
                'countFire' => $this->fireModel->getCountFire(),
            ];
        } elseif (in_groups('manager')) {
            $data = [
                'title' => 'Home',
                'countPintu' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 1])->where(['PIC' => user_id()])->countAllResults(),
                'countHydrant' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 2])->where(['PIC' => user_id()])->countAllResults(),
                'countSmoke' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 3])->where(['PIC' => user_id()])->countAllResults(),
                'countFire' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 4])->where(['PIC' => user_id()])->countAllResults(),
            ];
        } elseif (in_groups('engineer')) {
            $data = [
                'title' => 'Home',
                'countPintu' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 1])->where(['engineer' => user_id()])->countAllResults(),
                'countHydrant' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 2])->where(['engineer' => user_id()])->countAllResults(),
                'countSmoke' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 3])->where(['engineer' => user_id()])->countAllResults(),
                'countFire' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 4])->where(['engineer' => user_id()])->countAllResults(),
            ];
        } elseif (in_groups('OHSE')) {
            $data = [
                'title' => 'Home',
                'countPintu' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 1])->where(['ohse' => user_id()])->countAllResults(),
                'countHydrant' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 2])->where(['ohse' => user_id()])->countAllResults(),
                'countSmoke' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 3])->where(['ohse' => user_id()])->countAllResults(),
                'countFire' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 4])->where(['ohse' => user_id()])->countAllResults(),
            ];
        } elseif (in_groups('ERT')) {
            $data = [
                'title' => 'Home',
                'countPintu' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 1])->where(['ketua_ert' => user_id()])->countAllResults(),
                'countHydrant' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 2])->where(['ketua_ert' => user_id()])->countAllResults(),
                'countSmoke' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 3])->where(['ketua_ert' => user_id()])->countAllResults(),
                'countFire' => $this->db->table('izin_fasilitas')->where(['id_kategori' => 4])->where(['ketua_ert' => user_id()])->countAllResults(),
            ];
        } elseif (in_groups('admin')) {
            $data = [
                'title' => 'Home',
                'countPintu' => $this->pintuModel->getCountPintu(),
                'countHydrant' => $this->hydrantModel->getCountHydrant(),
                'countSmoke' => $this->smokeModel->getCountSmoke(),
                'countFire' => $this->fireModel->getCountFire(),
            ];
        }




        return view('home', $data);
    }

    public function export()
    {
        $this->builder = $this->db->table('izin_fasilitas');

        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
        $creator = $this->request->getVar('creator');
        $pic = $this->request->getVar('pic');
        $eng = $this->request->getVar('eng');
        $users = $this->request->getVar('users');
        $lokasi = $this->request->getVar('lokasi');


        if ($month && $year && $creator) {

            $query = $this->db->table('izin_fasilitas')->select('izin_fasilitas.*, lokasi.nama_lokasi, users.fullname, kategori.nama_kategori')->join('users', 'users.id = izin_fasilitas.pembuat')->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi')->join('kategori', 'kategori.id = izin_fasilitas.id_kategori')->where('MONTH(izin_fasilitas.created_at)', $month)->where('YEAR(izin_fasilitas.created_at)', $year)->where(['pembuat' => $creator])->get();
        } elseif ($month && $year && $pic) {

            $query = $this->db->table('izin_fasilitas')->select('izin_fasilitas.*, lokasi.nama_lokasi, users.fullname, kategori.nama_kategori')->join('users', 'users.id = izin_fasilitas.pembuat')->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi')->join('kategori', 'kategori.id = izin_fasilitas.id_kategori')->where('MONTH(izin_fasilitas.created_at)', $month)->where('YEAR(izin_fasilitas.created_at)', $year)->where(['izin_fasilitas.PIC' => $pic])->orwhere(['PIC_2' => $pic])->orwhere(['PIC_3' => $pic])->get();
        } elseif ($month && $year && $eng) {

            $query = $this->db->table('izin_fasilitas')->select('izin_fasilitas.*, lokasi.nama_lokasi, users.fullname, kategori.nama_kategori')->join('users', 'users.id = izin_fasilitas.pembuat')->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi')->join('kategori', 'kategori.id = izin_fasilitas.id_kategori')->where('MONTH(izin_fasilitas.created_at)', $month)->where('YEAR(izin_fasilitas.created_at)', $year)->where(['izin_fasilitas.engineer' => $eng])->get();
        } elseif ($month && $year && $users) {

            $query = $this->db->table('izin_fasilitas')->select('izin_fasilitas.*, lokasi.nama_lokasi, users.fullname, kategori.nama_kategori')->join('users', 'users.id = izin_fasilitas.pembuat')->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi')->join('kategori', 'kategori.id = izin_fasilitas.id_kategori')->where('MONTH(izin_fasilitas.created_at)', $month)->where('YEAR(izin_fasilitas.created_at)', $year)->where(['izin_fasilitas.ohse' => $users])->orwhere(['izin_fasilitas.ketua_ert' => $users])->get();
        } elseif ($month && $year && $lokasi) {

            $query = $this->db->table('izin_fasilitas')->select('izin_fasilitas.*, lokasi.nama_lokasi, users.fullname, kategori.nama_kategori')->join('users', 'users.id = izin_fasilitas.pembuat')->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi')->join('kategori', 'kategori.id = izin_fasilitas.id_kategori')->where('MONTH(izin_fasilitas.created_at)', $month)->where('YEAR(izin_fasilitas.created_at)', $year)->where(['izin_fasilitas.lokasi' => $lokasi])->orwhere(['izin_fasilitas.lokasi_2' => $lokasi])->orwhere(['izin_fasilitas.lokasi_3' => $lokasi])->get();
        } elseif ($month && $year) {

            $query = $this->db->table('izin_fasilitas')->select('izin_fasilitas.*, lokasi.nama_lokasi, users.fullname, kategori.nama_kategori')->join('users', 'users.id = izin_fasilitas.pembuat')->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi')->join('kategori', 'kategori.id = izin_fasilitas.id_kategori')->where('MONTH(izin_fasilitas.created_at)', $month)->where('YEAR(izin_fasilitas.created_at)', $year)->get();
        } else {
            $query = $this->db->table('izin_fasilitas')->select('izin_fasilitas.*, lokasi.nama_lokasi, users.fullname, kategori.nama_kategori')->join('users', 'users.id = izin_fasilitas.pembuat')->join('kategori', 'kategori.id = izin_fasilitas.id_kategori')->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi')->where('pembuat', user_id())->orwhere('izin_fasilitas.PIC', user_id())->orwhere('PIC_2', user_id())->orwhere('PIC_3', user_id())->orwhere('engineer', user_id())->orwhere('ohse', user_id())->orwhere('ketua_ert', user_id())->get();
        }


        $izin_fasilitas = $query->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kategori');
        $sheet->setCellValue('C1', 'No Registrasi');
        $sheet->setCellValue('D1', 'Lokasi');
        $sheet->setCellValue('E1', 'Waktu Penggunaan');
        $sheet->setCellValue('F1', 'Waktu Non Aktif');
        $sheet->setCellValue('G1', 'Keperluan');
        $sheet->setCellValue('H1', 'Target Waktu');
        $sheet->setCellValue('I1', 'Rencana Antisipasi');
        $sheet->setCellValue('J1', 'Pembuat');
        $sheet->setCellValue('K1', 'Status');
        $sheet->setCellValue('L1', 'Tanggal Dibuat');

        $column = 2;
        foreach ($izin_fasilitas as $izin_fasilitas) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, $izin_fasilitas['nama_kategori']);
            if (stripos($izin_fasilitas['no_registrasi'], 'OHSE') !== FALSE) {     // INI UNTUK CEK KAYAK OPERATOR LIKE YANG ADA DI SQL
                $sheet->setCellValue('C' . $column, $izin_fasilitas['no_registrasi']);
            } else {
                $sheet->setCellValue('C' . $column, 'NA');
            }
            $sheet->setCellValue('D' . $column, $izin_fasilitas['nama_lokasi']);
            $sheet->setCellValue('E' . $column, $izin_fasilitas['waktu_penggunaan']);
            $sheet->setCellValue('F' . $column, $izin_fasilitas['non_aktif']);
            $sheet->setCellValue('G' . $column, $izin_fasilitas['keperluan']);
            $sheet->setCellValue('H' . $column, $izin_fasilitas['target_waktu']);
            $sheet->setCellValue('I' . $column, $izin_fasilitas['rencana_antisipasi']);
            $sheet->setCellValue('J' . $column, $izin_fasilitas['fullname']);
            $sheet->setCellValue('K' . $column, $izin_fasilitas['status']);
            $sheet->setCellValue('L' . $column, $izin_fasilitas['created_at']);
            $column++;
        }

        $sheet->getStyle('A1:O1')->getFont()->setBold(true);
        $sheet->getStyle('A1:O1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('93bd84');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=EXPORT-Izin-Fasilitas.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();

        return redirect(base_url());
    }
}
