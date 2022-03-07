<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Users extends BaseController
{
	public function __construct()
	{
		$this->data['active'] = 'user';
	}
	public function _wrap()
	{
		$request = $this->request;
		$data = [
			'username' => $request->getPost('username'),
			'email' => $request->getPost('email'),
			'role' => $request->getPost('role'),
		];
		if($request->getPost('id')){
			$data['id'] = $request->getPost('id');
		}
		return $data;
	}
	public function index()
	{
		$pager = \Config\Services::pager();
		$user = new User();
		if(isset($_GET['search'])){
			$user->like('username', $_GET['search']);
			$user->orLike('email', $_GET['search']);
		}
		$this->data['list'] = $user->paginate(10);
		$this->data['pager'] = $user->pager;

		return view('user/index', $this->data);
	}
	public function create()
	{
		$request = $this->request;
		$user = new User();
		$data = $this->_wrap();
		$pw = $request->getPost('password');
		$id = $request->getPost('id');
		if($pw){
			$data['password'] = password_hash($pw, PASSWORD_DEFAULT);
		}
		if($id){
			$data['updated_at'] = date("Y-m-d H:i:s");
		}
		$data['created_at'] = date("Y-m-d H:i:s");
		$user->save($data);

		return redirect()->back();
	}
	public function new()
	{
		return view('user/create', $this->data);
	}
	public function show(int $id)
	{
		return view('user/show', $this->data);
	}
	public function edit(int $id)
	{
		$user = new User();
		$this->data['data'] = $user->where('id', $id)->first();
		return view('user/create', $this->data);
	}
	public function update(int $id)
	{
		$user = new user();
		$data = $this->_wrap();
		$data['updated_at'] = date("Y-m-d H:i:s");
		$user->update($id, $data);
		return redirect()->back();
	}
	public function delete(int $id)
	{
		$request = $this->request;
		$user = new user();
		$user->where('id', $id)->delete();
		return redirect()->back();
	}
}
