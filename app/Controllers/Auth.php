<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
class Auth extends ResourceController
{
    protected $userModel;
    public $session;
    public $google_client;
    public $mail;
    protected $encrypter;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
        $this->session = session();
        $this->encrypter = \Config\Services::encrypter();
    }

    public function index()
    {
        $result = $this->userModel->check();
        return view('auth');
    }

    public function login()
    {
        $session = session();
        $data = (array) $this->request->getJSON();
        $result = $this->userModel->login($data);
        if ($result) {
            $result['logged_in'] = true;
            $session->set($result);
            return $this->respond($result);
        } else {
            return $this->fail("Data Tidak Ditemukan");
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/auth');
    }
}
