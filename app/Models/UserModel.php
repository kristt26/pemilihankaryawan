<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['id', 'username', 'password', 'email', 'login_oauth_uid', 'first_name', 'last_name', 'profile_picture', 'fullname', 'status', 'alamat', 'kontak'];
    protected $encrypter;
    protected $db;
    public function __construct()
    {
        $this->encrypter = \Config\Services::encrypter();
        $this->db = \Config\Database::connect();
    }

    public function check()
    {
        if ($this->db->table('users')->countAllResults(false) == 0) {
            $this->db->transBegin();
            $user = [
                "username" => "Administrator",
                "password" => base64_encode($this->encrypter->encrypt("Admin@123"))
            ];
            $this->db->table('users')->insert($user);
            $userid = $this->db->insertID();
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return true;
            } else {
                $this->db->transCommit();
                return false;
            }
        }
    }

    public function login($data)
    {
        $username = $data['username'];
        $result = $this->db->query("SELECT
            *
        FROM
            `users`
        WHERE username='$username'")->getRowArray();
        if ($result) {
            $p = $this->encrypter->decrypt(base64_decode($result['password']));
            if ($p == $data['password']) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
