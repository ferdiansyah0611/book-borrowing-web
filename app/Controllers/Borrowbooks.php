<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Borrowbook;
use App\Models\Book;
use \Hermawan\DataTables\DataTable;

class Borrowbooks extends BaseController
{
	public function __construct()
	{
		$this->data['active'] = 'BorrowBook';
		$this->rules = [
		    'book_id' => 'required',
		    'start' => 'required',
		    'end' => 'required',
		];
	}
	public function json()
	{
		$db = db_connect();
    	$builder = $db->table('borrow_books')
    		->select('borrow_books.id, borrow_books.start, borrow_books.end, borrow_books.created_at, users.username, books.name')
    		->join('users', 'users.id = borrow_books.user_id')
    		->join('books', 'books.id = borrow_books.book_id');
    	if($this->user['role'] == 'user')
		{
			$builder->where('borrow_books.user_id', $this->user['id']);
		}
    	return DataTable::of($builder)->toJson();
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
			'book_id' => $request->getPost('book_id'),
			'start' => $request->getPost('start'),
			'end' => $request->getPost('end'),
		];
		if($request->getPost('id')){
			$data['id'] = $request->getPost('id');
		}
		return $data;
	}
	public function index()
	{
		$pager = \Config\Services::pager();
		$model = new Borrowbook();
		$data = $model->user($this->data['user']);
		$pager->makeLinks($data[3], $data[2], $data[1]);
		$this->data['list'] = $data[0];
		$this->data['pager'] = $pager;

		return view('borrow-book/index', $this->data);
	}
	public function create()
	{
		$validate = $this->validate($this->rules);
		if(!$validate){
			$this->session->setFlashdata('validation', $this->validator->getErrors());
			$this->session->setFlashdata($_POST);
			return redirect()->back();
		}

		$request = $this->request;
		$model = new Borrowbook();
		$data = $this->_wrap();
		$data['created_at'] = date("Y-m-d H:i:s");
		$model->save($data);

		return redirect()->back();
	}
	public function new()
	{
		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			$data = $this->session->getFlashdata();
			$book = new Book();
			$find = $book->find($id);
			$this->data['book'] = $find;
			unset($data['validation']);
			$this->data['data'] = $data;
			return view('borrow-book/create', $this->data);
		}else{
			return redirect()->back();
		}
	}
	public function show(int $id)
	{
		return view('borrow-book/show', $this->data);
	}
	public function edit(int $id)
	{
		if($this->user['role'] == 'user'){
			return redirect()->back();
		}
		$model = new Borrowbook();
		$book = new Book();
		$this->data['data'] = $model->where('id', $id)->first();
		$this->data['book'] = $book->find($this->data['data']['book_id']);
		return view('borrow-book/create', $this->data);
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
		$model = new Borrowbook();
		$model->where('id', $id);
		if($this->user['role'] == 'user'){
			$model->where('user_id', $this->user);
		}
		$model->delete();
		return redirect()->back();
	}
}
