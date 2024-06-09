<?php if ( !defined( 'BASEPATH' ) ) exit( 'No Direct Script Access Allowed' );

class Download extends CI_Controller
 {
    public function __construct()
 {
        parent::__construct();
    }

    public function index()
 {
        $data[ 'judul' ] = 'Kategori Buku';
        $data[ 'user' ] = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();
        $data[ 'kategori' ] = $this->ModelBuku->getKategori()->result_array();
        $data[ 'role' ] = $this->session->userdata( 'role_id' );
        // $data[ 'laporanMasuk' ] = $this->ModelUser->ambilLaporanMasuk()->result_array();
        $data[ 'laporan' ] = $this->ModelUser->getDetailRepair();
        $data[ 'detail_laporan' ] = $this->ModelUser->getLaporanAkhir();

        $this->load->view( 'templates/header', $data );
        $this->load->view( 'templates/sidebar', $data );
        $this->load->view( 'templates/topbar', $data );
        $this->load->view( 'downloadpdf/download', $data );
        $this->load->view( 'templates/footer', $data );
    }
}