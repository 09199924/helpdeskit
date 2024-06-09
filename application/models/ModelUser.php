<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class ModelUser extends CI_Model {
    public function simpanData( $data = null ) {
        $this->db->insert( 'user', $data );
    }

    public function cekData( $where = null ) {
        return $this->db->get_where( 'user', $where );
    }

    public function getUserWhere( $where = null ) {
        return $this->db->get_where( 'user', $where );
    }

    public function cekUserAccess( $where = null ) {
        $this->db->select( '*' );
        $this->db->from( 'access_menu' );
        $this->db->where( $where );
        return $this->db->get();
    }

    public function getUserLimit() {
        $this->db->select( '*' );
        $this->db->from( 'user' );
        $this->db->limit( 10, 0 );
        return $this->db->get();
    }

    public function getTotalUser() {
        $this->db->select( '*' );
        $this->db->from( 'user' );
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function ambilLaporanMasuk() {
        $this->db->select( '*' );
        $this->db->from( 'request' );
        return $this->db->get();

    }

    public function getRequest( $nomor_tiket ) {
        $this->db->where( 'no_tiket', $nomor_tiket );
        $query = $this->db->get( 'request' );
        return $query->row_array();
    }

    public function addLaporan( $datas ) {
        $data = [
            'id_pelapor' => $datas[ 'id_pelapor' ],
            'nama' => $datas[ 'nama' ],
            'departemen' => $datas[ 'departemen' ],
            'judul_laporan' => $datas[ 'judul_laporan' ],
            'no_tiket' => $datas[ 'no_tiket' ],
            'sub_kategori' => $datas[ 'sub_kategori' ],
            'tingkat_urgency' => $datas[ 'tingkat_urgency' ],
            'image' => $datas['image'],
            'no_ext' => $datas[ 'no_ext' ],
            'deskripsi' => $datas[ 'deskripsi' ],
        ];
        $this->db->insert( 'laporan', $data );
        $this->deleteLaporanMasuk( $datas[ 'no_tiket' ] );

    }

    private function deleteLaporanMasuk( $nomor_tiket ) {
        $this->db->where( 'no_tiket', $nomor_tiket );
        return $this->db->delete( 'request' );
    }

    public function getLaporan() {
        $this->db->select( '*' );
        $this->db->from( 'laporan' );
        $hasil = $this->db->get();
        return $hasil->result_array();

    }

    public function getLaporanbyTiket( $tiket ) {
        $this->db->where( 'no_tiket', $tiket );
        $this->db->from( 'laporan' );
        $hasil = $this->db->get()->row_array();
        $this->addtoDetailLaporan( $hasil );
    }

    private function addtoDetailLaporan( $datas ) {
        $data = [
            'id_pelapor' => $datas[ 'id_pelapor' ],
            'no_tiket' => $datas[ 'no_tiket' ],
            'judul' => $datas[ 'judul_laporan' ],
            'departemen' => $datas[ 'departemen' ],
            'isRepair' => 1,
            'nama' => $datas[ 'nama' ],
        ];
        $this->db->insert( 'detail_laporan', $data );

    }

    public function getDetailRepair() {
        $this->db->select( 'laporan.*, detail_laporan.isRepair' );
        $this->db->from( 'laporan' );
        $this->db->join( 'detail_laporan', 'laporan.no_tiket = detail_laporan.no_tiket', 'left' );
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPerbaikanSelesai() {
        $this->db->select( 'COUNT(*) as total' );
        $this->db->from( 'detail_laporan' );
        $this->db->where( 'isRepair', 1 );
        $query = $this->db->get();
        return $query->row()->total;
    }

    public function getJumlahLaporanTanpaDetail() {
        $this->db->select( 'COUNT(*) as total' );
        $this->db->from( 'laporan' );
        $this->db->join( 'detail_laporan', 'laporan.no_tiket = detail_laporan.no_tiket', 'left' );
        $this->db->where( 'detail_laporan.no_tiket IS NULL' );
        $query = $this->db->get();
        return $query->row()->total;
    }

    public function getPerbaikanSelesaiUser() {
        $cobanama = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();

        $this->db->select( 'COUNT(*) as total' );
        $this->db->from( 'detail_laporan' );
        $this->db->where( 'nama', $cobanama[ 'nama' ] );
        $query = $this->db->get();
        return $query->row()->total;
    }

    public function getJumlahLaporanTanpaDetailUser() {
        $cobanamadua = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();

        $this->db->select( 'COUNT(*) as total' );
        $this->db->from( 'laporan' );
        $this->db->join( 'detail_laporan', 'laporan.no_tiket = detail_laporan.no_tiket', 'left' );
        $this->db->where( 'laporan.nama', $cobanamadua[ 'nama' ] );
        // Specify the table for 'nama'
        $this->db->where( 'detail_laporan.no_tiket IS NULL' );
        // Added to match your initial requirement
        $query = $this->db->get();
        return $query->row()->total;
    }

    public function getLaporanDanDetail() {
        $this->db->select( 'laporan.nama, laporan.id, detail_laporan.isRepair' );
        $this->db->from( 'laporan' );
        $this->db->join( 'detail_laporan', 'laporan.no_tiket = detail_laporan.no_tiket', 'left' );
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getLaporanLimit( $limit ) {
        $this->db->select( '*' );
        $this->db->from( 'laporan' );
        $this->db->limit( $limit );
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getLaporanByMonthYear( $month, $year ) {
        $this->db->where( 'MONTH( created )', $month );
        $this->db->where( 'YEAR( created )', $year );
        $query = $this->db->get( 'laporan' );
        // Adjust table name as necessary
        return $query->result_array();
    }

    public function getLaporanAkhir() {
        $this->db->from( 'detail_laporan' );
        $query = $this->db->get();
        return $query->result_array();

    }

    public function getTiketByUser() {
        $cobanamatiga = $this->ModelUser->cekData( [ 'email' => $this->session->userdata( 'email' ) ] )->row_array();

        $this->db->from( 'detail_laporan' );
        $this->db->where( 'nama', $cobanamatiga[ 'nama' ] );
        $query = $this->db->get();
        return $query->result_array();
    }
}