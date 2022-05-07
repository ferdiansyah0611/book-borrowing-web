<?php

namespace Tests\Support\Models;

use CodeIgniter\Model;

class Ebook extends Model
{
	protected $DBGroup              = 'tests';
	protected $table                = 'ebooks';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['user_id', 'title', 'file', 'created_at'];

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
			$builder = $db->table($this->table)
			->select('ebooks.*, users.email as email, users.username as username')
			->join('users', 'users.id = ebooks.user_id');
			if(isset($_GET['search'])){
				$builder = $builder->like('ebooks.title', $_GET['search']);
				$builder = $builder->orWhere('users.username', $_GET['search']);
				$builder = $builder->orWhere('users.id', $_GET['search']);
				$builder = $builder->orWhere('users.email', $_GET['search']);
			}
			return [$builder->get(10, $page - 1)->getResult(), $builder->countAllResults(), 10, $page];
		}
		return array();
	}
}
