<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index($key)
	{
		return view('Login/login');
	}
}
