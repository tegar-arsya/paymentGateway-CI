<?php

class Pemilik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_admin');
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('role_id') != 2) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('pemilik/templates/sidebar', $data);
        $this->load->view('pemilik/index', $data);
        $this->load->view('pemilik/templates/footer', $data);
    }
    public function kamar()
    {
        $data = [
            'kamar' => $this->m_admin->kamar(),
            'kamar1' => $this->m_admin->kamar(),
        ];
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('pemilik/templates/sidebar', $data);
        $this->load->view('pemilik/kamar', $data);
        $this->load->view('pemilik/templates/footer', $data);
    }

    public function tambah_kamar()
    {
        $no_kamar = $this->input->post('no_kamar');
        $kode_kamar = $this->input->post('kode_kamar');
        $harga = $this->input->post('harga');

        $foto = $_FILES['foto'];

        $config['upload_path'] = './uploads/kamar/';
        $config['allowed_types'] = 'jpg|png|gif';
        $config['overwrite'] = true;
        $config['max_size']     = '20000';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $data['error'] = $this->upload->display_errors();

            redirect('pemilik/kamar');
        } else {
            $data = [
                'no_kamar' => $no_kamar,
                'kode_kamar' => $kode_kamar,
                'harga' => $harga,
                'status' => 0,
                'date_created' => time(),
                'foto' => $this->upload->data('file_name')
            ];
            $this->m_admin->tambah('tbl_kamar', $data);
            $this->session->set_flashdata('message', '<p class="text-success"> Kamar Berhasil Ditambahkan</p> ');
            redirect('pemilik/kamar');
        }
    }

    public function edit_kamar()
    {
        $id_kamar = $this->input->post('id_kamar');
        $no_kamar = $this->input->post('no_kamar');
        $kode_kamar = $this->input->post('kode_kamar');
        $harga = $this->input->post('harga');

        $foto = $_FILES['foto'];

        if (empty($foto['name'])) {
            $data = [
                'no_kamar' => $no_kamar,
                'kode_kamar' => $kode_kamar,
                'harga' => $harga,
                'date_created' => time(),
            ];
            $this->m_admin->ubah(['id_kamar' => $id_kamar], 'tbl_kamar', $data);
            $this->session->set_flashdata('message', '<p class="text-success"> Kamar Berhasil Diubah</p> ');
            redirect('pemilik/kamar');
        } else {
            $config['upload_path'] = './uploads/kamar/';
            $config['allowed_types'] = 'jpg|png|gif';
            $config['overwrite'] = true;
            $config['max_size']     = '20000';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto')) {
                $data['error'] = $this->upload->display_errors();
                $this->session->set_flashdata('message', 'Periksa file foto!');

                redirect('pemilik/kamar');
            } else {
                $f = $this->db->select('foto')->get_where('tbl_kamar', ['id_kamar' => $id_kamar])->row();
                unlink('./uploads/kamar/' . $f->foto);
                $data = [
                    'no_kamar' => $no_kamar,
                    'kode_kamar' => $kode_kamar,
                    'harga' => $harga,
                    'date_created' => time(),
                    'foto' => $this->upload->data('file_name')
                ];
                $this->m_admin->ubah(['id_kamar' => $id_kamar], 'tbl_kamar', $data);
                $this->session->set_flashdata('message', '<p class="text-success"> Kamar Berhasil Diubah</p> ');
                redirect('pemilik/kamar');
            }
        }
    }

    public function hapus_kamar($id_kamar)
    {
        $where = array('id_kamar' => $id_kamar);

        $data = $this->m_admin->ambil_id_kamar('tbl_kamar', $id_kamar);
        $path = './uploads/kamar/';
        @unlink($path . $data->foto);
        if ($this->m_admin->delete_kamar('tbl_kamar', $id_kamar) == true) {
            # code...
            $this->m_admin->hapus($where, 'tbl_kamar');

            $this->session->set_flashdata('message', '<p class="text-danger"> Kamar Berhasil Dihapus</p> ');
        }
        redirect('pemilik/kamar');
    }
    public function penghuni()
    {
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('pemilik/templates/sidebar', $data);
        $this->load->view('pemilik/penghuni', $data);
        $this->load->view('pemilik/templates/footer', $data);
    }
    public function keluhan()
    {
        $data = [
            'keluhan' => $this->m_admin->keluhan(),
        ];
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('pemilik/templates/sidebar', $data);
        $this->load->view('pemilik/keluhan', $data);
        $this->load->view('pemilik/templates/footer', $data);
    }
    public function hapus_keluhan($id_keluhan)
    {
        $where = array('id_keluhan' => $id_keluhan);

        $data = $this->m_admin->ambil_id_keluhan('tbl_keluhan', $id_keluhan);
        $path = './uploads/keluhan/';
        @unlink($path . $data->foto);
        if ($this->m_admin->delete_keluhan('tbl_keluhan', $id_keluhan) == true) {
            # code...
            $this->m_admin->hapus($where, 'tbl_keluhan');

            $this->session->set_flashdata('message', '<p class="text-danger"> Keluhan Berhasil Dihapus</p> ');
        }
        redirect('pemilik/keluhan');
    }
    public function laporan()
    {
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('pemilik/templates/sidebar', $data);
        $this->load->view('pemilik/laporan', $data);
        $this->load->view('pemilik/templates/footer', $data);
    }
}
