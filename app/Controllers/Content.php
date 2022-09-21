<?php namespace App\Controllers;
use App\Models\ContentModel;

class Content extends BaseController
{

	public function index(){
		$event = new ContentModel();
		$data['content'] = $event->findAll();

		echo view('Templates/header');
		echo view('Templates/sidebar');
        echo view('Content/index', $data);        
        echo view('Templates/footer');
	}

	public function index_kategori(){
		$event = new ContentModel();
		$data['kategori'] = $event->get_kategori_all();

		echo view('Templates/header');
		echo view('Templates/sidebar');
        echo view('Content/kategori_index', $data);        
        echo view('Templates/footer');
	}

	public function add_content(){
		$event = new ContentModel();
		$data['kategori'] = $event->get_kategori_all();
		$data['content'] = '';
		$data['menu']	= 'Tambah Content';
		$data['url']	= '/store_content';

		echo view('Templates/header');
		echo view('Templates/sidebar');
        echo view('Content/form-content', $data);        
        echo view('Templates/footer');
	}

	public function add_content_category(){
		$event = new ContentModel();
		$data['kategori'] = '';
		$data['url'] = '/store_content_category';
		$data['menu'] = 'Tambah Event';

		echo view('Templates/header');
		echo view('Templates/sidebar');
        echo view('Event/form-kategori', $data);
        echo view('Templates/footer');
	}

	public function delete_content(){
		$event = new ContentModel();
		$id 	= $this->request->getVar('id');
		$event->delete_content_by_id($id);
	}

	public function delete_content_category(){
		$event = new ContentModel();
		$id 	= $this->request->getVar('id');
		$event->delete_content_category_by_id($id);
	}

	public function edit_content(){
		if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = '';
        }
        
		$event = new ContentModel();
		$data['kategori'] = $event->get_kategori_all();
		$data['content'] = $event->get_content_by_id($id);
		$data['menu']	= 'Edit Content';
		$data['url']	= '/update_content';

		echo view('Templates/header');
		echo view('Templates/sidebar');
        echo view('Content/form-content', $data);        
        echo view('Templates/footer');
	}

	public function edit_content_category(){
		if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = '';
        }

		$event = new ContentModel();
		$data['kategori'] = $event->get_content_category_by_id($id);
		$data['url'] = '/store_event_category';
		$data['menu'] = 'Edit Kategori';

		echo view('Templates/header');
		echo view('Templates/sidebar');
        echo view('Event/form-kategori', $data);
        echo view('Templates/footer');
	}

	public function store_content(){
		$event = new ContentModel();
		$kategori 		= $this->request->getPost('kategori');
		$judul 			= $this->request->getPost('judul');
		$author			= $this->request->getPost('author');
		$tgl_content	= $this->request->getPost('tgl_content');
		$deskripsi		= $this->request->getPost('content_decription');
		$images			= $this->request->getFile('images');
		$tags			= $this->request->getFile('tags');

		$event->insert_content($kategori, $judul, $author, $tgl_content, $deskripsi, $images, $tags);

		return $this->response->redirect(base_url('/content'));
	}

	public function store_content_category(){
		$event = new ContentModel();
		$nama_kategori		= $this->request->getPost('nama_kategori');

		$event->insert_kategori($nama_kategori);
		return $this->response->redirect(base_url('/kategori_content'));
	}

	public function update_content(){
		if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = '';
        }

        $event = new ContentModel();
		$kategori 		= $this->request->getPost('kategori');
		$judul 			= $this->request->getPost('judul');
		$author			= $this->request->getPost('author');
		$tgl_content	= $this->request->getPost('tgl_content');
		$deskripsi		= $this->request->getPost('content_decription');
		$images			= $this->request->getFile('images');
		$tags			= $this->request->getFile('tags');

		$event->update_content($id, $kategori, $judul, $author, $tgl_content, $deskripsi, $images, $tags);

		return $this->response->redirect(base_url('/content'));
	}

	public function update_content_category(){
		if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = '';
        }

		$event = new ContentModel();
		$nama_kategori		= $this->request->getPost('nama_kategori');

		$event->update_kategori($id, $nama_kategori);
		return $this->response->redirect(base_url('/kategori_content'));
	}
}