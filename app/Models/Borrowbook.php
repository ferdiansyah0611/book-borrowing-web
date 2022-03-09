<?php

namespace App\Models;

use CodeIgniter\Model;

class Borrowbook extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'borrow_books';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['user_id', 'book_id', 'start', 'end', 'created_at', 'updated_at'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function user($user)
	{
		$page = intval(isset($_GET['page']) ? $_GET['page'] : 1);
		if($page){
			$db      = \Config\Database::connect();
			$builder = $db->table('borrow_books')
			->select('borrow_books.*, users.email as email, users.username as username, books.name as booksname')
			->join('users', 'users.id = borrow_books.user_id')
			->join('books', 'books.id = borrow_books.book_id');
			if($user['role'] == 'user')
			{
				$builder->where('borrow_books.user_id', $user['id']);
			}
			if(isset($_GET['search'])){
				$builder->where('books.name', $_GET['search']);
				$builder->orWhere('users.username', $_GET['search']);
				$builder->orWhere('users.id', $_GET['search']);
				$builder->orWhere('users.email', $_GET['search']);
			}
			// dd($builder->countAllResults());
			return [$builder->get(10, $page - 1)->getResult(), $builder->countAllResults(), 10, $page];
		}
		return array();
	}
	public function count()
	{
		$date = date_create(date('Y-m-d'));
		$date->modify('-1 month');
		$month = $date->format('m');
		$data = $this->db->table('borrow_books')->where('MONTH(created_at) >=', $month)->where('MONTH(created_at) <=', date('m'))->countAllResults();
		return $data;
	}
}
