<?php

namespace App\Controllers;
use App\Models\Book;
use CodeIgniter\RESTful\ResourceController;

class ChartController extends ResourceController
{
	protected $format    = 'json';
	
	public function chart()
	{
		$book = new Book();
		$value = array();
		$listmonth = array();
		for ($i=1; $i <= 8; $i++) { 
			$date = date_create(date('Y-m-d'));
			$date->modify('-'. $i .' month');
			$month = $date->format('M');
			$listmonth[$i] = $month;
			$value[$month] = $book->where('MONTH(created_at)', $date->format('n'))->countAllResults();
		}
		return $this->respond([
			'month' => $listmonth,
			'value' => $value
		]);
	}
}
