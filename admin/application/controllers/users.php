<?php

class Users Extends CI_Controller {
	function login() {
		$data['error'] = 0;

		if($_POST) {
			$this->load->model('user');
			$username = $this->input->post('username', true);
			$password = $this->input->post('password', true);
			$user = $this->user->login($username, $password);

			if(!$user) {
				$data['error'] = 1;
			} else {
				$this->session->set_userdata('userID', $user['userID']);
				$this->session->set_userdata('user_type', $user['user_type']);
				$this->session->set_userdata('username', $user['username']);
				redirect(base_url());
			}
		}
		$this->load->view('header');
		$this->load->view('login', $data);
		$this->load->view('footer');
	}

	function logout() {
		$this->session->sess_destroy();
		redirect(base_url());
	}
}