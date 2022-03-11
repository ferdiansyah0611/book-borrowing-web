<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Ebook;

class EbookController extends BaseController
{
	protected $helpers = ['form', 'filesystem'];

	public function __construct()
	{
		$this->data['active'] = 'Ebook';
		$this->rules = [
		    'title' => 'required|min_length[3]',
		    'file' => 'uploaded[file]|max_size[file,20024]|mime_in[file,application/pdf]'
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
		if($this->request->getPost('id')){
			unset($this->rules['file']);
		}

		$request = $this->request;
		$model = new Ebook();
		$data = $this->_wrap();
		$img = $request->getFile('file');
		$id = $request->getPost('id');
		$validate = $this->validate($this->rules);
		if(!$validate){
			$this->session->setFlashdata('validation', $this->validator->getErrors());
			$this->session->setFlashdata($_POST);
			return redirect()->back();
		}
		if($img->isValid()){
	        $path = '/upload/' . date('Ymd');
	        $name = $img->getRandomName();
	        if ($img->move(ROOTPATH . 'public' . $path, $name)){
	            $data['file'] = $path . '/' . $name;
	            if($id){
	            	$find = $model->where('id', $id)->first();
	            	$pathfile = ROOTPATH . 'public' . $find['file'];
	            	if(file_exists($pathfile)){
	            		unlink($pathfile);
	            	}
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
		return $this->_admin(function(){
			$data = $this->session->getFlashdata();
			unset($data['validation']);
			$this->data['data'] = $data;
			return view('ebook/create', $this->data);
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
		$model = new Ebook();
		$this->data['data'] = $model->where('id', $id)->first();
		return view('ebook/create', $this->data);
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
		$model = new Ebook();
		$modelDelete = new Ebook();
		$where = $model->where('id', $id);
		$path = ROOTPATH . 'public' . $where->first()['file'];
		if(file_exists($path)){
			unlink($path);
		}
		$modelDelete->where('id', $id)->delete();
		return redirect()->back();
	}
}
