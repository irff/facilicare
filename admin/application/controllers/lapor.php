<?php

class Lapor extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('laporan');
	}

	function index($start = 0) {
		$data['laporans'] = $this->laporan->get_laporans(10, $start);
		$this->load->library('pagination');
		$config['base_url'] = base_url().'lapor/index/';
		$config['total_rows'] = $this->laporan->get_laporan_count();
		$config['per_page'] = 10;

		$this->pagination->initialize($config);
		$data['start'] = $start;
		$data['pages'] = $this->pagination->create_links();

		$this->load->view('header');
		$this->load->view('dashboard', $data);
		$this->load->view('footer');
	}

	function laporan($id) {
		$data['item'] = $this->laporan->get_laporan($id);
		$this->load->view('header');
		$this->load->view('laporan', $data);
		$this->load->view('footer');
	}

	function editlaporan($id) {
		if(!$this->session->userdata('userID')) {
			redirect(base_url().'users/login');
		}

		$data['success'] = 0;
		if($_POST) {
			$data_laporan = array(
				'laporan'=> $_POST['laporan'],
				'lokasi' => $_POST['lokasi'],
				'nama' => $_POST['nama'],
				'kategori' => $_POST['kategori'],
				'resolved' => $_POST['resolved']
			);
			unset($data['success']);
			$this->laporan->update_laporan($id, $data_laporan);
			$data['success'] = 1;
		}

		$data['item'] = $this->laporan->get_laporan($id);
		$this->load->view('header');
		$this->load->view('editlaporan', $data);
		$this->load->view('footer');
	}

	function deletelaporan($id) {
		if(!$this->session->userdata('userID')) {
			redirect(base_url().'users/login');
		}
		$this->laporan->delete_laporan($id);
		redirect(base_url());
	}
}