<?php

namespace App\Controllers;
use App\Models\Book;
use App\Models\Borrowbook;
use CodeIgniter\RESTful\ResourceController;

class ChartController extends ResourceController
{
	protected $format    = 'json';
	
	public function book()
	{
		$book = new Book();
		$value = array();
		$listmonth = array();
		for ($i=0; $i < 8; $i++) { 
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
	public function borrowed()
	{
		$borrow = new Borrowbook();
		$value = array();
		$listmonth = array();
		for ($i=0; $i < 6; $i++) { 
			$date = date_create(date('Y-m-d'));
			$date->modify('-'. $i .' month');
			$month = $date->format('M');
			$listmonth[$i] = $month;
			$value[$month] = $borrow->where('MONTH(created_at)', $date->format('n'))->countAllResults();
		}
		return $this->respond([
			'month' => $listmonth,
			'value' => $value
		]);
	}
}
