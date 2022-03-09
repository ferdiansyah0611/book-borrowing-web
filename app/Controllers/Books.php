<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Book;

class Books extends BaseController
{
	public function __construct()
	{
		$this->data['active'] = 'book';
		$this->rules = [
		    'name' => 'required|min_length[3]',
		    'name_publisher' => 'required|min_length[3]',
		    'year_publisher' => 'required',
		    'author' => 'required|min_length[3]',
		    'description' => 'required|min_length[8]',
		];
	}
	public function _admin($run)
	{
		if($this->user['role'] == 'user'){
			return redirect()->back();
		}
		return $run();
	}
	public function _wrap()
	{
		$request = $this->request;
		$data = [
			'user_id' => $this->user['id'],
			'name' => $request->getPost('name'),
			'name_publisher' => $request->getPost('name_publisher'),
			'year_publisher' => $request->getPost('year_publisher'),
			'author' => $request->getPost('author'),
			'description' => $request->getPost('description'),
		];
		if($request->getPost('id')){
			$data['id'] = $request->getPost('id');
		}
		return $data;
	}
	public function index()
	{
		$pager = \Config\Services::pager();
		$book = new Book();
		if(isset($_GET['search'])){
			$book->like('name', $_GET['search']);
			$book->orLike('author', $_GET['search']);
			$book->orLike('name_publisher', $_GET['search']);
		}
		$this->data['list'] = $book->paginate(10);
		$this->data['pager'] = $book->pager;

		return view('book/index', $this->data);
	}
	public function create()
	{
		return $this->_admin(function(){
			$validate = $this->validate($this->rules);
			if(!$validate){
				$this->session->setFlashdata('validation', $this->validator->getErrors());
				return redirect()->back();
			}

			$request = $this->request;
			$book = new Book();
			$data = $this->_wrap();
			$data['created_at'] = date("Y-m-d H:i:s");
			$book->save($data);

			return redirect()->back();
		});
	}
	public function new()
	{
		return $this->_admin(function(){
			return view('book/create', $this->data);
		});
	}
	public function show(int $id)
	{
		return $this->_admin(function(){
		});
	}
	public function edit(int $id)
	{
		return $this->_admin(function(){
			$book = new Book();
			$this->data['data'] = $book->where('id', $id)->first();
			return view('book/create', $this->data);
		});
	}
	public function update(int $id)
	{
		return $this->_admin(function(){
			$book = new Book();
			$data = $this->_wrap();
			$data['updated_at'] = date("Y-m-d H:i:s");
			$book->update($id, $data);
			return redirect()->back();
		});
	}
	public function delete(int $id)
	{
		return $this->_admin(function(){
			$request = $this->request;
			$book = new Book();
			$book->where('id', $id)->delete();
			return redirect()->back();
		});
	}
}
