<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class LinkModel extends Model{
	public function get_link(){
		$db      = \Config\Database::connect();
		$sql = "select * from link_hadiah";
        $query = $db->query($sql);
        $cek = $query->getResult();
        return $cek;
	}

    public function insert_link($url, $nama_buyer, $hp_buyer, $alamat_buyer){
        $db      = \Config\Database::connect();
        $sql = "insert into link_hadiah(url, nama_buyer, hp_buyer, alamat_buyer, is_copy, is_claim) values('".$url."','".$nama_buyer."','".$hp_buyer."','".$alamat_buyer."',0,0)";
        $cek = $db->query($sql);
        // $cek = $query->getResult();
        return $cek;
    }

    public function update_is_copy($url){
        $db      = \Config\Database::connect();
        $sql = "update link_hadiah set is_copy = 1 where url = '".$url."'";
        $cek = $db->query($sql);
        // $cek = $query->getResult();
        return $cek;   
    }

    public function get_link_keygen($keygen){
        $db      = \Config\Database::connect();
        $sql = "select * from link_hadiah where keygen = '".$keygen."'";
        $query = $db->query($sql);
        $cek = $query->getResult();
        return $cek;
    }

    public function update_is_claim($keygen){
        $db      = \Config\Database::connect();
        $sql = "update link_hadiah set is_claim = 1 where keygen = '".$keygen."'";
        $cek = $db->query($sql);
        // $cek = $query->getResult();
        return $cek;   
    }

    public function add_relation($keygen){
        $db      = \Config\Database::connect();
        $sql = "insert into relasi_hadiah(keygen) values('".$keygen."')";
        $cek = $db->query($sql);
        // $cek = $query->getResult();
        return $cek;   
    }

    public function edit_relation($keygen, $id_hadiah){
        $db      = \Config\Database::connect();
        $sql = "update relasi_hadiah set id_hadiah = ".$id_hadiah." where keygen = '".$keygen."'";
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