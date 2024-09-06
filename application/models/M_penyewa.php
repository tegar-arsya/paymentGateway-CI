<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class m_penyewa extends CI_Model
{
    function kamar()
    {
        $this->db->select('*');
        $this->db->from('tbl_kamar');
        $this->db->order_by('id_kamar', 'DESC');
        return $this->db->get('')->result_array();
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
    public function save_transaction($data)
    {
        $save = $this->db->insert('tbl_transaksi', $data);
        if ($save) {
            return true;
        } else {
            return false;
        }
    }
    public function save_penghuni($data)
    {
        $save = $this->db->insert('tbl_penghuni', $data);
        if ($save) {
            return true;
        } else {
            return false;
        }
    }
    public function save_riwayat($data)
    {
        $save = $this->db->insert('tbl_riwayat', $data);
        if ($save) {
            return true;
        } else {
            return false;
        }
    }
    public function save_laporan($data)
    {
        $save = $this->db->insert('tbl_laporan', $data);
        if ($save) {
            return true;
        } else {
            return false;
        }
    }
    public function update_kamar_status($order_id, $status)
    {
        $this->db->where('order_id', $order_id);
        return $this->db->update('tbl_kamar', ['status' => $status]);
    }

    public function aktif($id_kamar)
    {
        $this->db->where('id_kamar', $id_kamar);
        $this->db->update('tbl_kamar', array('status' => 1));
    }
    function riwayat()
    {
        $this->db->select('*');
        $this->db->from('tbl_riwayat');
        $this->db->join('tbl_kamar', 'tbl_riwayat.id_kamar= tbl_kamar.id_kamar');
        $this->db->join('tbl_user', 'tbl_riwayat.id_user= tbl_user.id');
        $this->db->join('tbl_transaksi', 'tbl_riwayat.id_transaksi= tbl_transaksi.order_id');
        $this->db->order_by('id_riwayat', 'DESC');
        return $this->db->get('')->result_array();
    }

    public function deleteRiwayat($id_riwayat)
    {
        $this->db->where('id_riwayat', $id_riwayat);
        $this->db->delete('tbl_riwayat');
    }

    public function updateKamarStatus($id_kamar, $status)
    {
        $this->db->where('id_kamar', $id_kamar);
        $this->db->update('tbl_kamar', ['status' => $status]);
    }

    public function JangkaWaktu()
    {
        $this->db->select('*, 
            DATEDIFF(tgl_habis, tgl_sewa) as total_jangka,
            CASE 
                WHEN CURDATE() < tgl_sewa THEN NULL
                WHEN CURDATE() > tgl_habis THEN 0
                ELSE DATEDIFF(tgl_habis, GREATEST(CURDATE(), tgl_sewa))
            END as sisa_jangka,
            tgl_sewa,
            tgl_habis,
            id_user');
        $this->db->from('tbl_riwayat');
        $this->db->order_by('id_riwayat', 'DESC');
        return $this->db->get()->result_array();
    }
}
