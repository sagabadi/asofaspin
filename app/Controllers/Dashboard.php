<?php namespace App\Controllers;
use App\Models\DashboardModel;

class Dashboard extends BaseController
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
		$event = new DashboardModel();
		$data['hadiah'] = $event->get_hadiah();

		echo view('Templates/header');
		echo view('Templates/sidebar');
        echo view('Dashboard/index', $data);        
        echo view('Templates/footer');
	}

	public function add_hadiah(){
		$session = session();
		$event = new DashboardModel();
		$nama_hadiah = $this->request->getPost('nama_hadiah');
		$is_valuable = $this->request->getPost('is_valuable');
		if($is_valuable == 'on'){
			$is_valuable = 1;
		} else {
			$is_valuable = 0;
		}
		$ins = $event->insert_hadiah($nama_hadiah, $is_valuable);
		$session->setFlashdata('add', 'Success');
		return $this->response->redirect(base_url('/dashboard'));
	}

	public function edit_hadiah(){
		$session = session();
		$event = new DashboardModel();
		$nama_hadiah = $this->request->getPost('nama_hadiah');
		$is_valuable = $this->request->getPost('is_valuable');
		if($is_valuable == 'on'){
			$is_valuable = 1;
		} else {
			$is_valuable = 0;
		}
		$id = $this->request->getPost('id');
		$ins = $event->update_hadiah($id, $nama_hadiah, $is_valuable);
		$session->setFlashdata('edit', 'Success');
		return $this->response->redirect(base_url('/dashboard'));
	}

	public function delete_hadiah(){
		$session = session();
		$event = new DashboardModel();
		$nama_hadiah = $this->request->getPost('nama_hadiah');
		$id = $this->request->getPost('id');
		$ins = $event->delete_hadiah($id);
		$session->setFlashdata('delete', 'Success');
		return $this->response->redirect(base_url('/dashboard'));
	}
}
