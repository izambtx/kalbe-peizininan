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
use App\Models\KategoriModel;

class Users extends BaseController
{
    protected $db, $builder, $usersModel, $email;
    protected $kategoriModel;
    protected $lokasiModel;
    protected $pintuModel;
    protected $hydrantModel;
    protected $smokeModel;
    protected $fireModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->email = \Config\Services::email();
        $this->builder = $this->db->table('users');
        $this->usersModel = new UsersModel();
        $this->lokasiModel = new LokasiModel();
        $this->pintuModel = new PintuModel();
        $this->hydrantModel = new HydrantModel();
        $this->smokeModel = new SmokeModel();
        $this->fireModel = new FireModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index($id = false)
    {

        $lokasi = $this->request->getVar('lokasi');
        $users = $this->request->getVar('users');
        $pic = $this->request->getVar('pic');
        $creator = $this->request->getVar('creator');
        $engineer = $this->request->getVar('eng');
        $kategori = $this->request->getVar('kategori');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
        $data = [
            'title' => 'Dashboard',
            'countPintu' => $this->pintuModel->getCountPintu(),
            'countHydrant' => $this->hydrantModel->getCountHydrant(),
            'countSmoke' => $this->smokeModel->getCountSmoke(),
            'countFire' => $this->fireModel->getCountFire(),
            'lokasiNama' => $this->lokasiModel->getLokasi($lokasi),
            'lokasiList' => $this->lokasiModel->getLokasi(),
            'lokasi' => $lokasi,
            'month' => $month,
            'year' => $year,
            'picNama' => $this->usersModel->getPic($pic),
            'picList' => $this->usersModel->getPic(),
            'pic' => $pic,
            'creatorNama' => $this->usersModel->getPic($creator),
            'creatorList' => $this->usersModel->getPic(),
            'creator' => $creator,
            'engNama' => $this->usersModel->getEngineer($engineer),
            'engList' => $this->usersModel->getEngineer(),
            'eng' => $engineer,
            'usersNama' => $this->usersModel->getEtc($users),
            'usersList' => $this->usersModel->getEtc(),
            'users' => $users,
        ];
        if ($lokasi && $month && $year) {
            $data['countMB'] = $this->pintuModel->getCountMonthlyLoc($month, $year, $lokasi);
            $data['countMF'] = $this->hydrantModel->getCountMonthlyLoc($month, $year, $lokasi);
            $data['countMU'] = $this->smokeModel->getCountMonthlyLoc($month, $year, $lokasi);
            $data['countML'] = $this->fireModel->getCountMonthlyLoc($month, $year, $lokasi);
            $data['countTMB'] = $this->pintuModel->getTotalMonthlyLoc($month, $year, $lokasi);
            $data['countTMF'] = $this->hydrantModel->getTotalMonthlyLoc($month, $year, $lokasi);
            $data['countTMU'] = $this->smokeModel->getTotalMonthlyLoc($month, $year, $lokasi);
            $data['countTML'] = $this->fireModel->getTotalMonthlyLoc($month, $year, $lokasi);
            $data['countTB'] = $this->pintuModel->getTotalLoc($month, $year, $lokasi);
            $data['countTF'] = $this->hydrantModel->getTotalLoc($month, $year, $lokasi);
            $data['countTU'] = $this->smokeModel->getTotalLoc($month, $year, $lokasi);
            $data['countTL'] = $this->fireModel->getTotalLoc($month, $year, $lokasi);
        } elseif ($users && $month && $year) {
            if ($users == 5) {
                ////////////// Ketua ERT
                $data['countMB'] = $this->pintuModel->getCountMonthlyUsers($month, $year, $users);
                $data['countMF'] = $this->hydrantModel->getCountMonthlyUsers($month, $year, $users);
                $data['countMU'] = $this->smokeModel->getCountMonthlyUsers($month, $year, $users);
                $data['countML'] = $this->fireModel->getCountMonthlyUsers($month, $year, $users);
                $data['countTMB'] = $this->pintuModel->getTotalMonthlyUsers($month, $year, $users);
                $data['countTMF'] = $this->hydrantModel->getTotalMonthlyUsers($month, $year, $users);
                $data['countTMU'] = $this->smokeModel->getTotalMonthlyUsers($month, $year, $users);
                $data['countTML'] = $this->fireModel->getTotalMonthlyUsers($month, $year, $users);
                $data['countTB'] = $this->pintuModel->getTotalUsers($month, $year, $users);
                $data['countTF'] = $this->hydrantModel->getTotalUsers($month, $year, $users);
                $data['countTU'] = $this->smokeModel->getTotalUsers($month, $year, $users);
                $data['countTL'] = $this->fireModel->getTotalUsers($month, $year, $users);
            } else {
                ////////////// OHSE
                $data['countMB'] = $this->pintuModel->getCountMonthlyOHSE($month, $year, $users);
                $data['countMF'] = $this->hydrantModel->getCountMonthlyOHSE($month, $year, $users);
                $data['countMU'] = $this->smokeModel->getCountMonthlyOHSE($month, $year, $users);
                $data['countML'] = $this->fireModel->getCountMonthlyOHSE($month, $year, $users);
                $data['countTMB'] = $this->pintuModel->getTotalMonthlyOHSE($month, $year, $users);
                $data['countTMF'] = $this->hydrantModel->getTotalMonthlyOHSE($month, $year, $users);
                $data['countTMU'] = $this->smokeModel->getTotalMonthlyOHSE($month, $year, $users);
                $data['countTML'] = $this->fireModel->getTotalMonthlyOHSE($month, $year, $users);
                $data['countTB'] = $this->pintuModel->getTotalOHSE($month, $year, $users);
                $data['countTF'] = $this->hydrantModel->getTotalOHSE($month, $year, $users);
                $data['countTU'] = $this->smokeModel->getTotalOHSE($month, $year, $users);
                $data['countTL'] = $this->fireModel->getTotalOHSE($month, $year, $users);
            }
        } elseif ($month && $year && $creator) {
            $data['countMB'] = $this->pintuModel->getCountPemohon($year, $month, $creator);
            $data['countMF'] = $this->hydrantModel->getCountPemohon($year, $month, $creator);
            $data['countMU'] = $this->smokeModel->getCountPemohon($year, $month, $creator);
            $data['countML'] = $this->fireModel->getCountPemohon($year, $month, $creator);
            $data['countTMB'] = $this->pintuModel->getTotalPemohon($year, $month, $creator);
            $data['countTMF'] = $this->hydrantModel->getTotalPemohon($year, $month, $creator);
            $data['countTMU'] = $this->smokeModel->getTotalPemohon($year, $month, $creator);
            $data['countTML'] = $this->fireModel->getTotalPemohon($year, $month, $creator);
            $data['countTB'] = $this->pintuModel->getTotalCreator($year, $month, $creator);
            $data['countTF'] = $this->hydrantModel->getTotalCreator($year, $month, $creator);
            $data['countTU'] = $this->smokeModel->getTotalCreator($year, $month, $creator);
            $data['countTL'] = $this->fireModel->getTotalCreator($year, $month, $creator);
        } elseif ($pic && $month && $year) {
            $data['countMB'] = $this->pintuModel->getCountMonthlyPic($month, $year, $pic);
            $data['countMF'] = $this->hydrantModel->getCountMonthlyPic($month, $year, $pic);
            $data['countMU'] = $this->smokeModel->getCountMonthlyPic($month, $year, $pic);
            $data['countML'] = $this->fireModel->getCountMonthlyPic($month, $year, $pic);
            $data['countTMB'] = $this->pintuModel->getTotalMonthlyPic($month, $year, $pic);
            $data['countTMF'] = $this->hydrantModel->getTotalMonthlyPic($month, $year, $pic);
            $data['countTMU'] = $this->smokeModel->getTotalMonthlyPic($month, $year, $pic);
            $data['countTML'] = $this->fireModel->getTotalMonthlyPic($month, $year, $pic);
            $data['countTB'] = $this->pintuModel->getTotalPic($month, $year, $pic);
            $data['countTF'] = $this->hydrantModel->getTotalPic($month, $year, $pic);
            $data['countTU'] = $this->smokeModel->getTotalPic($month, $year, $pic);
            $data['countTL'] = $this->fireModel->getTotalPic($month, $year, $pic);
        } elseif ($engineer && $month && $year) {
            $data['countMB'] = $this->pintuModel->getCountMonthlyEng($month, $year, $engineer);
            $data['countMF'] = $this->hydrantModel->getCountMonthlyEng($month, $year, $engineer);
            $data['countMU'] = $this->smokeModel->getCountMonthlyEng($month, $year, $engineer);
            $data['countML'] = $this->fireModel->getCountMonthlyEng($month, $year, $engineer);
            $data['countTMB'] = $this->pintuModel->getTotalMonthlyEng($month, $year, $engineer);
            $data['countTMF'] = $this->hydrantModel->getTotalMonthlyEng($month, $year, $engineer);
            $data['countTMU'] = $this->smokeModel->getTotalMonthlyEng($month, $year, $engineer);
            $data['countTML'] = $this->fireModel->getTotalMonthlyEng($month, $year, $engineer);
            $data['countTB'] = $this->pintuModel->getTotalEng($month, $year, $engineer);
            $data['countTF'] = $this->hydrantModel->getTotalEng($month, $year, $engineer);
            $data['countTU'] = $this->smokeModel->getTotalEng($month, $year, $engineer);
            $data['countTL'] = $this->fireModel->getTotalEng($month, $year, $engineer);
        } elseif ($month && $year) {
            $data['countMB'] = $this->pintuModel->getCountYearMonth($year, $month);
            $data['countMF'] = $this->hydrantModel->getCountYearMonth($year, $month);
            $data['countMU'] = $this->smokeModel->getCountYearMonth($year, $month);
            $data['countML'] = $this->fireModel->getCountYearMonth($year, $month);
            $data['countTMB'] = $this->pintuModel->getTotalYearMonth($year, $month);
            $data['countTMF'] = $this->hydrantModel->getTotalYearMonth($year, $month);
            $data['countTMU'] = $this->smokeModel->getTotalYearMonth($year, $month);
            $data['countTML'] = $this->fireModel->getTotalYearMonth($year, $month);
            $data['countTB'] = $this->pintuModel->getTotalMonthYear($year, $month);
            $data['countTF'] = $this->hydrantModel->getTotalMonthYear($year, $month);
            $data['countTU'] = $this->smokeModel->getTotalMonthYear($year, $month);
            $data['countTL'] = $this->fireModel->getTotalMonthYear($year, $month);
        } else {
            $data['countMB'] = 0;
            $data['countMF'] = 0;
            $data['countMU'] = 0;
            $data['countML'] = 0;
            $data['countTMB'] = 0;
            $data['countTMF'] = 0;
            $data['countTMU'] = 0;
            $data['countTML'] = 0;
            $data['countTB'] = 0;
            $data['countTF'] = 0;
            $data['countTU'] = 0;
            $data['countTL'] = 0;
        }

        return view('dashboard', $data);
    }

