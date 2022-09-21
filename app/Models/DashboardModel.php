<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class DashboardModel extends Model{
	public function get_hadiah(){
		$db      = \Config\Database::connect();
		$sql = "select * from hadiah";
        $query = $db->query($sql);
        $cek = $query->getResult();
        return $cek;
	}

    public function insert_hadiah($nama_hadiah, $is_valuable){
        $db      = \Config\Database::connect();
        $sql = "insert into hadiah(nama_hadiah, is_valuable) values('".$nama_hadiah."',".$is_valuable.")";
        $cek = $db->query($sql);
        // $cek = $query->getResult();
        return $cek;
    }

    public function update_hadiah($id, $nama_hadiah, $is_valuable){
        $db      = \Config\Database::connect();
        $sql = "update hadiah set nama_hadiah = '".$nama_hadiah."', is_valuable = ".$is_valuable." where id = ".$id."";
        $cek = $db->query($sql);
        // $cek = $query->getResult();
        return $cek;   
    }

    public function delete_hadiah($id){
        $db      = \Config\Database::connect();
        $sql = "delete from hadiah where id = ".$id."";
        $cek = $db->query($sql);
        // $cek = $query->getResult();
        return $cek;     
    }

}