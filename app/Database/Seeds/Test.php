<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Test extends Seeder
{
	public function run()
	{
		$this->call('Authseed');
		$this->call('Bookseed');
		$this->call('Borrowbookseed');
		$this->call('Userseed');
	}
}
