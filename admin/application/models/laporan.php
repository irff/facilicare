<?php

class Laporan extends CI_Model {
	function get_laporans($num=20, $start=0) {
		$this->db->select()->from('laporan')->order_by('waktu', 'desc')->limit($num,$start);
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_laporan($id) {
		$this->db->select()->from('laporan')->where(array('id'=>$id))->order_by('waktu','desc');
		$query = $this->db->get();
		return $query->first_row('array');
	}

	function get_laporan_count() {
		$this->db->select('id')->from('laporan');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function insert_laporan($data) {
		$this->db->insert('laporan', $data);
		return $this->db->insert_id();
	}

	function update_laporan($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('laporan', $data);
	}

	function delete_laporan($id) {
		$this->db->where('id', $id);
		$this->db->delete('laporan');
	}
}