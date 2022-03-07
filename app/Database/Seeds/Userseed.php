<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\User;

class Userseed extends Seeder
{
	public function run()
	{
		$book = new User();
		for ($i = 1; $i <= 50; $i++) {
			$book->save([
				'username' => 'user ' . $i,
				'email' => 'user' . $i . '@gmail.com',
				'password' => password_hash('user' . $i, PASSWORD_DEFAULT),
				'role' => 'user',
				'created_at' => date("Y-m-d H:i:s")
			]);
		}
	}
}
