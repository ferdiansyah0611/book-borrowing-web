<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Ebook;

class EbookController extends BaseController
{
	protected $helpers = ['form', 'filesystem'];

	public function __construct()
	{
		$this->data['active'] = 'ebook';
	}
	public function _wrap()
	{
		$request = $this->request;
		$data = [
			'user_id' => $this->user['id'],
			'title' => $request->getPost('title'),
		];
		if($request->getPost('id')){
			$data['id'] = $request->getPost('id');
		}
		return $data;
	}
	public function index()
	{
		$pager = \Config\Services::pager();
		$model = new Ebook();
		
		$data = $model->user($this->data['user']);
		$pager->makeLinks($data[3], $data[2], $data[1]);
		$this->data['list'] = $data[0];
		$this->data['pager'] = $pager;

		return view('ebook/index', $this->data);
	}
	public function create()
	{
		$request = $this->request;
		$model = new Ebook();
		$data = $this->_wrap();
		$img = $request->getFile('file');
		$id = $request->getPost('id');
		if($img->isValid()){
	        $path = '/uploads/' . date('Ymd');
	        $name = $img->getRandomName();
	        if ($img->move(ROOTPATH . 'public' . $path, $name)){
	            $data['file'] = $path . '/' . $name;
	            if($id){
	            	$find = $model->where('id', $id)->first();
	            	unlink(ROOTPATH . 'public' . $find['file']);
	            	$data['updated_at'] = date("Y-m-d H:i:s");
	            }
	        }else{
	            // $data = ['errors' => 'The file has already been moved.'];
	        }
		}
		$data['created_at'] = date("Y-m-d H:i:s");
		$model->save($data);

		return redirect()->back();
	}
	public function new()
	{
		return view('ebook/create', $this->data);
	}
	public function show(int $id)
	{
		return redirect()->back();
	}
	public function edit(int $id)
	{
		$model = new Ebook();
		$this->data['data'] = $model->where('id', $id)->first();
		return view('ebook/create', $this->data);
	}
	public function update(int $id)
	{
		$model = new Ebook();
		$data = $this->_wrap();
		$data['updated_at'] = date("Y-m-d H:i:s");
		$model->update($id, $data);
		return redirect()->back();
	}
	public function delete(int $id)
	{
		$request = $this->request;
		$model = new Ebook();
		$model->where('id', $id)->delete();
		return redirect()->back();
	}
}
