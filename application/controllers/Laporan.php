<?php

class Laporan extends CI_Controller {
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data[ 'judul' ] = 'Kategori Buku';
        $data[ 'user' ] = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();
        $data[ 'kategori' ] = $this->ModelBuku->getKategori()->result_array();
        $data[ 'role' ] = $this->session->userdata( 'role_id' );
        $data[ 'laporanMasuk' ] = $this->ModelUser->ambilLaporanMasuk()->result_array();

        $this->form_validation->set_rules( 'kategori', 'Kategori', 'required', [
            'required' => 'Judul Buku harus diisi'
        ] );

        if ( $this->form_validation->run() == false ) {
            $this->load->view( 'templates/header', $data );
            $this->load->view( 'templates/sidebar', $data );
            $this->load->view( 'templates/topbar', $data );
            $this->load->view( 'buku/laporan', $data );
            $this->load->view( 'templates/footer' );
        } else {
            redirect( 'autentifikasi' ) ;
        }
    }

    public function acceptLaporan( $nomor_tiket ) {
        if ( $nomor_tiket === null ) {
            // Tindakan jika nomor tiket tidak ada ( misalnya, menampilkan pesan error )
            redirect( 'user' );
        }
        $data_request = $this->ModelUser->getRequest( $nomor_tiket );
        if ( $data_request == null ) {
            redirect( 'user' );
        }
        $add_laporan = $this->ModelUser->addLaporan( $data_request );
        redirect( 'datalaporan' );

    }
}
