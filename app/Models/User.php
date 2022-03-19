<?php

namespace App\Models;

use CodeIgniter\Model;
use \Hermawan\DataTables\DataTable;

class User extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'users';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['username', 'email', 'password', 'role', 'created_at', 'updated_at'];

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

	public function count()
	{
		$db = \Config\Database::connect();
		$date = date_create(date('Y-m-d'));
		$date->modify('-1 month');
		$month = $date->format('m');
		$data = $this->db->table($this->table)->where('MONTH(created_at) >=', $month)->where('MONTH(created_at) <=', date('m'))->countAllResults();
		return $data;
	}
	public function datatable()
	{
		$builder = $this->db->table('users')->select('id, username, email, created_at');
    	return DataTable::of($builder)->toJson(); 
	}
}
