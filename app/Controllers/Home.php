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
        	$sql = "select * from hadiah";
			$query = $db->query($sql);
	        $cek_h = $query->getResult();
	        $data['hadiah_all'] = $cek_h;

	        $sql = "select * from hadiah where is_valuable = 1";
			$query = $db->query($sql);
	        $cek_v = $query->getResult();
	        $data['hadiah_valuable'] = $cek_v;

	        $data['degree'] = 360 / count($cek_h);

	        $data['percent'] = 100 / count($cek_h);
	        
        	echo view('Login/login');
        } else {
        	echo view('errors/404');
        }			
	}
}
