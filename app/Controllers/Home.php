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
            $sql = "select nama_hadiah from relasi_hadiah join hadiah on(relasi_hadiah.id_hadiah = hadiah.id) where keygen = '".$key."'";
            $query = $db->query($sql);
            $ceks = $query->getResult();
            if($ceks){
        	    echo view('Login/login');
            } else {
                echo view('Login/klaim');
            }
        } else {
        	echo view('errors/404');
        }			
	}
}
