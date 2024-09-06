<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class m_admin extends CI_Model
{
    function kamar()
    {
        $this->db->select('*');
        $this->db->from('tbl_kamar');
        $this->db->order_by('id_kamar', 'DESC');
        return $this->db->get('')->result_array();
    }
    function get_kamar_by_id($id_kamar)
    {
        $this->db->select('*');
        $this->db->from('tbl_kamar');
        $this->db->where('id_kamar', $id_kamar);
        return $this->db->get()->row_array();
    }
    function transaksi()
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_kamar', 'tbl_transaksi.id_kamar= tbl_kamar.id_kamar');
        $this->db->join('tbl_user', 'tbl_transaksi.id_user= tbl_user.id');
        $this->db->order_by('order_id', 'DESC');
        return $this->db->get('')->result_array();
    }

    function laporan()
    {
        $this->db->select('*');
        $this->db->from('tbl_laporan');
        $this->db->join('tbl_kamar', 'tbl_laporan.id_kamar= tbl_kamar.id_kamar');
        $this->db->join('tbl_user', 'tbl_laporan.id_user= tbl_user.id', 'tbl_user.nama as nama_penghuni');
        $this->db->join('tbl_transaksi', 'tbl_laporan.id_transaksi= tbl_transaksi.order_id');
        $this->db->order_by('id_laporan', 'DESC');
        return $this->db->get('')->result_array();
    }

    function penghuni()
    {
        $this->db->select('*');
        $this->db->from('tbl_penghuni');
        $this->db->join('tbl_kamar', 'tbl_penghuni.id_kamar= tbl_kamar.id_kamar');
        $this->db->join('tbl_user', 'tbl_penghuni.id_user= tbl_user.id');
        $this->db->join('tbl_transaksi', 'tbl_penghuni.id_transaksi= tbl_transaksi.order_id');
        $this->db->order_by('id_penghuni', 'DESC');
        return $this->db->get('')->result_array();
    }
    public function JangkaWaktuPenghuni()
    {
        $this->db->select('*, 
            DATEDIFF(checkOut, checkIn) as total_jangka,
            CASE 
                WHEN CURDATE() < checkIn THEN NULL
                WHEN CURDATE() > checkOut THEN 0
                ELSE DATEDIFF(checkOut, GREATEST(CURDATE(), checkIn))
            END as sisa_jangka,
            checkIn,
            checkOut,
            id_user');
        $this->db->from('tbl_penghuni');
        $this->db->join('tbl_user', 'tbl_penghuni.id_user= tbl_user.id');
        $this->db->order_by('id_penghuni', 'DESC');
        return $this->db->get()->result_array();
    }
    function akun()
    {
        return $this->db->get_where('tbl_user', 'role_id = 2')->result_array();
    }

    public function TotalSaldo()
    {
        $this->db->select_sum('gross_amount');
        $this->db->where('status_code', 200);
        $query = $this->db->get('tbl_transaksi');
        return $query->row()->gross_amount;
    }
    public function TotalKamar()
    {
        return $this->db->get_where('tbl_kamar')->num_rows();
    }
    public function TotalPenghuni()
    {
        return $this->db->get_where('tbl_penghuni')->num_rows();
    }

    public function TotalKeluhan()
    {
        return $this->db->get_where('tbl_keluhan')->num_rows();
    }
    public function TotalKamarKosong()
    {
        $this->db->where('status', 0);
        return $this->db->get('tbl_kamar')->num_rows();
    }

    public function TotalKamarTerisi()
    {
        $this->db->where('status', 1);
        return $this->db->get('tbl_kamar')->num_rows();
    }
    function keluhan()
    {
        $this->db->select('*');
        $this->db->from('tbl_keluhan');
        $this->db->join('tbl_kamar', 'tbl_keluhan.id_kamar= tbl_kamar.id_kamar');
        $this->db->join('tbl_user', 'tbl_keluhan.id_user= tbl_user.id');
        $this->db->order_by('id_keluhan', 'DESC');
        return $this->db->get('')->result_array();
    }
    public function ambil_id_kamar($table, $id)
    {
        $this->db->from($table);
        $this->db->where('id_kamar', $id);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row();
        }
        return null;
    }

    public function delete_kamar($table, $id)
    {
        $this->db->where('id_kamar', $id);
        $this->db->delete($table);
        return $this->db->affected_rows() > 0;
    }
    public function ambil_id_keluhan($table, $id)
    {
        $this->db->from($table);
        $this->db->where('id_keluhan', $id);
        $result = $this->db->get('');
        if ($result->num_rows() > 0) {
            return $result->row();
        }
    }
    public function delete_keluhan($table, $id)
    {

        $this->db->where('id_keluhan', $id);
        $this->db->from($table);
        return true;
    }
    function tambah($table, $data)
    {
        $this->db->insert($table, $data);
    }
    function ubah($where, $table, $data)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function hapus($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_profile($data)
    {
        $this->db->where('id', $data['id']);
        return $this->db->update('tbl_user', $data);
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where('tbl_user', ['id' => $id])->row_array();
    }

    public function update_password($id, $new_password_hash)
    {
        $this->db->set('password', $new_password_hash);
        $this->db->where('id', $id);
        return $this->db->update('tbl_user');
    }
    public function get_image($id)
    {
        $this->db->select('image');
        $this->db->from('tbl_user');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result ? $result['image'] : null;
    }

    public function getLaporanByMonth($month)
    {
        $this->db->select('tbl_transaksi.*, tbl_kamar.no_kamar, tbl_kamar.kode_kamar, tbl_user.nama as nama_penghuni');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_kamar', 'tbl_transaksi.id_kamar = tbl_kamar.id_kamar');
        $this->db->join('tbl_user', 'tbl_transaksi.id_user = tbl_user.id');
        $this->db->where('DATE_FORMAT(tbl_transaksi.transaction_time, "%Y-%m") =', $month);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getLaporanByYearMonth($year, $month = null)
    {
        $this->db->select('tbl_transaksi.*, tbl_kamar.no_kamar, tbl_kamar.kode_kamar, tbl_user.nama as nama_penghuni');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_kamar', 'tbl_transaksi.id_kamar = tbl_kamar.id_kamar');
        $this->db->join('tbl_user', 'tbl_transaksi.id_user = tbl_user.id');
        $this->db->where('YEAR(tbl_transaksi.transaction_time)', $year);

        if ($month !== null) {
            $this->db->where('MONTH(tbl_transaksi.transaction_time)', $month);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    //GetMessage Kritik Dan saran
    public function insert($data)
    {
        $this->db->insert('kritik_saran', $data);
    }
}
