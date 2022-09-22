<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index($key)
	{	
		$db      = \Config\Database::connect();
		$sql = "select * from link_hadiah where keygen = '".$key."' and is_claim = 0";
		$query = $db->query($sql);
        $cek = $query->getResult();
        if($cek){
        	
	        
        	echo view('Login/login');
        } else {
        	echo view('errors/404');
        }			
	}
}
