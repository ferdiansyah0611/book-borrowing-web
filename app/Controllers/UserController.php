<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController
{
	public function __construct()
	{
		$this->data['active'] = 'user';
		$this->rules = [
		    'username' => 'required|min_length[3]',
		    'email' => 'required|valid_email|is_unique[users.email]',
		    'role' => 'required'
		];
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
			$data['updated_at'] = date("Y-m-d H:i:s");
			$new = $request->getPost('new_password');
			if($new){
				$data['password'] = password_hash($new, PASSWORD_DEFAULT);
			}
		}else{
			$data['password'] = password_hash($request->getPost('password'), PASSWORD_DEFAULT);
			$data['created_at'] = date("Y-m-d H:i:s");
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
		if($this->request->getPost('id')){
			$this->rules['email'] = 'required|valid_email';
		}
		$validate = $this->validate($this->rules);
		if(!$validate){
			$this->session->setFlashdata('validation', $this->validator->getErrors());
			$this->session->setFlashdata($_POST);
			return redirect()->back();
		}
		$user = new User();
		$data = $this->_wrap();
		$user->save($data);

		return redirect()->back();
	}
	public function new()
	{
		$data = $this->session->getFlashdata();
		unset($data['validation']);
		$this->data['data'] = $data;
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
