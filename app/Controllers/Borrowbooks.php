<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Borrowbook;
use App\Models\Book;

class Borrowbooks extends BaseController
{
	public function __construct()
	{
		$this->data['active'] = 'borrow-book';
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
			$book = new Book();
			$find = $book->find($id);
			$this->data['book'] = $find;
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
		$model = new Borrowbook();
		$book = new Book();
		$this->data['data'] = $model->where('id', $id)->first();
		$this->data['book'] = $book->find($this->data['data']['book_id']);

		return view('borrow-book/create', $this->data);
	}
	public function update(int $id)
	{
		$model = new Borrowbook();
		$data = $this->_wrap();
		$data['updated_at'] = date("Y-m-d H:i:s");
		$model->update($id, $data);
		return redirect()->back();
	}
	public function delete(int $id)
	{
		$request = $this->request;
		$model = new Borrowbook();
		$model->where('id', $id)->delete();
		return redirect()->back();
	}
}