    public function view_profile()
    {
        $users = $this->usersModel->findAll();

        $data = [
            'title' => 'View My Profile',
            'users' => $users
        ];

        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();

        return view('user/index', $data);
    }

    public function changePassword()
    {
        $id = user_id();
        $data = [
            'password' => $this->usersModel->getUsers($id),
            'title' => 'Change User Password'
        ];
        return view('admin/ubahPassword', $data);
    }

    public function updatePassword()
    {

        //Rules for the update password form
        $rules = [
            'old-password' => [
                // 'rules'  => 'required|checkOldPasswords',
                'rules'  => 'required',
                'errors' => [
                    // 'checkOldPasswords' => 'Password Lama Tidak Sesuai',
                    'required' => 'Password Lama Harus Diisi',
                ]
            ],
            'new-password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password Baru Harus Diisi',

                ]
            ],
            'password' => [
                'rules'  => 'required|matches[new-password]',
                'errors' => [
                    'required' => 'Konfirmasi Password Baru Harus Diisi',
                    'matches' => 'Password Tidak Sesuai Dengan Password Baru'
                ]
            ],
        ];

        if ($this->request->getMethod() === 'post' && $this->validate($rules)) {

            //Create new instance of the MythAuth UserModel
            $users = model(UserModel::class);

            //Get the id of the current user
            $user_id = user_id();

            //Create new user entity
            $entity = new User();

            //Get current password from input field
            $newPassword = $this->request->getVar('password');

            //Hash password using the "setPassword" function of the User entity
            $entity->setPassword($newPassword);

            //Save the hashed password in the variable "hash"
            $hash  = $entity->password_hash;

            //update the current users password_hash in the database with the new hashed password.
            $users->update($user_id, ['password_hash' => $hash]);

            //Return back with success message
            return redirect()->to('/change-password')->with('pesan', "Password Has Been Updated");
        } else {
            $validation = $this->validator->listErrors();
            //Return with errors
            return redirect()->to('/change-password')->withInput()->with('validation', $validation);
        }
    }

    public function editEmail()
    {
        $id = user_id();
        $data = [
            'password' => $this->usersModel->getUsers($id),
            'title' => 'Update User Email'
        ];
        return view('admin/edit', $data);
    }

    public function updateEmail($id)
    {
        $this->usersModel->save([
            'id' => $id,
            'NIK' => $this->request->getVar('NIK'),
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'email' => $this->request->getVar('email')
        ]);
        return redirect()->to('/change-email')->with('pesan', 'Data Has Been Updated');
    }

    public function sendEmail()
    {
        $this->email->setFrom('izamsusilo.xrpl.2017@gmail.com', 'izam susilo');
        $this->email->setTo('izamsusilo@gmail.com');

        $this->email->setSubject('Testing Email CI4');

        $this->email->setMessage('<h1>Testing Email</h1><p>ini tes email</p>');

        if (!$this->email->send()) {
            return redirect()->to('/view_profile')->with('pesan', 'Email Not Sended');
        } else {
            return redirect()->to('/view_profile')->with('pesan', 'Email Has Been Sended');
        }
        // return redirect()->to('/change-email')->with('pesan', 'Data Has Been Updated');
    }
}
