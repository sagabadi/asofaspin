<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class LoginController extends BaseController
{
	public function login()
	{
	    $db  = \Config\Database::connect();
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $password = hash('sha256',$password);
        $row = $db->query("select * from password where passwd = '".$password."'");
		$event = $row->getResult();
		if($event && $username == 'admin'){
            $event = $row->getResult();
            $ses_data = [
                'username'      => 'admin',
                'logged_in'     => TRUE
            ];
            $session->set($ses_data);
            return redirect()->to('/dashboard');
        }else{
            $session->setFlashdata('msg', 'Username not Found');
            return redirect()->to('/');
        }
	}

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}