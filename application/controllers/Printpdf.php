<?php if ( !defined( 'BASEPATH' ) ) exit( 'No Direct Script Access Allowed' );

class Printpdf extends CI_Controller
 {
    public function __construct() {
        parent::__construct();
        $this->load->model( 'ModelUser' );
    }

    public function index()
 {
        $data[ 'judul' ] = 'Kategori Buku';
        $data[ 'user' ] = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();
        $data[ 'kategori' ] = $this->ModelBuku->getKategori()->result_array();
        $data[ 'role' ] = $this->session->userdata( 'role_id' );
        $data[ 'laporan' ] = $this->ModelUser->getDetailRepair();
        $data[ 'detail_laporan' ] = $this->ModelUser->getLaporanAkhir();

        $this->load->view( 'templates/header', $data );
        $this->load->view( 'templates/sidebar', $data );
        $this->load->view( 'templates/topbar', $data );
        $this->load->view( 'printpdf/print', $data );
        $this->load->view( 'templates/footer', $data );
    }

    //     public function print_laporan()
    // {
    //         $data[ 'no_tiket' ] = $this->ModelUser->getLaporan()->result_array();
    //         $data[ 'departemen' ] = $this->ModelUser->getLaporan()->result_array();
    //         $data[ 'nama' ] = $this->ModelUser->getLaporan()->result_array();
    //         $data[ 'created' ] = $this->ModelUser->getLaporan()->result_array();

    //         $this->load->view( 'printpdf/cetak', $data );
    // }

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
        $this->load->view( 'cetak', $data );
    }
}