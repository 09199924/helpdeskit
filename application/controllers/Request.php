<?php

class Request extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model( 'ModelRequest' );
    }

    public function enduser() {
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
        $this->load->view( 'enduser/form', $data );
        $this->load->view( 'templates/footer' );
    }

    public function infra() {
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
        $this->load->view( 'infra/form2', $data );
        $this->load->view( 'templates/footer' );
    }

    // public function sendrequest() {
    //     // }
    //     if ( !$this->session->userdata( 'email' ) ) {
    //         redirect( 'home' );
    //     }
    //     $this->form_validation->set_rules( 'nama', 'Nama Lengkap', 'required', [
    //         'required' => 'Nama Belum diis!!'
    //     ] );
    //     $this->form_validation->set_rules( 'judul', 'Judul Laporan', 'required', [
    //         'required' => 'Nama Belum diis!!'
    //     ] );
    //     $this->form_validation->set_rules( 'departemen', 'Departemen', 'required', [
    //         'required' => 'Nama Belum diis!!'
    //     ] );
    //     $this->form_validation->set_rules( 'sub', 'Sub Laporan', 'required', [
    //         'required' => 'Nama Belum diis!!'
    //     ] );
    //     $this->form_validation->set_rules( 'tingkat', 'Tingkat Urgency', 'required', [
    //         'required' => 'Nama Belum diis!!'
    //     ] );
    //     $this->form_validation->set_rules( 'nomor', 'Nomor. Ext', 'required', [
    //         'required' => 'Nama Belum diis!!'
    //     ] );
    //     $this->form_validation->set_rules( 'gambar', 'Pilih Gambar', 'required', [
    //         'required' => 'Nama Belum diis!!'
    //     ] );
    //     $this->form_validation->set_rules( 'deskripsi', 'Deskripsi', 'required', [
    //         'required' => 'Nama Belum diis!!'
    //     ] );
    //     if ( $this->form_validation->run() == false ) {
    //         $data[ 'judul' ] = 'Kategori Buku';
    //         $data[ 'user' ] = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();
    //         $data[ 'kategori' ] = $this->ModelBuku->getKategori()->result_array();
    //         $data[ 'role' ] = $this->session->userdata( 'role_id' );

    //         $this->load->view( 'templates/header', $data );
    //         $this->load->view( 'templates/sidebar', $data );
    //         $this->load->view( 'templates/topbar', $data );
    //         $this->load->view( 'enduser/form', $data );
    //         $this->load->view( 'infra/form2', $data );
    //         $this->load->view( 'templates/footer' );

    //     } else {
    //         $email = $this->session->userdata( 'email' );
    //         $id = $this->ModelRequest->getUser( $email );
    //         $timestamp = time();
    //         $date = date( 'Ymd' );
    //         // Mengambil timestamp saat ini
    //         $randomNumber = rand( 1000, 9999 );
    //         // Membuat angka acak 4 digit
    //         $nomor_tiket = 'TKT' . $date . $randomNumber;
    //         $data = [
    //             'id_pelapor' => $id,
    //             'nama' => $this->input->post( 'nama' ),
    //             'departemen' => $this->input->post( 'departemen' ),
    //             'judul_laporan' => $this->input->post( 'judul' ),
    //             'no_tiket' => $nomor_tiket,
    //             'sub_kategori' => $this->input->post( 'sub' ),
    //             'tingkat_urgency' => $this->input->post( 'tingkat' ),
    //             'no_ext' => $this->input->post( 'nomor' ),
    //             'image' => $this->input->post( 'gambar' ),
    //             'deskripsi' => $this->input->post( 'deskripsi' ),
    //         ];

    //         $this->ModelRequest->addrequest( $data );
    //         //menggunakan model

    //         $this->session->set_flashdata( 'pesan', '<div class="alert alert-success alert-message" role="alert">Selamat!! akun member anda sudah dibuat. Silahkan Aktivasi Akun anda</div>' );
    //         redirect( 'user' );
    //     }
    // }
    public function sendrequest() {
        if (!$this->session->userdata('email')) {
            redirect('home');
        }
    
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', [
            'required' => 'Nama Belum diisi!!'
        ]);
        $this->form_validation->set_rules('judul', 'Judul Laporan', 'required', [
            'required' => 'Judul Belum diisi!!'
        ]);
        $this->form_validation->set_rules('departemen', 'Departemen', 'required', [
            'required' => 'Departemen Belum diisi!!'
        ]);
        $this->form_validation->set_rules('sub', 'Sub Laporan', 'required', [
            'required' => 'Sub Laporan Belum diisi!!'
        ]);
        $this->form_validation->set_rules('tingkat', 'Tingkat Urgency', 'required', [
            'required' => 'Tingkat Urgency Belum diisi!!'
        ]);
        $this->form_validation->set_rules('nomor', 'Nomor. Ext', 'required', [
            'required' => 'Nomor. Ext Belum diisi!!'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', [
            'required' => 'Deskripsi Belum diisi!!'
        ]);
    
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Kategori Buku';
            $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
            $data['kategori'] = $this->ModelBuku->getKategori()->result_array();
            $data['role'] = $this->session->userdata('role_id');
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('enduser/form', $data);
            $this->load->view('infra/form2', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $this->session->userdata('email');
            $id = $this->ModelRequest->getUser($email);
            $timestamp = time();
            $date = date('Ymd');
            $randomNumber = rand(1000, 9999);
            $nomor_tiket = 'TKT' . $date . $randomNumber;
    
            // Configuring file upload
            $config['upload_path'] = './assets/img/upload/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB
            $config['encrypt_name'] = true; // Optional: to encrypt the file name
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('gambar')) {
                $uploadData = $this->upload->data();
                $image = $uploadData['file_name'];
            } else {
                // Display the error message
                $error = $this->upload->display_errors();
                echo $error;
                return;
            }
    
            $data = [
                'id_pelapor' => $id,
                'nama' => trim($this->input->post('nama', true)) ?: '',
                'departemen' => trim($this->input->post('departemen', true)) ?: '',
                'judul_laporan' => trim($this->input->post('judul', true)) ?: '',
                'no_tiket' => $nomor_tiket,
                'sub_kategori' => trim($this->input->post('sub', true)) ?: '',
                'tingkat_urgency' => trim($this->input->post('tingkat', true)) ?: '',
                'no_ext' => trim($this->input->post('nomor', true)) ?: '',
                'image' => $image,
                'deskripsi' => trim($this->input->post('deskripsi', true)) ?: '',
            ];
    
            $this->ModelRequest->addrequest($data);
    
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Laporan berhasil dikirim</div>');
            redirect('user');
        }
    }
    
    

}
