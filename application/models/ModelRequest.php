<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class ModelRequest extends CI_Model
 {
    public function addrequest( $data ) {
        $this->db->insert( 'request', $data );

        // Cek apakah operasi insert berhasil
        if ( $this->db->affected_rows() > 0 ) {
            return true;
            // Jika berhasil
        } else {
            return false;
            // Jika gagal
        }

    }

    public function getUser( $data ) {
        $this->db->select( 'id, nama' );
        $this->db->where( 'email', $data );
        $this->db->from( 'user' );
        $query = $this->db->get();
        // Eksekusi query dan simpan hasilnya

        // Periksa apakah ada hasil dari query
        if ( $query->num_rows() > 0 ) {
            // Ambil baris pertama ( karena kita hanya mengambil ID )
            $row = $query->row();
            return $row->id;
            // Kembalikan ID user
        } else {
            return false;
            // Jika tidak ada hasil ( email tidak ditemukan )
        }
    }
}