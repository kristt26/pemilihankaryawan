<?php namespace App\Controllers;
use App\Controllers\BaseController;
class Home extends BaseController
{
	public function __construct()
	{
		$userModel = new \App\Models\UserModel();
	}

	public function index()
	{
		$dataa['datamenu'] = ['menu'=>"Dashboard"];
		$data['sidebar'] = view('layout/sidebar', $dataa);
		$data['header'] = view('layout/header');
		$data['content'] = view('home');
		return view('layout/layout', $data);
	}
}
