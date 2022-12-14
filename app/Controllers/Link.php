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

	public function edit_is_claim(){
		$db      = \Config\Database::connect();
		if (isset($_GET['keygen'])) {
            $key = $_GET['keygen'];
        } else {
        	$key = '1sdad';
            echo view('errors/404');
        }

        if (isset($_GET['id_hadiah'])) {
            $id = $_GET['id_hadiah'];
        } else {
        	$id = '1sdad';
            echo view('errors/404');
        }
		$session = session();
		$event = new LinkModel();
		// $id = $this->request->getPost('id');
		$ins = $event->update_is_claim($key);
		$ins = $event->edit_relation($key, $id);
		$lin = $event->get_link_keygen($key);

		$sql = "select nama_hadiah, id_hadiah from relasi_hadiah join hadiah on(relasi_hadiah.id_hadiah = hadiah.id) where keygen = '".$key."'";
            $query = $db->query($sql);
            $ceks = $query->getResult();

        $sql = "select * from contact where is_use = 1";
            $query = $db->query($sql);
            $cekss = $query->getResult();

		$session->setFlashdata('edit', 'Success');
		$url = "https://wa.me/".$cekss[0]->masking."/?text=Halo!%0ASaya%20".$lin[0]->nama_buyer."%20mau%20klaim%20hadiah%20".$ceks[0]->nama_hadiah.".%20Alamat:%20%20".$lin[0]->alamat_buyer."%20.%20No%20HP:%20".$lin[0]->hp_buyer.".%20Terimakasih!";
		return $this->response->redirect($url);
	}

	public function update_relation(){
		$event = new LinkModel();
		if (isset($_GET['keygen'])) {
            $key = $_GET['keygen'];
        } else {
        	$key = '1sdad';
            echo view('errors/404');
        }
		if (isset($_GET['id_hadiah'])) {
            $id = $_GET['id_hadiah'];
        } else {
        	$id = '1sdad';
            echo view('errors/404');
        }
        $ins = $event->edit_relation($key, $id);
	}

	public function add_counter(){
		if (isset($_GET['keygen'])) {
            $key = $_GET['keygen'];
        } else {
        	$key = '1sdad';
            echo view('errors/404');
        }

        $session = session();
		$event = new LinkModel();
		// $id = $this->request->getPost('id');
		// $ins = $event->update_is_claim($key);
		$ins = $event->add_relation($key);
	}

}
