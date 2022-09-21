<?php namespace App\Controllers;
use App\Models\LinkModel;

class Link extends BaseController
{

	public function getUserIpAddr(){
	    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
	        //ip from share internet
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	        //ip pass from proxy
	        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }else{
	        $ip = $_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}

	public function index(){
		$session = session();
		$event = new LinkModel();
		$data['link'] = $event->get_link();

		echo view('Templates/header');
		echo view('Templates/sidebar');
        echo view('Link/index', $data);        
        echo view('Templates/footer');
	}

	public function generate_link(){
		$session = session();
		$event = new LinkModel();
		$nama_buyer = $this->request->getPost('nama_buyer');
		$hp_buyer = $this->request->getPost('hp_buyer');
		$alamat_buyer = $this->request->getPost('alamat_buyer');
		$key = date("Y").''.date("m").''.date("d").''.date("H").''.date("i").''.''.date("s");
		$link = 'www.gombel.com/'.$key;
		$ins = $event->insert_link($link, $nama_buyer, $hp_buyer, $alamat_buyer);
		$session->setFlashdata('add', 'Success');
		return $this->response->redirect(base_url('/link'));
	}

	public function edit_is_copy(){
		$session = session();
		$event = new LinkModel();
		$id = $this->request->getPost('id');
		$ins = $event->update_is_copy($id);
		$session->setFlashdata('edit', 'Success');
		// echo $id;
		// return $this->response->redirect(base_url('/dashboard'));
	}

}
