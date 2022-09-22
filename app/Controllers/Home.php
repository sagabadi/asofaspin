<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index($key)
	{	
		$db      = \Config\Database::connect();
		$sql = "select * from link_hadiah where keygen = '".$key."'";
		$query = $db->query($sql);
        $cek = $query->getResult();
        if($cek){
        	return view('Login/login');
        } 			
	}
}
