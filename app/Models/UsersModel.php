<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['id', 'username', 'fullname', 'email', 'password_hash'];

    public function getEngineer($id = false)
    {
        if ($id == false) {
            return $this->join('auth_groups_users', 'auth_groups_users.user_id = users.id')->where('auth_groups_users.group_id', '4')->orderBy('fullname')->findAll();
        }

        return $this->join('auth_groups_users', 'auth_groups_users.user_id = users.id')->where('auth_groups_users.group_id', '4')->where(['id' => $id])->first();
    }

    public function getUsers($id = false)
    {
        if ($id == false) {
            return $this->orderBy('fullname')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getPic($id = false)
    {
        $group = ['2', '3'];
        if ($id == false) {
            return $this->join('auth_groups_users', 'auth_groups_users.user_id = users.id')->whereIn('auth_groups_users.group_id', $group)->orderBy('fullname')->findAll();
        }

        return $this->join('auth_groups_users', 'auth_groups_users.user_id = users.id')->whereIn('auth_groups_users.group_id', $group)->where(['id' => $id])->first();
    }

    public function getEtc($id = false)
    {
        $group = ['5', '6'];
        if ($id == false) {
            return $this->join('auth_groups_users', 'auth_groups_users.user_id = users.id')->whereIn('auth_groups_users.group_id', $group)->orderBy('fullname')->findAll();
        }

        return $this->join('auth_groups_users', 'auth_groups_users.user_id = users.id')->whereIn('auth_groups_users.group_id', $group)->where(['id' => $id])->first();
    }

    public function getDistribusiUsers($distribusi = false)
    {
        return $this->join('distribusi', 'distribusi.id = users.distribusi')->where('users.distribusi', $distribusi)->findAll();
    }

    public function getCountUsers()
    {
        return $this->countAllResults();
    }

    public function getGroups()
    {
        return $this->select('auth_groups.name')->join('auth_groups_users', 'auth_groups_users.user_id = users.id')->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')->where('users.id', user_id())->first();
    }
}
