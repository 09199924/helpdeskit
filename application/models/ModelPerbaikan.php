<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class ModelPerbaikan extends CI_Model
 {
    public function __construct()
 {
        parent::__construct();
    }

    public function getLaporanByMonthYear( $month, $year )
 {
        $this->db->where( 'MONTH(created)', $month );
        $this->db->where( 'YEAR(created)', $year );
        $query = $this->db->get( 'perbaikan' );
        // Adjust table name as necessary
        return $query->result_array();
    }
}
