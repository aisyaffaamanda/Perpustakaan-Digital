<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        $session = session();
        if ($session->get('logged_in')) {
            return redirect()->to(base_url('buku'));
        }

        $data = [
            'title' => 'Login — Perpustakaan Digital',
            'validation' => \Config\Services::validation(),
        ];

        return view('auth/login', $data);
    }

    public function doLogin()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Username dan password wajib diisi.');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
        }

        $session = session();
        $session->set([
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'logged_in'  => true,
        ]);

        return redirect()->to(base_url('buku'))->with('success', 'Berhasil login.');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Berhasil logout.');
    }
}
