<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Borrowbook;

class Borrowbookseed extends Seeder
{
	public function run()
	{
		$model = new Borrowbook();
		for ($i = 1; $i <= 50; $i++) {
			for ($a = 1; $a <= 20 ; $a++) { 
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
