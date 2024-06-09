<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Profile extends CI_Controller {
    public function __construct() {
        parent::__construct();
        cek_login();

    }

    public function index() {
        $data[ 'judul' ] = 'Dashboard Admin';
        $data[ 'user' ] = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();
        $data[ 'anggota' ] = $this->ModelUser->getUserLimit()->result_array();
        $data[ 'buku' ] = $this->ModelBuku->getLimitBuku()->result_array();
        $data[ 'role' ] = $this->session->userdata( 'role_id' );
        $data[ 'jml_anggota' ] = $this->ModelUser->getTotalUser();
        $data[ 'jumlah_perbaikan_user' ] = $this->ModelUser->getJumlahLaporanTanpaDetailUser();
        $data[ 'jumlah_perbaikan' ] = $this->ModelUser->getJumlahLaporanTanpaDetail();
        $data[ 'perbaikan_selesai' ] = $this->ModelUser->getPerbaikanSelesai();
        $data[ 'perbaikan_selesai_user' ] = $this->ModelUser->getPerbaikanSelesaiUser();
        //mengupdate stok dan dibooking pada tabel buku

        $this->load->view( 'templates/header', $data );
        $this->load->view( 'templates/sidebar', $data );
        $this->load->view( 'templates/topbar', $data );
        $this->load->view( 'user/index', $data );
        $this->load->view( 'templates/footer' );
    }
}
