<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Printpdf extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model( 'ModelUser' );
    }

    public function print_laporan() {
        // Get the month and year from POST request
        $month = $this->input->post( 'month' );
        $year = $this->input->post( 'year' );

        // Convert month name to number
        $month_number = date( 'm', strtotime( $month ) );

        // Retrieve data from the model
        $data[ 'laporan' ] = $this->ModelUser->getLaporanByMonthYear( $month_number, $year );
        $data[ 'total_perbaikan_selesai' ] = $this->ModelUser->getPerbaikanSelesai();

        // Load the view for displaying the report
        $this->load->view( 'printpdf/print_laporan_view', $data );
    }
}
