<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Tests\Support\Models\Borrowbook;

class Borrowbookseed extends Seeder
{
	public function run()
	{
		$model = new Borrowbook();
		for ($i = 1; $i <= 5; $i++) {
			for ($a = 1; $a <= 5 ; $a++) { 
				$model->save([
					'user_id' => 1,
					'book_id' => $i,
					'start' => date("Y-m-d H:i:s"),
					'end' => date("Y-m-d H:i:s"),
					'created_at' => date("Y-m-d H:i:s")
				]);
			}
		}
	}
}
