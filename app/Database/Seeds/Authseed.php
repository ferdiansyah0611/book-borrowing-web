<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\User;

class Authseed extends Seeder
{
	public function run()
	{
		$model = new User();
		$model->save([
			'username' => 'admin',
			'email' => 'admin@gmail.com',
			'password' => password_hash('admin123', PASSWORD_DEFAULT),
			'role' => 'admin',
			'created_at' => date("Y-m-d H:i:s")
		]);
		$model->save([
			'username' => 'ferdiansyah',
			'email' => 'ferdif9996@gmail.com',
			'password' => password_hash('11111111', PASSWORD_DEFAULT),
			'role' => 'user',
			'created_at' => date("Y-m-d H:i:s")
		]);
	}
}
