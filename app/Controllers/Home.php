<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{	
		if (isset($_GET['keygen'])) {
            $key = $_GET['keygen'];
        } else {
        	$key = '1sdad';
            echo view('errors/404');
        }
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
