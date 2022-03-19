<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Book;
use \Hermawan\DataTables\DataTable;

class BookController extends BaseController
{
	public function json()
	{
		$db = db_connect();
    	$builder = $db->table('books')
    		->select('id, name, name_publisher, year_publisher, author, description');
    	return DataTable::of($builder)->toJson();
	}
	public function __construct()
	{
		$this->data['active'] = 'Book';
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
		return view('book/index', $this->data);
	}
	public function create()
	{
		return $this->_admin(function(){
			$validate = $this->validate($this->rules);
			if(!$validate){
				$this->session->setFlashdata('validation', $this->validator->getErrors());
				$this->session->setFlashdata($_POST);
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
			$data = $this->session->getFlashdata();
			unset($data['validation']);
			$this->data['data'] = $data;
			return view('book/create', $this->data);
		});
	}
	public function show(int $id)
	{
		//
	}
	public function edit(int $id)
	{
		if($this->user['role'] == 'user'){
			return redirect()->back();
		}
		$book = new Book();
		$this->data['data'] = $book->where('id', $id)->first();
		return view('book/create', $this->data);
	}
	public function update(int $id)
	{
		//
	}
	public function delete(int $id)
	{
		if($this->user['role'] == 'user'){
			return redirect()->back();
		}
		$request = $this->request;
		$book = new Book();
		$book->where('id', $id)->delete();
		return redirect()->back();
	}
}
