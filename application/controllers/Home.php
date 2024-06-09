<?php

class Home extends CI_Controller {
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = [
            'judul' => 'Katalog Buku',
            'buku' => $this->ModelBuku->getBuku()->result(),
        ];

        // jika sudah login dan jika belum login
        if ( $this->session->userdata( 'email' ) ) {
            $user = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();

            $data[ 'user' ] = $user[ 'nama' ];

            $this->load->view( 'templates/templates-user/header', $data );
            $this->load->view( 'buku/daftarbuku', $data );
            $this->load->view( 'templates/templates-user/modal' );

            $this->load->view( 'templates/templates-user/footer', $data );
        } else {
            $data[ 'user' ] = 'Pengunjung';
            $this->load->view( 'templates/templates-user/header', $data );
            $this->load->view( 'buku/daftarbuku', $data );
            $this->load->view( 'templates/templates-user/modal' );

            $this->load->view( 'templates/templates-user/footer', $data );
        }
    }

    public function detailBuku() {
        // $id = $this->uri->segment( 3 );
        // $buku = $this->ModelBuku->joinKategoriBuku( [ 'buku.id' => $id ] )->result();
        // $data[ 'user' ] = 'Pengunjung';
        // $data[ 'title' ] = 'Detail Buku';
        // foreach ( $buku as $fields ) {
        //     $data[ 'judul' ] = $fields->judul_buku;
        //     $data[ 'pengarang' ] = $fields->pengarang;
        //     $data[ 'penerbit' ] = $fields->penerbit;
        //     $data[ 'kategori' ] = $fields->kategori;
        //     $data[ 'tahun' ] = $fields->tahun_terbit;
        //     $data[ 'isbn' ] = $fields->isbn;
        //     $data[ 'gambar' ] = $fields->image;
        //     $data[ 'dipinjam' ] = $fields->dipinjam;
        //     $data[ 'dibooking' ] = $fields->dibooking;
        //     $data[ 'stok' ] = $fields->stok;
        //     $data[ 'id' ] = $id;
        // }
        $data[ 'judul' ] = 'Kategori Buku';
        $data[ 'user' ] = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();
        $data[ 'kategori' ] = $this->ModelBuku->getKategori()->result_array();
        $data[ 'role' ] = $this->session->userdata( 'role_id' );

        $this->form_validation->set_rules( 'kategori', 'Kategori', 'required', [
            'required' => 'Judul Buku harus diisi'
        ] );
        $this->load->view( 'templates/header', $data );
        $this->load->view( 'templates/sidebar', $data );
        $this->load->view( 'templates/topbar', $data );
        $this->load->view( 'buku/detail-buku', $data );
        $this->load->view( 'templates/footer' );
    }
}
