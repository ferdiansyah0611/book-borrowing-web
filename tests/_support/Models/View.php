<?php

namespace Tests\Support\Models;

use CodeIgniter\Model;

class View extends Model
{
	protected $DBGroup              = 'tests';
	protected $table                = 'views';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['user_id', 'created_at'];

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

	public function viewed($user)
	{
		$db = \Config\Database::connect();
		$db->table($this->table)->insert([
			'user_id' => $user,
			'created_at' => date('Y-m-d H:i:s')
		]);
		return true;
	}
	public function count()
	{
		$date = date_create(date('Y-m-d'));
		$date->modify('-1 month');
		$month = $date->format('m');
		$data = $this->db->table($this->table)->where('MONTH(created_at) >=', $month)->where('MONTH(created_at) <=', date('m'))->countAllResults();
		return $data;
	}
}
