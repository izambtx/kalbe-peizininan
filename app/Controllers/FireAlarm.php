<?php

namespace App\Controllers;

use App\Controllers;
use Config\Services;
use Myth\Auth\Entities\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\KategoriModel;
use App\Models\LokasiModel;
use App\Models\FireModel;
use App\Models\FotoIzinModel;
use App\Models\StatusModel;
use App\Models\AktifasiModel;
use App\Models\UsersModel;
use App\Models\ExtendModel;
use App\Models\FotoPEModel;


class FireAlarm extends BaseController
{
    protected $db, $builder, $usersModel;
    protected $kategoriModel;
    protected $lokasiModel;
    protected $fireModel;
    protected $statusModel;
    protected $aktifasiModel;
    protected $extendModel;
    protected $fotopeModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('izin_fasilitas');
        $this->kategoriModel = new KategoriModel();
        $this->lokasiModel = new LokasiModel();
        $this->fireModel = new FireModel();
        $this->statusModel = new StatusModel();
        $this->aktifasiModel = new AktifasiModel();
        $this->usersModel = new UsersModel();
        $this->extendModel = new ExtendModel();
        $this->fotopeModel = new FotoPEModel();
    }

    public function index($id = false)
    {


        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        $lokasi = $this->request->getVar('lokasi');
        $waktu = $this->request->getVar('waktu');
        $pemohon = $this->request->getVar('pemohon');

        if ($pemohon) {

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['ON', 'OFF'];
            $this->builder->whereNotIn('izin_fasilitas.status', $status);
            $this->builder->like('users.username', $pemohon);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['ON', 'OFF'];
            $this->builder->whereNotIn('izin_fasilitas.status', $status);
            $this->builder->like('users.username', $pemohon);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } elseif ($lokasi) {

            $sintak2 = "(izin_fasilitas.lokasi = {$lokasi} OR izin_fasilitas.lokasi_2 = {$lokasi} OR izin_fasilitas.lokasi_3 = {$lokasi})";

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['ON', 'OFF'];
            $this->builder->whereNotIn('izin_fasilitas.status', $status);
            $this->builder->where($sintak2);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['ON', 'OFF'];
            $this->builder->whereNotIn('izin_fasilitas.status', $status);
            $this->builder->where($sintak2);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } elseif ($waktu) {

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['ON', 'OFF'];
            $this->builder->whereNotIn('izin_fasilitas.status', $status);
            $this->builder->like('izin_fasilitas.created_at', $waktu);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['ON', 'OFF'];
            $this->builder->whereNotIn('izin_fasilitas.status', $status);
            $this->builder->like('izin_fasilitas.created_at', $waktu);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } else {

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['ON', 'OFF'];
            $this->builder->whereNotIn('izin_fasilitas.status', $status);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['ON', 'OFF'];
            $this->builder->whereNotIn('izin_fasilitas.status', $status);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        }

        $data = [
            'title' => 'List Izin Akses Fire Alarm',
            'kategori' => $this->kategoriModel->getKategori(),
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage,
            'lokasiNama' => $this->lokasiModel->getLokasi($lokasi),
            'lokasi' => $this->lokasiModel->getLokasi(),
            'selectedLokasi' => $lokasi,
            'selectedPemohon' => $pemohon,
            'selectedWaktu' => $waktu,
        ];

        $data['pintu'] = $query->getResultArray();

        return view('/IzinFasilitas/List/ListFireAlarm', $data);
    }

    public function detail($id = false)
    {

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
        $query = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.PIC');
        $this->builder->join('lokasi', 'lokasi.id = users.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $query2 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.engineer');
        $this->builder->join('lokasi', 'lokasi.id = users.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $query3 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.ohse');
        $this->builder->join('lokasi', 'lokasi.id = users.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $query4 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.ketua_ert');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $query5 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi_2');
        $this->builder->where('izin_fasilitas.id', $id);
        $query6 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi_3');
        $this->builder->where('izin_fasilitas.id', $id);
        $query7 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.PIC_2');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi_2');
        $this->builder->where('izin_fasilitas.id', $id);
        $query8 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.PIC_3');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi_3');
        $this->builder->where('izin_fasilitas.id', $id);
        $query9 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.returner');
        $this->builder->where('izin_fasilitas.id', $id);
        $query10 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.rejecter');
        $this->builder->where('izin_fasilitas.id', $id);
        $query11 = $this->builder->get();

        $data = [
            'title' => 'Detail Izin Akses Fire Alarm',
            'kategori' => $this->kategoriModel->getKategori(),
            'foto_izin' => $this->db->table('foto_izin_fasilitas')->getWhere(['id_izin' => $id])->getResultArray(),
            'extend_izin' => $this->db->table('extend_izin')->getWhere(['id_izin' => $id])->getRowArray(),
            'lokasi' => $this->lokasiModel->getLokasi()
        ];

        $data['pintu'] = $query->getRowArray();
        $data['pintu2'] = $query2->getRowArray();
        $data['pintu3'] = $query3->getRowArray();
        $data['pintu4'] = $query4->getRowArray();
        $data['pintu5'] = $query5->getRowArray();
        $data['lokasi2'] = $query6->getRowArray();
        $data['lokasi3'] = $query7->getRowArray();
        $data['pintu6'] = $query8->getRowArray();
        $data['pintu7'] = $query9->getRowArray();
        $data['pintu8'] = $query10->getRowArray();
        $data['pintu9'] = $query11->getRowArray();

        return view('/IzinFasilitas/Detail/DetailsFireAlarm', $data);
    }

    public function listPenonAktifan($id = false)
    {


        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        $lokasi = $this->request->getVar('lokasi');
        $waktu = $this->request->getVar('waktu');
        $pemohon = $this->request->getVar('pemohon');

        if ($pemohon) {

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['Approved Ketua ERT', 'OFF', 'ON'];
            $this->builder->whereIn('izin_fasilitas.status', $status);
            $this->builder->like('users.username', $pemohon);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['Approved Ketua ERT', 'OFF', 'ON'];
            $this->builder->whereIn('izin_fasilitas.status', $status);
            $this->builder->like('users.username', $pemohon);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } elseif ($lokasi) {

            $sintak2 = "(izin_fasilitas.lokasi = {$lokasi} OR izin_fasilitas.lokasi_2 = {$lokasi} OR izin_fasilitas.lokasi_3 = {$lokasi})";

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['Approved Ketua ERT', 'OFF', 'ON'];
            $this->builder->whereIn('izin_fasilitas.status', $status);
            $this->builder->where($sintak2);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['Approved Ketua ERT', 'OFF', 'ON'];
            $this->builder->whereIn('izin_fasilitas.status', $status);
            $this->builder->where($sintak2);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } elseif ($waktu) {

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['Approved Ketua ERT', 'OFF', 'ON'];
            $this->builder->whereIn('izin_fasilitas.status', $status);
            $this->builder->like('izin_fasilitas.created_at', $waktu);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['Approved Ketua ERT', 'OFF', 'ON'];
            $this->builder->whereIn('izin_fasilitas.status', $status);
            $this->builder->like('izin_fasilitas.created_at', $waktu);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } else {

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['Approved Ketua ERT', 'OFF', 'ON'];
            $this->builder->whereIn('izin_fasilitas.status', $status);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.pembuat', user()->id);
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $status = ['Approved Ketua ERT', 'OFF', 'ON'];
            $this->builder->whereIn('izin_fasilitas.status', $status);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        }

        $data = [
            'title' => 'List Penon-aktifan Akses Fire Alarm',
            'kategori' => $this->kategoriModel->getKategori(),
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage,
            'lokasiNama' => $this->lokasiModel->getLokasi($lokasi),
            'lokasi' => $this->lokasiModel->getLokasi(),
            'selectedLokasi' => $lokasi,
            'selectedPemohon' => $pemohon,
            'selectedWaktu' => $waktu,
        ];

        $data['pintu'] = $query->getResultArray();

        return view('/IzinFasilitas/List/PenonAktifanFireAlarm', $data);
    }

    public function create($id = false)
    {
        $data = [
            'title' => 'Create Izin Akses Fire Alarm',
            'kategori' => $this->kategoriModel->getKategori(),
            'inputFotoPE' => $this->request->getVar('jumlahFoto'),
            'countRegNo' => $this->fireModel->getRegNoFire(),
            'lokasi' => $this->lokasiModel->getLokasi()
        ];

        return view('/IzinFasilitas/FormInput/CreateFireAlarm', $data);
    }

    public function save($id = false)
    {

        // VALIDASI INPUT
        if (!$this->validate([
            // 'titik' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'harap isi jumlah lokasi {field}nya terlebih dahulu.'
            //     ]
            // ],
            'penggunaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi waktu {field}nya terlebih dahulu.'
                ]
            ],
            'nonaktif' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi waktu pe{field}nya terlebih dahulu.'
                ]
            ],
            'keperluan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ],
            'target' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ],
            'rencana' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field} antisipasinya terlebih dahulu.'
                ]
            ],
            'lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi belum dipilih.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/IzinFasilitas/FireAlarm/CreateIzin')->withInput()->with('validation', $validation);
        }

        $this->fireModel->save([
            'id_kategori' => 4,
            'lokasi' => $this->request->getVar('lokasi'),
            'lokasi_2' => $this->request->getVar('lokasi_2'),
            'lokasi_3' => $this->request->getVar('lokasi_3'),
            'jumlah_titik' => $this->request->getVar('titik'),
            'waktu_penggunaan' => $this->request->getVar('penggunaan'),
            'non_aktif' => $this->request->getVar('nonaktif'),
            'keperluan' => $this->request->getVar('keperluan'),
            'target_waktu' => $this->request->getVar('target'),
            'rencana_antisipasi' => $this->request->getVar('rencana'),
            'status' => 'Created',
            'pembuat' => user_id()
        ]);

        $id_izin = $this->fireModel->getInsertID();

        $this->statusModel->save([
            'id_izin' => $id_izin,
            'status' => 'Created',
            'id_user' => user_id()
        ]);

        $jumlahFotonya = $this->request->getVar('jumlahFileFoto');

        // ambil gambar
        for ($i = 1; $i <= $jumlahFotonya; $i++) {
            $fileFoto[$i] = $this->request->getFile('foto_sebelum' . $i); //ini pake foto_sebelum karena name di inputnya emg gitu biar nyambung sama JS nya juga

            // apakah tidak ada gambar yang diupload
            if ($fileFoto[$i]->getError() == 4) {
                $namaFoto[$i] = 'default.jpg';
            } else {
                // pindahkan file ke folder img
                $fileFoto[$i]->move('img');
                // ambil nama file foto
                $namaFoto[$i] = $fileFoto[$i]->getName();
            }
        }

        for ($x = 1; $x <= $jumlahFotonya; $x++) {

            $keterangan = $this->request->getVar('ket_foto' . $x);
            $pembuat = user_id();
            $data = [
                'id_kategori' => '4',
                'id_izin' => $id_izin,
                'nama_foto'  => $namaFoto[$x],
                'keterangan'  => $keterangan,
                'pembuat'  => $pembuat
            ];
            $this->fotopeModel->save($data);
        }

        return redirect()->to('/IzinFasilitas/FireAlarm')->with('pesan', 'Izin Berhasil Ditambahkan');
    }

    public function edit($id = false)
    {
        $data = [
            'title' => 'Edit Izin Akses Fire Alarm',
            'kategori' => $this->kategoriModel->getKategori(),
            'inputFotoPE' => $this->request->getVar('jumlahFoto'),
            'fotoPE' => $this->fotopeModel->getFotoPe($id),
            'countFotoPE' => $this->fotopeModel->getCountFotoPe($id),
            'countRegNo' => $this->fireModel->getRegNoFire(),
            'pintu' => $this->fireModel->getFire($id),
            'lokasi' => $this->lokasiModel->getLokasi()
        ];

        return view('/IzinFasilitas/FormInput/EditFireAlarm', $data);
    }

    public function update($id = false)
    {

        // VALIDASI INPUT
        if (!$this->validate([
            'titik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi jumlah lokasi {field}nya terlebih dahulu.'
                ]
            ],
            'penggunaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi waktu {field}nya terlebih dahulu.'
                ]
            ],
            'nonaktif' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi waktu pe{field}nya terlebih dahulu.'
                ]
            ],
            'keperluan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ],
            'target' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field}nya terlebih dahulu.'
                ]
            ],
            'rencana' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi {field} antisipasinya terlebih dahulu.'
                ]
            ],
            'lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi belum dipilih.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/IzinFasilitas/FireAlarm/EditIzin')->withInput()->with('validation', $validation);
        }

        $this->fireModel->save([
            'id' => $id,
            'id_kategori' => 4,
            'lokasi' => $this->request->getVar('lokasi'),
            'lokasi_2' => $this->request->getVar('lokasi_2'),
            'lokasi_3' => $this->request->getVar('lokasi_3'),
            'jumlah_titik' => $this->request->getVar('titik'),
            'waktu_penggunaan' => $this->request->getVar('penggunaan'),
            'non_aktif' => $this->request->getVar('nonaktif'),
            'keperluan' => $this->request->getVar('keperluan'),
            'target_waktu' => $this->request->getVar('target'),
            'rencana_antisipasi' => $this->request->getVar('rencana'),
            'status' => 'Updated',
            'revisi' => $this->request->getVar('revisi'),
            'pembuat' => user_id()
        ]);

        $id_izin = $this->fireModel->getInsertID();

        $this->statusModel->save([
            'id_izin' => $id,
            'status' => 'Updated',
            'id_user' => user_id()
        ]);

        $jumlahFotonya = $this->request->getVar('jumlahFileFoto');

        // ambil gambar
        for ($i = 1; $i <= $jumlahFotonya; $i++) {
            $fileFoto[$i] = $this->request->getFile('foto_sebelum' . $i); //ini pake foto_sebelum karena name di inputnya emg gitu biar nyambung sama JS nya juga

            // apakah tidak ada gambar yang diupload
            if ($fileFoto[$i]->getError() == 4) {
                $namaFoto[$i] = 'default.jpg';
            } else {
                // pindahkan file ke folder img
                $fileFoto[$i]->move('img');
                // ambil nama file foto
                $namaFoto[$i] = $fileFoto[$i]->getName();
            }
        }

        for ($x = 1; $x <= $jumlahFotonya; $x++) {

            $keterangan = $this->request->getVar('ket_foto' . $x);
            $pembuat = user_id();
            $data = [
                'id_kategori' => '4',
                'id_izin' => $id_izin,
                'nama_foto'  => $namaFoto[$x],
                'keterangan'  => $keterangan,
                'pembuat'  => $pembuat
            ];
            $this->fotopeModel->save($data);
        }

        return redirect()->to('/IzinFasilitas/FireAlarm')->with('pesan', 'Izin Berhasil Diupdate');
    }

    public function detailPenonAktifan($id = false)
    {

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
        $query = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.PIC');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $query2 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.engineer');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $query3 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.ohse');
        $this->builder->join('lokasi', 'lokasi.id = users.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $query4 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.ketua_ert');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $query5 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.PIC_2');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi_2');
        $this->builder->where('izin_fasilitas.id', $id);
        $query6 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.PIC_3');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi_3');
        $this->builder->where('izin_fasilitas.id', $id);
        $query7 = $this->builder->get();

        $data = [
            'title' => 'Detail Penon-aktifan Akses Fire Alarm',
            'kategori' => $this->kategoriModel->getKategori(),
            'foto_izin' => $this->db->table('foto_izin_fasilitas')->getWhere(['id_izin' => $id])->getResultArray(),
            'aktifasi_on' => $this->aktifasiModel->getUserAktifasi($id),
            'aktifasi_pic' => $this->aktifasiModel->getUserAktifasi2($id),
            'aktifasi_eng' => $this->aktifasiModel->getUserAktifasi3($id),
            'aktifasi_ert' => $this->aktifasiModel->getUserAktifasi4($id),
            'aktifasi_off' => $this->aktifasiModel->getUserAktifasi5($id),
            'aktifasi_izin' => $this->aktifasiModel->getAktifasi($id),
            'lokasi' => $this->lokasiModel->getLokasi()
        ];

        $data['pintu'] = $query->getRowArray();
        $data['pintu2'] = $query2->getRowArray();
        $data['pintu3'] = $query3->getRowArray();
        $data['pintu4'] = $query4->getRowArray();
        $data['pintu5'] = $query5->getRowArray();
        $data['lokasi2'] = $query6->getRowArray();
        $data['lokasi3'] = $query7->getRowArray();

        return view('/IzinFasilitas/Detail/DetailsAktifFireAlarm', $data);
    }

    public function nonAktif($id)
    {

        // VALIDASI INPUT
        if (!$this->validate([
            'off_at' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap submit waktu penon-aktifannya terlebih dahulu.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/PenonAktifanFasilitas/FireAlarm/Details/' . $id)->withInput()->with('validation', $validation);
        }
        // dd($this->request->getVar('note_off'));
        $this->aktifasiModel->save([
            // 'id_izin' => $id,
            'id' => $this->request->getVar('id_aktifasi'),
            'off_by' => user_id(),
            'off_at' => date('Y-m-d H:i:s'),
            'note_off' => $this->request->getVar('note_off'),
        ]);

        $this->fireModel->save([
            'id' => $id,
            'status' => 'OFF',
            'aktif' => 0
        ]);

        $this->statusModel->save([
            'id_izin' => $id,
            'status' => 'OFF',
            'id_user' => user_id()
        ]);

        return redirect()->to('/PenonAktifanFasilitas/FireAlarm/Details/' . $id)->with('pesan', 'Fasilitas Telah Di Non-aktifkan');
    }

    public function Aktif($id)
    {
        // dd($id);

        $id_izin = $this->request->getVar('id_izin');

        // VALIDASI INPUT
        if (!$this->validate([
            'on_at' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap submit waktu pengaktifannya terlebih dahulu.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/PenonAktifanFasilitas/FireAlarm/Details/' . $id_izin)->withInput()->with('validation', $validation);
        }

        $this->aktifasiModel->save([
            'id' => $id,
            'on_by' => user_id(),
            'on_at' => date('Y-m-d H:i:s'),
            'note_on' => $this->request->getVar('note_on')
        ]);

        return redirect()->to('/PenonAktifanFasilitas/FireAlarm/Details/' . $id_izin)->with('pesan', 'Fasilitas Telah Di Aktifkan Kembali');
    }

    public function request($id)
    {

        $this->extendModel->save([
            'id_izin' => $id,
            'date_request' => $this->request->getVar('request'),
            'alasan' => $this->request->getVar('alasan'),
            'pembuat' => user_id(),
            'extend' => 0
        ]);
        return redirect()->to('/IzinFasilitas/FireAlarm/Details/' . $id)->with('pesan', 'Permohonan Extend Izin Berhasil Diapprove');
    }

    // ======================================= APPROVER =============================================
    // ======================================= APPROVER =============================================
    // ======================================= APPROVER =============================================
    // ======================================= APPROVER =============================================
    // ======================================= APPROVER =============================================
    // ======================================= APPROVER =============================================
    // ======================================= APPROVER =============================================
    // ======================================= APPROVER =============================================
    // ======================================= APPROVER =============================================
    // ======================================= APPROVER =============================================

    public function listApprover($id = false)
    {


        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        $lokasi = $this->request->getVar('lokasi');
        $waktu = $this->request->getVar('waktu');
        $pemohon = $this->request->getVar('pemohon');

        if (in_groups('OHSE')) {

            if ($pemohon) {

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $status = ['Approved PIC', 'Approved PIC 2', 'Approved PIC 3', 'Approved OHSE', 'Approved Engineer', 'Created', 'Returned'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.evaluated_at', null);
                $this->builder->like('users.username', $pemohon);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $status = ['Approved PIC', 'Approved PIC 2', 'Approved PIC 3', 'Approved OHSE', 'Approved Engineer', 'Created', 'Returned'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.evaluated_at', null);
                $this->builder->like('users.username', $pemohon);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($lokasi) {

                $sintak2 = "(izin_fasilitas.lokasi = {$lokasi} OR izin_fasilitas.lokasi_2 = {$lokasi} OR izin_fasilitas.lokasi_3 = {$lokasi})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $status = ['Approved PIC', 'Approved PIC 2', 'Approved PIC 3', 'Approved OHSE', 'Approved Engineer', 'Created', 'Returned'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.evaluated_at', null);
                $this->builder->where($sintak2);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $status = ['Approved PIC', 'Approved PIC 2', 'Approved PIC 3', 'Approved OHSE', 'Approved Engineer', 'Created', 'Returned'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.evaluated_at', null);
                $this->builder->where($sintak2);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($waktu) {

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $status = ['Approved PIC', 'Approved PIC 2', 'Approved PIC 3', 'Approved OHSE', 'Approved Engineer', 'Created', 'Returned'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.evaluated_at', null);
                $this->builder->Like('izin_fasilitas.created_at', $waktu);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $status = ['Approved PIC', 'Approved PIC 2', 'Approved PIC 3', 'Approved OHSE', 'Approved Engineer', 'Created', 'Returned'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.evaluated_at', null);
                $this->builder->Like('izin_fasilitas.created_at', $waktu);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $status = ['Approved PIC', 'Approved PIC 2', 'Approved PIC 3', 'Approved OHSE', 'Approved Engineer', 'Created', 'Returned'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.evaluated_at', null);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $status = ['Approved PIC', 'Approved PIC 2', 'Approved PIC 3', 'Approved OHSE', 'Approved Engineer', 'Created', 'Returned'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.evaluated_at', null);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
        } elseif (in_groups('ERT')) {

            if ($pemohon) {

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.status', 'Approved Spv/Mgr');
                $this->builder->where('izin_fasilitas.agreed_at', null);
                $this->builder->like('users.username', $pemohon);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.status', 'Approved Spv/Mgr');
                $this->builder->where('izin_fasilitas.agreed_at', null);
                $this->builder->like('users.username', $pemohon);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($lokasi) {

                $sintak2 = "(izin_fasilitas.lokasi = {$lokasi} OR izin_fasilitas.lokasi_2 = {$lokasi} OR izin_fasilitas.lokasi_3 = {$lokasi})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.status', 'Approved Spv/Mgr');
                $this->builder->where('izin_fasilitas.agreed_at', null);
                $this->builder->where($sintak2);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.status', 'Approved Spv/Mgr');
                $this->builder->where('izin_fasilitas.agreed_at', null);
                $this->builder->where($sintak2);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($waktu) {

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.status', 'Approved Spv/Mgr');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.agreed_at', null);
                $this->builder->like('izin_fasilitas.created_at', $waktu);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.status', 'Approved Spv/Mgr');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.agreed_at', null);
                $this->builder->like('izin_fasilitas.created_at', $waktu);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.status', 'Approved Spv/Mgr');
                $this->builder->where('izin_fasilitas.agreed_at', null);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.status', 'Approved Spv/Mgr');
                $this->builder->where('izin_fasilitas.agreed_at', null);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }

            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
        } elseif (in_groups('engineer')) {

            if ($pemohon) {

                $userLokasi = user()->lokasi;
                $sintak = "(izin_fasilitas.lokasi = {$userLokasi} OR izin_fasilitas.lokasi_2 = {$userLokasi} OR izin_fasilitas.lokasi_3 = {$userLokasi})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $status = ['Approved Ketua ERT', 'OFF', 'ON', 'Returned PIC', 'Returned PIC 2', 'Returned PIC 3', 'Returned Engineer', 'Returned OHSE', 'Returned ERT'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.checked_at', null);
                $this->builder->like('users.username', $pemohon);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $status = ['Approved Ketua ERT', 'OFF', 'ON', 'Returned PIC', 'Returned PIC 2', 'Returned PIC 3', 'Returned Engineer', 'Returned OHSE', 'Returned ERT'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.checked_at', null);
                $this->builder->like('users.username', $pemohon);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($lokasi) {

                $sintak2 = "(izin_fasilitas.lokasi = {$lokasi} OR izin_fasilitas.lokasi_2 = {$lokasi} OR izin_fasilitas.lokasi_3 = {$lokasi})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $status = ['Approved Ketua ERT', 'OFF', 'ON', 'Returned PIC', 'Returned PIC 2', 'Returned PIC 3', 'Returned Engineer', 'Returned OHSE', 'Returned ERT'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.checked_at', null);
                $this->builder->where($sintak2);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $status = ['Approved Ketua ERT', 'OFF', 'ON', 'Returned PIC', 'Returned PIC 2', 'Returned PIC 3', 'Returned Engineer', 'Returned OHSE', 'Returned ERT'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.checked_at', null);
                $this->builder->where($sintak2);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($waktu) {

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $status = ['Approved Ketua ERT', 'OFF', 'ON', 'Returned PIC', 'Returned PIC 2', 'Returned PIC 3', 'Returned Engineer', 'Returned OHSE', 'Returned ERT'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.checked_at', null);
                $this->builder->like('izin_fasilitas.waktu_penggunaan', $waktu);
                $this->builder->orLike('izin_fasilitas.non_aktif', $waktu);
                $this->builder->orLike('izin_fasilitas.created_at', $waktu);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $status = ['Approved Ketua ERT', 'OFF', 'ON', 'Returned PIC', 'Returned PIC 2', 'Returned PIC 3', 'Returned Engineer', 'Returned OHSE', 'Returned ERT'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.checked_at', null);
                $this->builder->like('izin_fasilitas.waktu_penggunaan', $waktu);
                $this->builder->orLike('izin_fasilitas.non_aktif', $waktu);
                $this->builder->orLike('izin_fasilitas.created_at', $waktu);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $status = ['Approved Ketua ERT', 'OFF', 'ON', 'Returned PIC', 'Returned PIC 2', 'Returned PIC 3', 'Returned Engineer', 'Returned OHSE', 'Returned ERT'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.checked_at', null);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $status = ['Approved Ketua ERT', 'OFF', 'ON', 'Returned PIC', 'Returned PIC 2', 'Returned PIC 3', 'Returned Engineer', 'Returned OHSE', 'Returned ERT'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.checked_at', null);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }

            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
            // =========================================================================================
        } elseif (in_groups('manager')) {

            if ($pemohon) {

                $userLokasi = user()->lokasi;
                $sintak = "(izin_fasilitas.lokasi = {$userLokasi} OR izin_fasilitas.lokasi_2 = {$userLokasi} OR izin_fasilitas.lokasi_3 = {$userLokasi})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak);
                $this->builder->like('users.username', $pemohon);
                $status = ['Approved Ketua ERT', 'OFF', 'ON'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak);
                $this->builder->like('users.username', $pemohon);
                $status = ['Approved Ketua ERT', 'OFF', 'ON'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($lokasi) {

                $userLokasi = user()->lokasi;
                $sintak = "(izin_fasilitas.lokasi = {$userLokasi} OR izin_fasilitas.lokasi_2 = {$userLokasi} OR izin_fasilitas.lokasi_3 = {$userLokasi})";
                $sintak2 = "(izin_fasilitas.lokasi = {$lokasi} OR izin_fasilitas.lokasi_2 = {$lokasi} OR izin_fasilitas.lokasi_3 = {$lokasi})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak);
                $this->builder->where($sintak2);
                $status = ['Approved Ketua ERT', 'OFF', 'ON'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak);
                $this->builder->where($sintak2);
                $status = ['Approved Ketua ERT', 'OFF', 'ON'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($waktu) {

                $userLokasi = user()->lokasi;
                $waktuEnd = date('Y-m-d', strtotime("+1 day", strtotime($waktu)));
                // dd($waktuEnd);
                $sintak = "(izin_fasilitas.lokasi = {$userLokasi} OR izin_fasilitas.lokasi_2 = {$userLokasi} OR izin_fasilitas.lokasi_3 = {$userLokasi})";
                $sintak2 = "(izin_fasilitas.waktu_penggunaan BETWEEN {$waktu} AND {$waktuEnd}) OR (izin_fasilitas.non_aktif BETWEEN {$waktu} AND {$waktuEnd}) OR (izin_fasilitas.created_at BETWEEN {$waktu} AND {$waktuEnd})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak);
                $this->builder->like('izin_fasilitas.created_at', $waktu);
                $status = ['Approved Ketua ERT', 'OFF', 'ON'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak);
                $this->builder->like('izin_fasilitas.created_at', $waktu);
                $status = ['Approved Ketua ERT', 'OFF', 'ON'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {

                $userLokasi = user()->lokasi;
                $sintak = "(izin_fasilitas.lokasi = {$userLokasi} OR izin_fasilitas.lokasi_2 = {$userLokasi} OR izin_fasilitas.lokasi_3 = {$userLokasi})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak);
                $status = ['Approved Ketua ERT', 'OFF', 'ON'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak);
                $status = ['Approved Ketua ERT', 'OFF', 'ON'];
                $this->builder->whereNotIn('izin_fasilitas.status', $status);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        }

        $data = [
            'title' => 'List Izin Akses Fire Alarm',
            'kategori' => $this->kategoriModel->getKategori(),
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage,
            'lokasiNama' => $this->lokasiModel->getLokasi($lokasi),
            'lokasi' => $this->lokasiModel->getLokasi(),
            'selectedLokasi' => $lokasi,
            'selectedPemohon' => $pemohon,
            'selectedWaktu' => $waktu,
        ];

        $data['pintu'] = $query->getResultArray();

        return view('/ApproveFasilitas/List/ListFireAlarm', $data);
    }

    public function detailApprover($id = false)
    {

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
        $query = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.PIC');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $query2 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.engineer');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $query3 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.ohse');
        $this->builder->join('lokasi', 'lokasi.id = users.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $query4 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.ketua_ert');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $query5 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi_2');
        $this->builder->where('izin_fasilitas.id', $id);
        $query6 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi_3');
        $this->builder->where('izin_fasilitas.id', $id);
        $query7 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.PIC_2');
        $this->builder->join('lokasi', 'lokasi.id = users.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $query8 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.PIC_3');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $query9 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.returner');
        $this->builder->where('izin_fasilitas.id', $id);
        $query10 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.rejecter');
        $this->builder->where('izin_fasilitas.id', $id);
        $query11 = $this->builder->get();

        // $this->builder->select('auth_groups.name');
        // $this->builder->join('users', 'users.id = auth_groups_users.user_id');
        // $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        // $query5 = $this->builder->get();

        $data = [
            'title' => 'Detail Izin Akses Fire Alarm',
            'kategori' => $this->kategoriModel->getKategori(),
            'noReg' => $this->fireModel->getRegNoFire(),
            // 'userGroups' => $this->usersModel->getGroups(),
            'detail_status' => $this->statusModel->getStatus($id),
            'aktifasi_on' => $this->aktifasiModel->getUserAktifasi($id),
            'aktifasi_pic' => $this->aktifasiModel->getUserAktifasi2($id),
            'aktifasi_eng' => $this->aktifasiModel->getUserAktifasi3($id),
            'aktifasi_ert' => $this->aktifasiModel->getUserAktifasi4($id),
            'aktifasi_off' => $this->aktifasiModel->getUserAktifasi5($id),
            'aktifasi_izin' => $this->aktifasiModel->getAktifasi($id),
            'foto_izin' => $this->db->table('foto_izin_fasilitas')->getWhere(['id_izin' => $id])->getResultArray(),
            'lokasi' => $this->lokasiModel->getLokasi(),
            'picLokasi' => $this->lokasiModel->getPicLokasi()
        ];

        $data['pintu'] = $query->getRowArray();
        $data['pintu2'] = $query2->getRowArray();
        $data['pintu3'] = $query3->getRowArray();
        $data['pintu4'] = $query4->getRowArray();
        $data['pintu5'] = $query5->getRowArray();
        $data['lokasi2'] = $query6->getRowArray();
        $data['lokasi3'] = $query7->getRowArray();
        $data['pintu6'] = $query8->getRowArray();
        $data['pintu7'] = $query9->getRowArray();
        $data['pintu8'] = $query10->getRowArray();
        $data['pintu9'] = $query11->getRowArray();
        // $data['userGroups'] = $query5->getRowArray();

        return view('/ApproveFasilitas/Detail/DetailsFireAlarm', $data);
    }

    public function approve($id)
    {

        $this->fireModel->save([
            'id' => $id,
            'PIC' => user()->id,
            'status' => $this->request->getVar('status'),
            'approved_at' => date('Y-m-d H:i:s')
        ]);

        $this->statusModel->save([
            'id_izin' => $id,
            'status' => 'Approved PIC',
            'id_user' => user_id()
        ]);
        return redirect()->to('/HistoryFasilitas/FireAlarm')->with('pesan', 'Izin Berhasil Diapprove');
    }

    public function approve2($id)
    {

        $this->fireModel->save([
            'id' => $id,
            'PIC_2' => user()->id,
            'status' => $this->request->getVar('status'),
            'approved_at_2' => date('Y-m-d H:i:s')
        ]);

        $this->statusModel->save([
            'id_izin' => $id,
            'status' => 'Approved PIC 2',
            'id_user' => user_id()
        ]);
        return redirect()->to('/HistoryFasilitas/FireAlarm')->with('pesan', 'Izin Berhasil Diapprove');
    }

    public function approve3($id)
    {

        $this->fireModel->save([
            'id' => $id,
            'PIC_3' => user()->id,
            'status' => $this->request->getVar('status'),
            'approved_at_3' => date('Y-m-d H:i:s')
        ]);

        $this->statusModel->save([
            'id_izin' => $id,
            'status' => 'Approved PIC 3',
            'id_user' => user_id()
        ]);
        return redirect()->to('/HistoryFasilitas/FireAlarm')->with('pesan', 'Izin Berhasil Diapprove');
    }

    public function engineer($id)
    {
        // dd($this->request->getVar());
        $this->fireModel->save([
            'id' => $id,
            'engineer' => user_id(),
            'status' => $this->request->getVar('status'),
            'checked_at' => date('Y-m-d H:i:s')
        ]);

        $this->statusModel->save([
            'id_izin' => $id,
            'status' => 'Approved Engineer',
            'id_user' => user_id()
        ]);
        return redirect()->to('/HistoryFasilitas/FireAlarm')->with('pesan', 'Izin Berhasil Diapprove');
    }

    public function ohse($id)
    {

        $noReg = $this->request->getVar('sdwi');
        $noReg_no = "NA";
        if ($noReg == 'NA' || $noReg == 'na' || $noReg == '' || $noReg == ' ' || $noReg == 'tidak ada' || $noReg == 'Tidak Ada' || $noReg == 'Tidak ada') {
            $noReg_no == 'NA';
        } else {
            $noReg_no = $noReg;
        }

        // dd($noReg_no);

        $this->fireModel->save([
            'id' => $id,
            'ohse' => user()->id,
            'status' => $this->request->getVar('status'),
            'no_registrasi' => $this->request->getVar('noReg'),
            'evaluated_at' => date('Y-m-d H:i:s')
        ]);

        $this->statusModel->save([
            'id_izin' => $id,
            'status' => 'Approved OHSE',
            'id_user' => user()->id
        ]);
        return redirect()->to('/HistoryFasilitas/FireAlarm')->with('pesan', 'Izin Berhasil Diapprove');
    }

    public function ERT($id)
    {
        // dd($this->request->getVar());
        $this->fireModel->save([
            'id' => $id,
            'ketua_ert' => user_id(),
            'status' => 'Approved Ketua ERT',
            'agreed_at' => date('Y-m-d H:i:s')
        ]);

        $this->statusModel->save([
            'id_izin' => $id,
            'status' => 'Approved Ketua ERT',
            'id_user' => user_id()
        ]);

        $this->aktifasiModel->save([
            'id_izin' => $id
        ]);
        return redirect()->to('/HistoryFasilitas/FireAlarm')->with('pesan', 'Izin Berhasil Diapprove');
    }

    public function rejected($id)
    {

        $this->fireModel->save([
            'id' => $id,
            'rejecter' => user_id(),
            'alasan' => $this->request->getVar('alasanReject'),
            'status' => $this->request->getVar('statusReject'),
            'rejected_at' => date('Y-m-d H:i:s')
        ]);

        $this->statusModel->save([
            'id_izin' => $id,
            'status' => $this->request->getVar('statusReject'),
            'id_user' => user_id()
        ]);
        return redirect()->to('/HistoryFasilitas/FireAlarm')->with('pesan', 'Izin Berhasil Direject');
    }

    public function returned($id)
    {

        $this->fireModel->save([
            'id' => $id,
            'returner' => user_id(),
            'alasan' => $this->request->getVar('alasanReturn'),
            'status' => $this->request->getVar('statusReturn'),
            'returned_at' => date('Y-m-d H:i:s')
        ]);

        $this->statusModel->save([
            'id_izin' => $id,
            'status' => $this->request->getVar('statusReturn'),
            'id_user' => user_id()
        ]);
        return redirect()->to('/HistoryFasilitas/FireAlarm')->with('pesan', 'Izin Berhasil Direturn');
    }

    public function listPengaktifan($id = false)
    {

        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        $lokasi = $this->request->getVar('lokasi');
        $waktu = $this->request->getVar('waktu');
        $pemohon  = $this->request->getVar('pemohon');

        if (in_groups('OHSE')) {

            if ($pemohon) {

                $userLokasi = user()->lokasi;
                $sintak = "(izin_fasilitas.lokasi = {$userLokasi} OR izin_fasilitas.lokasi_2 = {$userLokasi} OR izin_fasilitas.lokasi_3 = {$userLokasi})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $status = ['OFF', 'ON'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.checked_at', null);
                $this->builder->like('users.username', $pemohon);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $status = ['OFF', 'ON'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.checked_at', null);
                $this->builder->like('users.username', $pemohon);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($lokasi) {

                $sintak2 = "(izin_fasilitas.lokasi = {$lokasi} OR izin_fasilitas.lokasi_2 = {$lokasi} OR izin_fasilitas.lokasi_3 = {$lokasi})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $status = ['OFF', 'ON'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->where($sintak2);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $status = ['OFF', 'ON'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->where($sintak2);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($waktu) {

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $status = ['OFF', 'ON'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->like('izin_fasilitas.created_at', $waktu);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $status = ['OFF', 'ON'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->like('izin_fasilitas.created_at', $waktu);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $status = ['OFF', 'ON'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $status = ['OFF', 'ON'];
                $this->builder->whereIn('izin_fasilitas.status', $status);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        } elseif (in_groups('manager')) {

            if ($pemohon) {

                $userLokasi = user()->lokasi;
                $sintak = "(izin_fasilitas.lokasi = {$userLokasi} OR izin_fasilitas.lokasi_2 = {$userLokasi} OR izin_fasilitas.lokasi_3 = {$userLokasi})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->where($sintak);
                $this->builder->like('users.username', $pemohon);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->where($sintak);
                $this->builder->like('users.username', $pemohon);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($lokasi) {

                $userLokasi = user()->lokasi;
                $sintak = "(izin_fasilitas.lokasi = {$userLokasi} OR izin_fasilitas.lokasi_2 = {$userLokasi} OR izin_fasilitas.lokasi_3 = {$userLokasi})";
                $sintak2 = "(izin_fasilitas.lokasi = {$lokasi} OR izin_fasilitas.lokasi_2 = {$lokasi} OR izin_fasilitas.lokasi_3 = {$lokasi})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak);
                $this->builder->where($sintak2);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak);
                $this->builder->where($sintak2);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($waktu) {

                $userLokasi = user()->lokasi;
                $sintak = "(izin_fasilitas.lokasi = {$userLokasi} OR izin_fasilitas.lokasi_2 = {$userLokasi} OR izin_fasilitas.lokasi_3 = {$userLokasi})";
                $sintak2 = "(izin_fasilitas.waktu_penggunaan = {DATE_ADD('$waktu', INTERVAL 1 DAY)} OR izin_fasilitas.non_aktif = {DATE_ADD('$waktu', INTERVAL 1 DAY)} OR izin_fasilitas.created_at = {DATE_ADD('$waktu', INTERVAL 1 DAY)})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak);
                $this->builder->like('izin_fasilitas.created_at', $waktu);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak);
                $this->builder->like('izin_fasilitas.created_at', $waktu);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {

                $userLokasi = user()->lokasi;
                $sintak = "(izin_fasilitas.lokasi = {$userLokasi} OR izin_fasilitas.lokasi_2 = {$userLokasi} OR izin_fasilitas.lokasi_3 = {$userLokasi})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        } else {

            if ($pemohon) {

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->like('users.username', $pemohon);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->like('users.username', $pemohon);
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($lokasi) {

                $sintak2 = "(izin_fasilitas.lokasi = {$lokasi} OR izin_fasilitas.lokasi_2 = {$lokasi} OR izin_fasilitas.lokasi_3 = {$lokasi})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak2);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where($sintak2);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($waktu) {

                $sintak2 = "(izin_fasilitas.waktu_penggunaan = {DATE_ADD('$waktu', INTERVAL 1 DAY)} OR izin_fasilitas.non_aktif = {DATE_ADD('$waktu', INTERVAL 1 DAY)} OR izin_fasilitas.created_at = {DATE_ADD('$waktu', INTERVAL 1 DAY)})";

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->like('izin_fasilitas.created_at', $waktu);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->like('izin_fasilitas.created_at', $waktu);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
                $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
                $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
                $this->builder->where('izin_fasilitas.id_kategori', 4);
                $this->builder->where('izin_fasilitas.status', 'OFF');
                $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        }

        $data = [
            'title' => 'List Pengaktifan Akses Fire Alarm',
            'kategori' => $this->kategoriModel->getKategori(),
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage,
            'lokasi' => $this->lokasiModel->getLokasi(),
            'aktifasi_on' => $this->aktifasiModel->getUserAktifasi($id),
            'aktifasi_pic' => $this->aktifasiModel->getUserAktifasi2($id),
            'aktifasi_eng' => $this->aktifasiModel->getUserAktifasi3($id),
            'aktifasi_ert' => $this->aktifasiModel->getUserAktifasi4($id),
            'aktifasi_off' => $this->aktifasiModel->getUserAktifasi5($id),
            'aktifasi_izin' => $this->aktifasiModel->getAktifasi($id),
            'lokasiNama' => $this->lokasiModel->getLokasi($lokasi),
            'lokasi' => $this->lokasiModel->getLokasi(),
            'selectedLokasi' => $lokasi,
            'selectedPemohon' => $pemohon,
            'selectedWaktu' => $waktu,
        ];

        $data['pintu'] = $query->getResultArray();

        return view('/ApproveFasilitas/List/PengaktifanFireAlarm', $data);
    }

    public function detailPengaktifan($id = false)
    {

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
        $query = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.PIC');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
        $this->builder->where('izin_fasilitas.id', $id);
        $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
        $query2 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.engineer');
        $this->builder->where('izin_fasilitas.id', $id);
        $query3 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.ohse');
        $this->builder->where('izin_fasilitas.id', $id);
        $query4 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.ketua_ert');
        $this->builder->where('izin_fasilitas.id', $id);
        $query5 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.PIC_2');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi_2');
        $this->builder->where('izin_fasilitas.id', $id);
        $query6 = $this->builder->get();

        $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
        $this->builder->join('users', 'users.id = izin_fasilitas.PIC_3');
        $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi_3');
        $this->builder->where('izin_fasilitas.id', $id);
        $query7 = $this->builder->get();

        $data = [
            'title' => 'Detail Pengaktifan Akses Fire Alarm',
            'kategori' => $this->kategoriModel->getKategori(),
            'foto_izin' => $this->db->table('foto_izin_fasilitas')->getWhere(['id_izin' => $id])->getResultArray(),
            'aktifasi_on' => $this->aktifasiModel->getUserAktifasi($id),
            'aktifasi_pic' => $this->aktifasiModel->getUserAktifasi2($id),
            'aktifasi_eng' => $this->aktifasiModel->getUserAktifasi3($id),
            'aktifasi_ert' => $this->aktifasiModel->getUserAktifasi4($id),
            'aktifasi_off' => $this->aktifasiModel->getUserAktifasi5($id),
            'aktifasi_pic_2' => $this->aktifasiModel->getUserAktifasi6($id),
            'aktifasi_pic_3' => $this->aktifasiModel->getUserAktifasi7($id),
            'aktifasi_izin' => $this->aktifasiModel->getAktifasi($id),
            'detail_status' => $this->statusModel->getStatus($id),
            'lokasi' => $this->lokasiModel->getLokasi()
        ];

        $data['pintu'] = $query->getRowArray();
        $data['pintu2'] = $query2->getRowArray();
        $data['pintu3'] = $query3->getRowArray();
        $data['pintu4'] = $query4->getRowArray();
        $data['pintu5'] = $query5->getRowArray();
        $data['lokasi2'] = $query6->getRowArray();
        $data['lokasi3'] = $query7->getRowArray();

        return view('/ApproveFasilitas/Detail/DetailsAktifFireAlarm', $data);
    }

    public function PICPengaktifan($id)
    {
        // dd($this->request->getVar('id_aktifasi'));
        $this->aktifasiModel->save([
            'id' => $this->request->getVar('id_aktifasi'),
            'PIC' => user_id(),
            'approved_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->to('/PengaktifanFasilitas/FireAlarm/Details/' . $id)->with('pesan', 'Izin Pengaktifan Berhasil Diapprove');
    }

    public function PICPengaktifan2($id)
    {
        // dd($this->request->getVar('id_aktifasi'));
        $this->aktifasiModel->save([
            'id' => $this->request->getVar('id_aktifasi'),
            'PIC_2' => user_id(),
            'approved_at_2' => date('Y-m-d H:i:s')
        ]);
        return redirect()->to('/PengaktifanFasilitas/FireAlarm/Details/' . $id)->with('pesan', 'Izin Pengaktifan Berhasil Diapprove');
    }

    public function PICPengaktifan3($id)
    {
        // dd($this->request->getVar('id_aktifasi'));
        $this->aktifasiModel->save([
            'id' => $this->request->getVar('id_aktifasi'),
            'PIC_3' => user_id(),
            'approved_at_3' => date('Y-m-d H:i:s')
        ]);
        return redirect()->to('/PengaktifanFasilitas/FireAlarm/Details/' . $id)->with('pesan', 'Izin Pengaktifan Berhasil Diapprove');
    }

    public function engineerPengaktifan($id)
    {
        $this->aktifasiModel->save([
            'id' => $this->request->getVar('id_aktifasi'),
            'engineer' => user_id(),
            'checked_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->to('/PengaktifanFasilitas/FireAlarm/Details/' . $id)->with('pesan', 'Izin Pengaktifan Berhasil Diapprove');
    }

    public function ERTPengaktifan($id)
    {
        // dd($id);

        $this->aktifasiModel->save([
            'id' => $this->request->getVar('id_aktifasi'),
            'ketua_ert' => user_id(),
            'agreed_at' => date('Y-m-d H:i:s')
        ]);

        $this->fireModel->save([
            'id' => $id,
            'status' => 'ON',
            'aktif' => 1
        ]);
        return redirect()->to('/PengaktifanFasilitas/FireAlarm/Details/' . $id)->with('pesan', 'Izin Pengaktifan Berhasil Diapprove');
    }

    public function listHistory($id = false)
    {


        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        $lokasi = $this->request->getVar('lokasi');
        $waktu = $this->request->getVar('waktu');
        $pemohon  = $this->request->getVar('pemohon');
        $status  = $this->request->getVar('status');

        if ($pemohon) {

            $userID = user()->id;
            $sintak = "(izin_fasilitas.pembuat = {$userID} OR izin_fasilitas.PIC = {$userID} OR izin_fasilitas.PIC_2 = {$userID} OR izin_fasilitas.PIC_3 = {$userID} OR izin_fasilitas.engineer = {$userID} OR izin_fasilitas.ohse = {$userID} OR izin_fasilitas.ketua_ert = {$userID} OR izin_fasilitas.returner = {$userID} OR izin_fasilitas.rejecter = {$userID})";

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->where($sintak);
            $this->builder->like('users.username', $pemohon);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->where($sintak);
            $this->builder->like('users.username', $pemohon);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } elseif ($lokasi) {

            $userID = user()->id;
            $sintak = "(izin_fasilitas.pembuat = {$userID} OR izin_fasilitas.PIC = {$userID} OR izin_fasilitas.PIC_2 = {$userID} OR izin_fasilitas.PIC_3 = {$userID} OR izin_fasilitas.engineer = {$userID} OR izin_fasilitas.ohse = {$userID} OR izin_fasilitas.ketua_ert = {$userID} OR izin_fasilitas.returner = {$userID} OR izin_fasilitas.rejecter = {$userID})";

            $sintak2 = "(izin_fasilitas.lokasi = {$lokasi} OR izin_fasilitas.lokasi_2 = {$lokasi} OR izin_fasilitas.lokasi_3 = {$lokasi})";

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->where($sintak);
            $this->builder->where($sintak2);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->where($sintak);
            $this->builder->where($sintak2);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } elseif ($waktu) {

            $userID = user()->id;
            $sintak = "(izin_fasilitas.pembuat = {$userID} OR izin_fasilitas.PIC = {$userID} OR izin_fasilitas.PIC_2 = {$userID} OR izin_fasilitas.PIC_3 = {$userID} OR izin_fasilitas.engineer = {$userID} OR izin_fasilitas.ohse = {$userID} OR izin_fasilitas.ketua_ert = {$userID} OR izin_fasilitas.returner = {$userID} OR izin_fasilitas.rejecter = {$userID})";

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->where($sintak);
            $this->builder->like('izin_fasilitas.created_at', $waktu);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->where($sintak);
            $this->builder->like('izin_fasilitas.created_at', $waktu);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } elseif ($status) {

            $userID = user()->id;
            $sintak = "(izin_fasilitas.pembuat = {$userID} OR izin_fasilitas.PIC = {$userID} OR izin_fasilitas.PIC_2 = {$userID} OR izin_fasilitas.PIC_3 = {$userID} OR izin_fasilitas.engineer = {$userID} OR izin_fasilitas.ohse = {$userID} OR izin_fasilitas.ketua_ert = {$userID} OR izin_fasilitas.returner = {$userID} OR izin_fasilitas.rejecter = {$userID})";

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->where($sintak);
            $this->builder->where('izin_fasilitas.status', $status);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->where($sintak);
            $this->builder->where('izin_fasilitas.status', $status);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } else {

            $userID = user()->id;
            $sintak = "(izin_fasilitas.pembuat = {$userID} OR izin_fasilitas.PIC = {$userID} OR izin_fasilitas.PIC_2 = {$userID} OR izin_fasilitas.PIC_3 = {$userID} OR izin_fasilitas.engineer = {$userID} OR izin_fasilitas.ohse = {$userID} OR izin_fasilitas.ketua_ert = {$userID} OR izin_fasilitas.returner = {$userID} OR izin_fasilitas.rejecter = {$userID})";

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->where($sintak);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->where($sintak);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        }

        $data = [
            'title' => 'List History Perizinan Fire Alarm',
            'kategori' => $this->kategoriModel->getKategori(),
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage,
            'lokasiNama' => $this->lokasiModel->getLokasi($lokasi),
            'lokasi' => $this->lokasiModel->getLokasi(),
            'selectedLokasi' => $lokasi,
            'selectedPemohon' => $pemohon,
            'selectedWaktu' => $waktu,
            'selectedStatus' => $status,
        ];

        $data['pintu'] = $query->getResultArray();

        return view('/ApproveFasilitas/List/HistoryFireAlarm', $data);
    }

    public function listExtend($id = false)
    {


        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        $lokasi = $this->request->getVar('lokasi');
        $waktu = $this->request->getVar('waktu');
        $pemohon = $this->request->getVar('pemohon');

        if ($pemohon) {

            $sintak2 = "(izin_fasilitas.lokasi = {$lokasi} OR izin_fasilitas.lokasi_2 = {$lokasi} OR izin_fasilitas.lokasi_3 = {$lokasi})";

            $this->builder->select('izin_fasilitas.*, extend_izin.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->join('extend_izin', 'extend_izin.id_izin = izin_fasilitas.id');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->like('users.username', $pemohon);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, extend_izin.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->join('extend_izin', 'extend_izin.id_izin = izin_fasilitas.id');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->like('users.username', $pemohon);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } elseif ($lokasi) {

            $sintak2 = "(izin_fasilitas.lokasi = {$lokasi} OR izin_fasilitas.lokasi_2 = {$lokasi} OR izin_fasilitas.lokasi_3 = {$lokasi})";

            $this->builder->select('izin_fasilitas.*, extend_izin.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->join('extend_izin', 'extend_izin.id_izin = izin_fasilitas.id');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->where($sintak2);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, extend_izin.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->join('extend_izin', 'extend_izin.id_izin = izin_fasilitas.id');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->where($sintak2);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } elseif ($waktu) {

            $this->builder->select('izin_fasilitas.*, extend_izin.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->join('extend_izin', 'extend_izin.id_izin = izin_fasilitas.id');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->like('izin_fasilitas.created_at', $waktu);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('izin_fasilitas.*, extend_izin.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->join('extend_izin', 'extend_izin.id_izin = izin_fasilitas.id');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->like('izin_fasilitas.created_at', $waktu);
            $this->builder->orderBy('izin_fasilitas.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } else {

            $this->builder->select('izin_fasilitas.*, extend_izin.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->join('extend_izin', 'extend_izin.id_izin = izin_fasilitas.id');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->orderBy('extend_izin.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);


            $this->builder->select('izin_fasilitas.*, extend_izin.*, lokasi.nama_lokasi, singkatan, users.username');
            $this->builder->join('users', 'users.id = izin_fasilitas.pembuat');
            $this->builder->join('lokasi', 'lokasi.id = izin_fasilitas.lokasi', 'lokasi.id = users.lokasi');
            $this->builder->join('extend_izin', 'extend_izin.id_izin = izin_fasilitas.id');
            $this->builder->where('izin_fasilitas.id_kategori', 4);
            $this->builder->orderBy('extend_izin.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        }

        $data = [
            'title' => 'List Extended Perizinan Fire Alarm',
            'kategori' => $this->kategoriModel->getKategori(),
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage,
            'lokasiNama' => $this->lokasiModel->getLokasi($lokasi),
            'lokasi' => $this->lokasiModel->getLokasi(),
            'selectedLokasi' => $lokasi,
            'selectedPemohon' => $pemohon,
            'selectedWaktu' => $waktu,
        ];

        $data['pintu'] = $query->getResultArray();

        return view('/ApproveFasilitas/List/ExtendFireAlarm', $data);
    }

    public function extend($id)
    {

        $this->extendModel->save([
            'id' => $id,
            'extend' => 1
        ]);

        $this->fireModel->save([
            'id' => $this->request->getVar('id_izin'),
            'target_waktu' => $this->request->getVar('request')
        ]);

        $this->statusModel->save([
            'id_izin' => $id,
            'status' => 'Extended',
            'id_user' => $this->request->getVar('pembuat')
        ]);
        return redirect()->to('/ExtendFasilitas/FireAlarm')->with('pesan', 'Permohonan Extend Izin Berhasil Diapprove');
    }
}
