<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController
{
	public function __construct()
	{
		$this->data['active'] = 'User';
		$this->rules = [
		    'username' => 'required|min_length[3]',
		    'email' => 'required|valid_email|is_unique[users.email]',
		    'role' => 'required'
		];
		$this->model = new User();
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
		//
	}
	public function edit(int $id)
	{
		$user = new User();
		$this->data['data'] = $user->where('id', $id)->first();
		return view('user/create', $this->data);
	}
	public function update(int $id)
	{
		//
	}
	public function delete(int $id)
	{
		$request = $this->request;
		$user = new user();
		$user->where('id', $id)->delete();
		return redirect()->back();
	}
	public function profile()
	{
		$request = $this->request;
		$method = $request->getMethod();
		$this->data['data'] = $this->model->where('id', $this->user['id'])->first();

		if ($method == 'post') {
			$data = $this->_wrap();
			unset($data['password']);

			$data['id'] = $this->user['id'];
			$data['role'] = $this->user['role'];
			$data['email'] = $this->user['email'];
			$old_password = $request->getPost('old_password');
			$new_password = $request->getPost('new_password');

			unset($this->rules['email']);
			unset($this->rules['password']);
			unset($this->rules['role']);

			if($old_password){
				$this->rules['old_password'] = 'required|min_length[8]|string';
				$this->rules['new_password'] = 'required|min_length[8]|string';
			}
			$validate = $this->validate($this->rules);

			$mail = $this->data['data'];
			if(!$validate){
				$this->session->setFlashdata('validation', $this->validator->getErrors());
				if(!$data['id']){
					$this->session->setFlashdata($_POST);
				}
				return redirect()->back();
			}

			if ($old_password && $new_password) {
				if (password_verify($old_password, $mail['password'])) {
					$data['password'] = password_hash($new_password, PASSWORD_DEFAULT);
				}
			}

			$data['updated_at'] = date("Y-m-d H:i:s");
			$this->model->save($data);
			$user = new User();
			$user = $user->where('email', $this->user['email'])->first();
			unset($user['password']);
			$this->session->set($user);
			return redirect()->back();
		}
		if ($method == 'get') {
			$this->data['active'] = 'Profile';
			return view('profile', $this->data);
		}
	}
}
