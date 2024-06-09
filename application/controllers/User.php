<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // $data[ 'judul' ] = 'Profil Saya';
        // $data[ 'user' ] = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();

        // $this->load->view( 'templates/header', $data );
        // $this->load->view( 'templates/sidebar', $data );
        // $this->load->view( 'templates/topbar', $data );
        // $this->load->view( 'user/index', $data );
        // $this->load->view( 'templates/footer' );
        $data[ 'judul' ] = 'Dashboard';
        $data[ 'user' ] = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();
        $data[ 'jml_anggota' ] = $this->ModelUser->getTotalUser();
        $data[ 'perbaikan_selesai' ] = $this->ModelUser->getPerbaikanSelesai();
        $data[ 'jumlah_perbaikan' ] = $this->ModelUser->getJumlahLaporanTanpaDetail();
        $data[ 'jumlah_perbaikan_user' ] = $this->ModelUser->getJumlahLaporanTanpaDetailUser();
        $data[ 'data_perbaikan' ] = $this->ModelUser->getLaporanDanDetail();
        $data[ 'perbaikan_selesai_user' ] = $this->ModelUser->getPerbaikanSelesaiUser();
        //mengupdate stok dan dibooking pada tabel buku
        $data[ 'anggota' ] = $this->ModelUser->getUserLimit()->result_array();
        $data[ 'buku' ] = $this->ModelBuku->getLimitBuku()->result_array();
        $data[ 'role' ] = $this->session->userdata( 'role_id' );
        $data[ 'id' ] = $this->session->userdata( 'id' );
        $data[ 'user_id' ] = $this->session->userdata( 'user_id' );
        $detail = $this->db->query( "SELECT*FROM booking,booking_detail WHERE DAY(curdate()) < DAY(batas_ambil
) AND booking.id_booking=booking_detail.id_booking" )->result_array();
        foreach ( $detail as $key ) {
            $id_buku = $key[ 'id_buku' ];
            $batas = $key[ 'tgl_booking' ];
            $tglawal = date_create( $batas );
            $tglskrg = date_create();
            $beda = date_diff( $tglawal, $tglskrg );
            if ( $beda->days > 2 ) {
                $this->db->query( "UPDATE buku SET stok=stok+1, dibooking=dibooking-1 WHERE id='$id_buku'" );
            }
        }
        //menghapus otomatis data booking yang sudah lewat dari 2 hari
        $booking = $this->ModelBooking->getData( 'booking' );
        if ( !empty( $booking ) ) {
            foreach ( $booking as $bo ) {
                $id_booking = $booking->id_booking;
                $tglbooking = $booking->tgl_booking;
                $tglawal = date_create( $tglbooking );
                $tglskrg = date_create();
                $beda = date_diff( $tglawal, $tglskrg );
                if ( $beda->days > 2 ) {
                    $this->db->query( "DELETE FROM booking WHERE id_booking='$id_booking'" );
                    $this->db->query( "DELETE FROM booking_detail WHERE id_booking='$id_booking'" );
                }
            }
        }
        $this->load->view( 'templates/header', $data );
        $this->load->view( 'templates/sidebar', $data );
        $this->load->view( 'templates/topbar', $data );
        $this->load->view( 'admin/index', $data );
        $this->load->view( 'templates/footer' );
    }

    public function anggota() {
        $data[ 'judul' ] = 'Data Anggota';
        $data[ 'user' ] = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();
        $this->db->where( 'role_id', 1 );
        $data[ 'anggota' ] = $this->db->get( 'user' )->result_array();

        $this->load->view( 'templates/header', $data );
        $this->load->view( 'templates/sidebar', $data );
        $this->load->view( 'templates/topbar', $data );
        $this->load->view( 'user/anggota', $data );
        $this->load->view( 'templates/footer' );
    }

    public function ubahProfil() {
        $data[ 'judul' ] = 'Ubah Profil';
        $data[ 'user' ] = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();
        $data[ 'role' ] = $this->session->userdata( 'role_id' );

        $this->form_validation->set_rules( 'nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak Boleh Kosong'
        ] );

        if ( $this->form_validation->run() == false ) {
            $this->load->view( 'templates/header', $data );
            $this->load->view( 'templates/sidebar', $data );
            $this->load->view( 'templates/topbar', $data );
            $this->load->view( 'user/ubah-profile', $data );
            $this->load->view( 'templates/footer' );
        } else {
            $nama = $this->input->post( 'nama', true );
            $email = $this->input->post( 'email', true );

            //jika ada gambar yang akan diupload
            $upload_image = $_FILES[ 'image' ][ 'name' ];

            if ( $upload_image ) {
                $config[ 'upload_path' ] = './assets/img/profile/';
                $config[ 'allowed_types' ] = 'gif|jpg|png';
                $config[ 'max_size' ]     = '3000';
                $config[ 'max_width' ] = '1024';
                $config[ 'max_height' ] = '1000';
                $config[ 'file_name' ] = 'pro' . time();

                $this->load->library( 'upload', $config );

                if ( $this->upload->do_upload( 'image' ) ) {
                    $gambar_lama = $data[ 'user' ][ 'image' ];
                    if ( $gambar_lama != 'default.jpg' ) {
                        unlink( FCPATH . 'assets/img/profile/' . $gambar_lama );
                    }

                    $gambar_baru = $this->upload->data( 'file_name' );
                    $this->db->set( 'image', $gambar_baru );
                } else {
                }
            }

            $this->db->set( 'nama', $nama );
            $this->db->where( 'email', $email );
            $this->db->update( 'user' );

            $this->session->set_flashdata( 'pesan', '<div class="alert alert-success alert-message" role="alert">Profil Berhasil diubah </div>' );
            redirect( 'user' );
        }
    }

    public function ubahPassword() {
        $data[ 'judul' ] = 'Ubah Password';
        $data[ 'user' ] = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();

        $this->form_validation->set_rules( 'password_sekarang', 'Password Saat ini', 'required|trim', [
            'required' => 'Password saat ini harus diisi'
        ] );

        $this->form_validation->set_rules( 'password_baru1', 'Password Baru', 'required|trim|min_length[4]|matches[password_baru2]', [
            'required' => 'Password Baru harus diisi',
            'min_length' => 'Password tidak boleh kurang dari 4 digit',
            'matches' => 'Password Baru tidak sama dengan ulangi password'
        ] );

        $this->form_validation->set_rules( 'password_baru2', 'Konfirmasi Password Baru', 'required|trim|min_length[4]|matches[password_baru1]', [
            'required' => 'Ulangi Password harus diisi',
            'min_length' => 'Password tidak boleh kurang dari 4 digit',
            'matches' => 'Ulangi Password tidak sama dengan password baru'
        ] );

        if ( $this->form_validation->run() == false ) {
            $this->load->view( 'templates/header', $data );
            $this->load->view( 'templates/sidebar', $data );
            $this->load->view( 'templates/topbar', $data );
            $this->load->view( 'user/ubah-password', $data );
            $this->load->view( 'templates/footer' );
        } else {
            $pwd_skrg = $this->input->post( 'password_sekarang', true );
            $pwd_baru = $this->input->post( 'password_baru1', true );
            if ( !password_verify( $pwd_skrg, $data[ 'user' ][ 'password' ] ) ) {
                $this->session->set_flashdata( 'pesan', '<div class="alert alert-danger alert-message" role="alert">Password Saat ini Salah!!! </div>' );
                redirect( 'user/ubahPassword' );
            } else {
                if ( $pwd_skrg == $pwd_baru ) {
                    $this->session->set_flashdata( 'pesan', '<div class="alert alert-danger alert-message" role="alert">Password Baru tidak boleh sama dengan password saat ini!!! </div>' );
                    redirect( 'user/ubahPassword' );
                } else {
                    //password ok
                    $password_hash = password_hash( $pwd_baru, PASSWORD_DEFAULT );

                    $this->db->set( 'password', $password_hash );
                    $this->db->where( 'email', $this->session->userdata( 'email' ) );
                    $this->db->update( 'user' );

                    $this->session->set_flashdata( 'pesan', '<div class="alert alert-success alert-message" role="alert">Password Berhasil diubah</div>' );
                    redirect( 'user/ubahPassword' );
                }
            }
        }
    }
}
