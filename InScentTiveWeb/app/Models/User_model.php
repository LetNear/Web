<?php
namespace App\Models;

use CodeIgniter\Model;

use CodeIgniter\Database\ConnectionInterface;

class User_model extends Model
{
    function getUserInfo()
    {
        $builder = $this->db->table('user');

        $res = $builder->get()->getResult();
        return $res;
    }
    function getUserInfoBySN($SN)
    {
        $builder = $this->db->table('user');
        $builder->where('userID', $SN);
        $res = $builder->get()->getRow();
        return $res;
    }

    function getUserInfoByEmail($email)
    {
        $builder = $this->db->table('user');
        $builder->where('email', $email);
        $res = $builder->get()->getRow();
        return $res;

    }

    function insertUserRecord($data)
    {
        $builder = $this->db->table('user');
        $res = $builder->insert($data);
        return $res;
    }
    function updateUserRecord($data, $SN)
    {
        $builder = $this->db->table('user');
        $builder->set($data);
        $builder->where('userID', $SN);
        $res = $builder->update($data);
        return $res;
    }
    function deleteUserRecord($SN)
    {
        $builder = $this->db->table('user');
        $builder->where('userID', $SN);
        $res = $builder->delete();
        return $res;
    }

}