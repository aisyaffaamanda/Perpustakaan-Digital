<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();
        $userModel->save([
            'username' => 'admin',
            'password' => 'admin123', // will be hashed by model
        ]);
    }
}
