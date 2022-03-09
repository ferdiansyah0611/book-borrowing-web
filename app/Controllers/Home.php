<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\User;
use App\Models\Book;
use App\Models\Borrowbook;

class Home extends BaseController
{
	public function __construct()
	{
		$this->data['active'] = '/';
	}
	public function index()
	{
		$book = new Book();
		$borrow = new Borrowbook();
		$user = new User();
		$this->data['count']['book'] = $book->count();
		$this->data['count']['borrow'] = $borrow->count();
		$this->data['count']['user'] = $user->count();
		$this->data['count']['view'] = $this->view->count();
		$this->data['list'] = $book->orderBy('created_at', 'desc')->limit(20)->find();
		return view('home', $this->data);
	}
}
