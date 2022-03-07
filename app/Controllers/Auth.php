<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Auth extends BaseController
{
	protected $helpers = ['form'];

	public function __construct(){
		$this->encrypter = \Config\Services::encrypter();
		$this->session = \Config\Services::session();
		$this->rules = [
		    'username' => 'required',
		    'email'    => 'required|valid_email',
		    'password' => 'required|min_length[8]',
		];
	}
	public function signin()
	{
		if(!isset($this->user['id'])){
			return view('auth/login');
		}
		return redirect()->to('/');
	}
	public function login()
	{
		$rules = $this->rules;
		unset($rules['username']);
		$validate = $this->validate($rules);
		if(!$validate)
		{
			$this->session->setFlashdata('validation', $this->validator->getErrors());
			return redirect()->back();
		}
		$request = $this->request;
		$user = new User();
		$find = $user->where('email', $request->getPost('email'))->first();
		if(password_verify($request->getPost('password'), $find['password'])){
			$data = $find;
			$data['password'] = null;
			$this->session->set($data);
			return redirect()->to('/');
		}
		$this->session->setFlashdata('error', 'Password is wrong.');
		return redirect()->back();
	}
	public function signup()
	{
		return view('auth/register');
	}
	public function register()
	{
		$validate = $this->validate($this->rules);
		if(!$validate)
		{
			$this->session->setFlashdata('validation', $this->validator->listErrors());
			return redirect()->back();
		}
		$request = $this->request;
		$user = new User();
		$find = $user->where('email', $request->getPost('email'))->first();
		if(!isset($find['id']))
		{
			$username = $request->getPost('username');
			$email = $request->getPost('email');
			$password = password_hash($request->getPost('password'), PASSWORD_DEFAULT);
			$insert = [
				'username' => $username,
				'email' => $email,
				'password' => $password,
				'role' => 'user',
				'created_at' => date("Y-m-d H:i:s"),
			];
			$user->save($insert);
			$data = $insert;
			$data['password'] = null;
			$this->session->setFlashdata('success', 'Successfuly registered. Signin now!');
			return redirect()->to('/auth/signin');
		}
		$this->session->setFlashdata('error', 'User has registered.');
		return redirect()->back();
	}
	public function logout()
	{
		$this->session->destroy();
		return redirect()->to('/auth/signin');
	}
}
