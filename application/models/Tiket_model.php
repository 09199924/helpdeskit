<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Tiket_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load the database
        $this->load->database();
    }

    // Function to get tickets based on the user name

    public function getTiketByUser() {
        $cobanamatiga = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();

        $this->db->from( 'detail_laporan' );
        $this->db->where( 'nama', $cobanamatiga[ 'nama' ] );
        $query = $this->db->get();
        return $query->result_array();
    }
}
