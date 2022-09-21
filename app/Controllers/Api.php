<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController; 
use CodeIgniter\API\ResponseTrait;

class Api extends ResourceController
{
	public function get_event_all(){
		$db         = \Config\Database::connect();
		$row = $db->query("Select event_master.id as id, nama_event, tgl_event, jam_awal, jam_akhir, lokasi, organizer, nama_kategori as kategori, deskripsi, images from event_master join kategori_event on(event_master.kategori = kategori_event.id) where nama_kategori <>'Race' and tgl_event >= '".date("Y-m-d")."' order by tgl_event desc");
        $event = $row->getResult();
        if($event){
        	$msg = $event;
        	$response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
        } else {
        	$msg = 'Tidak Ada Data';
        	$response = [
                'status' => 400,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response);
	}

	public function get_event_race(){
		$db         = \Config\Database::connect();
		$row = $db->query("Select event_master.id as id, nama_event, tgl_event, jam_awal, jam_akhir, lokasi, organizer, nama_kategori as kategori, deskripsi, images from event_master join kategori_event on(event_master.kategori = kategori_event.id) where nama_kategori = 'Race' and tgl_event >= '".date("Y-m-d")."' order by tgl_event desc");
        $event = $row->getResult();
        if($event){
        	$msg = $event;
        	$response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
        } else {
        	$msg = 'Tidak Ada Data';
        	$response = [
                'status' => 400,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response);
	}

	public function get_race_detail($id, $id_user){
		$db         = \Config\Database::connect();
		$row = $db->query("Select event_master.id as id, nama_event, tgl_event, jam_awal, jam_akhir, lokasi, organizer, nama_kategori as kategori, deskripsi, images, (select count(id_user) from join_event where id_user = ".$id_user." and id_event = ".$id.") as sudah_terdaftar, (select count(id_user) from join_event where id_event = ".$id.") as orang_mendaftar from event_master join kategori_event on(event_master.kategori = kategori_event.id) where event_master.id = ".$id." order by tgl_event desc");
        $event = $row->getResult();
        if($event){
        	$msg = $event;
        	$response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
        } else {
        	$msg = 'Tidak Ada Data';
        	$response = [
                'status' => 400,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response);
	}

	public function get_event_detail($id, $id_user){
		$db         = \Config\Database::connect();
		$row = $db->query("Select event_master.id as id, nama_event, tgl_event, jam_awal, jam_akhir, lokasi, organizer, nama_kategori as kategori, deskripsi, images, (select count(id_user) from join_event where id_user = ".$id_user." and id_event = ".$id.") as sudah_terdaftar, (select count(id_user) from join_event where id_event = ".$id.") as orang_mendaftar from event_master join kategori_event on(event_master.kategori = kategori_event.id) where event_master.id = ".$id." order by tgl_event desc");
        $event = $row->getResult();
        if($event){
        	$msg = $event;
        	$response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
        } else {
        	$msg = 'Tidak Ada Data';
        	$response = [
                'status' => 400,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response);
	}

	public function list_upcoming_event($id_user){
		$db  = \Config\Database::connect();
		$row = $db->query("select id_user, id_event, nama_event, tgl_event, jam_awal, jam_akhir, lokasi, organizer, nama_kategori as kategori, deskripsi, images from join_event join event_master on(join_event.id_event = event_master.id) join kategori_event on(event_master.kategori = kategori_event.id) where id_user = ".$id_user." and tgl_event >= '".date("Y-m-d")."' order by tgl_event desc");
		$event = $row->getResult();
        if($event){
        	$msg = $event;
        	$response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
        } else {
        	$msg = 'Tidak Ada Data';
        	$response = [
                'status' => 400,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response);
	}


	public function list_past_event($id_user){
		$db  = \Config\Database::connect();
		$row = $db->query("select id_user, id_event, nama_event, tgl_event, jam_awal, jam_akhir, lokasi, organizer, nama_kategori as kategori, deskripsi, images from join_event join event_master on(join_event.id_event = event_master.id) join kategori_event on(event_master.kategori = kategori_event.id) where id_user = ".$id_user." and tgl_event < '".date("Y-m-d")."' order by tgl_event desc");
		$event = $row->getResult();
        if($event){
        	$msg = $event;
        	$response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
        } else {
        	$msg = 'Tidak Ada Data';
        	$response = [
                'status' => 400,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response);
	}

	public function edit_profil(){
		$db  = \Config\Database::connect();
		$nama = $this->request->getPost('nama');
		$alamat = $this->request->getPost('alamat');
		$email = $this->request->getPost('email');
		$no_hp = $this->request->getPost('nomor_hp');
		$profil_images = $this->request->getFile('profil_images');
		$profil_images->move('../public/assets/upload/profil');
		$user_id = $this->request->getPost('user_id');

		$filename = base_url('assets/upload/'.$profil_images->getClientName());

		$row = $db->query("update user_mobile set nama = '".$nama."', alamat = '".$alamat."', email = '".$email."', nomor_hp = '".$no_hp."', profil_images = '".$filename."' where id = ".$user_id."");
        // $event = $row->getResult();
        if($row){
        	$msg = "Data Telah Diupdate";
        	$response = [
                'status' => 200,
                'error' => false,
                'message' => $msg,
            ];
        } else {
        	$msg = 'Tidak Ada Data';
        	$response = [
                'status' => 400,
                'error' => true,
                'message' => $msg,
            ];
        }
        return $this->respond($response);
	}

	public function profil_detail($id){
		$db  = \Config\Database::connect();
		$row = $db->query("select nama, alamat, email, nomor_hp, profil_images from user_mobile where id = ".$id."");
		$event = $row->getResult();
        if($event){
        	$msg = $event;
        	$response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
        } else {
        	$msg = 'Tidak Ada Data';
        	$response = [
                'status' => 400,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response);
	}

	public function join_event($id, $id_user){
		$db  = \Config\Database::connect();
		$row = $db->query("insert into join_event values(".$id.",".$id_user.")");
        // $event = $row->getResult();
        if($row){
        	$msg = "Selamat, anda telah terdaftar!";
        	$response = [
                'status' => 200,
                'error' => false,
                'message' => $msg,
            ];
        } else {
        	$msg = 'Tidak Ada Data';
        	$response = [
                'status' => 400,
                'error' => true,
                'message' => $msg,
            ];
        }
        return $this->respond($response);
	}

	public function get_news(){
		$db  = \Config\Database::connect();
		$row = $db->query("Select * from news");
		$event = $row->getResult();
		if($event){
        	$msg = $event;
        	$response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
        } else {
        	$msg = 'Tidak Ada Data';
        	$response = [
                'status' => 400,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response);
	}

	public function get_news_detail($id){
		$db  = \Config\Database::connect();
		$row = $db->query("Select * from news where id =".$id."");
		$event = $row->getResult();
		if($event){
        	$msg = $event;
        	$response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
        } else {
        	$msg = 'Tidak Ada Data';
        	$response = [
                'status' => 400,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response);
	}

	public function login_default(){
		$db  = \Config\Database::connect();
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		$password = hash('sha256',$username.$password);
		$row = $db->query("select id, username, nama, alamat, email, nomor_hp, profil_images from user_mobile where username = '".$username."' and password = '".$password."'");
		$event = $row->getResult();
		if($event){
        	$msg = "Login Berhasil";
        	$response = [
                'status' => 200,
                'error' => false,
                'message' => $msg,
                'data'	=> $event
            ];
        } else {
        	$msg = 'User Tidak Ditemukan';
        	$response = [
                'status' => 400,
                'error' => true,
                'message' => $msg,
            ];
        }
        return $this->respond($response);
	}

	public function get_regulasi_all(){
		$db  = \Config\Database::connect();
		$row = $db->query("Select regulasi.id as id, judul_regulasi, nama_kategori, detail_regulasi from regulasi join kategori_regulasi on (regulasi.kategori = kategori_regulasi.id)");
		$event = $row->getResult();
		if($event){
        	$msg = $event;
        	$response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
        } else {
        	$msg = 'Tidak Ada Data';
        	$response = [
                'status' => 400,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response);
	}

	public function get_regulasi_detail($id){
		$db  = \Config\Database::connect();
		$row = $db->query("Select regulasi.id as id, judul_regulasi, nama_kategori, detail_regulasi from regulasi join kategori_regulasi on (regulasi.kategori = kategori_regulasi.id) where regulasi.id = ".$id."");
		$event = $row->getResult();
		if($event){
        	$msg = $event;
        	$response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
        } else {
        	$msg = 'Tidak Ada Data';
        	$response = [
                'status' => 400,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response);
	}

    public function upload_media(){
        $db  = \Config\Database::connect();
        $media_content = $this->request->getFile('media_content');
        $kategori = $this->request->getPost('kategori');
        $media_content->move('../public/assets/upload/media-content');
        $filename = base_url('assets/upload/media-content'.$media_content->getClientName());
        $row = $db->query("insert into media_content(content_file,kategori) values('".$filename."',".$kategori.")");

        if($row){
            $msg = "Data Telah Ditambahkan";
            $response = [
                'status' => 200,
                'error' => false,
                'message' => $msg,
            ];
        } else {
            $msg = 'Tidak Ada Data';
            $response = [
                'status' => 400,
                'error' => true,
                'message' => $msg,
            ];
        }
        return $this->respond($response);
    }
}