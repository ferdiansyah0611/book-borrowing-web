<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Book;

class BookSeed extends Seeder
{
	public function run()
	{
		$book = new Book();
		for ($i = 1; $i <= 50; $i++) {
			$book->save([
				'user_id' => 1,
				'name' => 'book ' . $i,
				'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
				'created_at' => date("Y-m-d H:i:s")
			]);
		}
	}
}
