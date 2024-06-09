<?php if ( !defined( 'BASEPATH' ) ) exit( 'No Direct Script Access Allowed' );

class Datalaporan extends CI_Controller
 {
    public function __construct()
 {
        parent::__construct();
        $this->load->model( 'ModelUser' );
    }

    public function index()
 {
        $data[ 'judul' ] = 'Kategori Buku';
        $data[ 'user' ] = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();
        $data[ 'kategori' ] = $this->ModelBuku->getKategori()->result_array();
        $data[ 'role' ] = $this->session->userdata( 'role_id' );
        // $data[ 'laporan' ] = $this->ModelUser->getLaporan();
        $data[ 'laporan' ] = $this->ModelUser->getDetailRepair();

        $this->load->view( 'templates/header', $data );
        $this->load->view( 'templates/sidebar', $data );
        $this->load->view( 'templates/topbar', $data );
        $this->load->view( 'datalaporan/datalaporan', $data );
        $this->load->view( 'templates/footer', $data );

    }

    public function repair( $no_tiket ) {
        $datas = $this->ModelUser->getLaporanbyTiket( $no_tiket );
        redirect( 'datalaporan' );
    }

    public function show() {
        // Get the number of records to show from POST request
        $show = $this->input->post( 'show' );

        // Set a default value if no value is selected
        if ( !$show || !is_numeric( $show ) ) {
            $show = 10;
            // Default value
        }

        // Fetch the records from the database
        $data[ 'laporan' ] = $this->ModelUser->getLaporanLimit( $show );

        // Load the view with data
        $this->load->view( 'datalaporan/datalaporan', $data );
    }
}