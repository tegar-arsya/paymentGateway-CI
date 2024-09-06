<?php

class Penyewa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_penyewa');
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('role_id') != 2) {
            redirect('auth');
        }
    }
    // public function index()
    // {
    //     $data = [
    //         'jangka' => $this->m_penyewa->JangkaWaktu(),
    //     ];
    //     $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

    //     $this->load->view('penyewa/templates/sidebar', $data);
    //     $this->load->view('penyewa/index', $data);
    //     $this->load->view('penyewa/templates/footer', $data);
    // }

    public function index()
    {
        $data = [
            'total_jangka' => $this->m_penyewa->JangkaWaktu(),
            'sisa_jangka' => $this->m_penyewa->JangkaWaktu(),
        ];
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('penyewa/templates/sidebar', $data);
        $this->load->view('penyewa/index', $data);
        $this->load->view('penyewa/templates/footer', $data);
    }
    public function sewa()
    {
        $data['kamar'] = $this->db->get('tbl_kamar')->result_array();
        $data['riwayat'] = $this->db->get('tbl_riwayat')->result_array();

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('penyewa/templates/sidebar', $data);
        $this->load->view('penyewa/sewa', $data);
        $this->load->view('penyewa/templates/footer', $data);
    }
    public function detail($id_kamar)
    {
        $data['kamar'] = $this->db->get_where('tbl_kamar', ['id_kamar' => $id_kamar])->row_array();
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('penyewa/templates/sidebar', $data);
        $this->load->view('penyewa/kamar_detail', $data);
        $this->load->view('penyewa/templates/footer', $data);
    }

    public function keluhan()
    {
        $data = [
            'riwayat' => $this->m_penyewa->riwayat(),
        ];
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('penyewa/templates/sidebar', $data);
        $this->load->view('penyewa/keluhan', $data);
        $this->load->view('penyewa/templates/footer', $data);
    }
    public function tambah_keluhan()
    {
        $id_kamar = $this->input->post('id_kamar');
        $id_user = $this->input->post('id_user');
        $keluhan = $this->input->post('keluhan');

        $gambar = $_FILES['gambar'];

        $config['upload_path'] = './uploads/keluhan/';
        $config['allowed_types'] = 'jpg|png|gif';
        $config['overwrite'] = true;
        $config['max_size']     = '20000';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar')) {
            $data = [
                'id_kamar' => $id_kamar,
                'id_user' => $id_user,
                'keluhan' => $keluhan,
            ];
            $this->m_penyewa->tambah('tbl_keluhan', $data);
            $this->session->set_flashdata('message', '<p class="text-success"> Keluhan Berhasil Terkirim</p> ');

            redirect('penyewa/keluhan');
        } else {
            $data = [
                'id_kamar' => $id_kamar,
                'id_user' => $id_user,
                'keluhan' => $keluhan,
                'gambar' => $this->upload->data('file_name')
            ];
            $this->m_penyewa->tambah('tbl_keluhan', $data);

            $this->session->set_flashdata('message', '<p class="text-success"> Keluhan Berhasil Terkirim</p> ');
            redirect('penyewa/keluhan');
        }
    }

    public function tanya()
    {
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('penyewa/templates/sidebar', $data);
        $this->load->view('penyewa/tanya', $data);
        $this->load->view('penyewa/templates/footer', $data);
    }
    public function riwayat()
    {
        $today = date('Y-m-d');
        $riwayat = $this->m_penyewa->riwayat();

        foreach ($riwayat as $row) {
            if ($row['tgl_habis'] == $today) {
                // Delete riwayat 
                $this->m_penyewa->deleteRiwayat($row['id_riwayat']);

                // Update kamar menjadi kosong ketika sewa habis
                $this->m_penyewa->updateKamarStatus($row['id_kamar'], 0);
            }
        }

        $data = [
            'riwayat' => $this->m_penyewa->riwayat(),
        ];

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('penyewa/templates/sidebar', $data);
        $this->load->view('penyewa/riwayat', $data);
        $this->load->view('penyewa/templates/footer', $data);
    }

    public function profile()
    {

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('penyewa/templates/sidebar', $data);
        $this->load->view('penyewa/profile', $data);
        $this->load->view('penyewa/templates/footer', $data);
    }
    public function edit_profile()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No Hp', 'required|trim|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat Asal', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">' . validation_errors() . '</div>');
            redirect('penyewa/profile');
        } else {
            $data = [
                'id' => $this->input->post('id'),
                'nama' => $this->input->post('nama'),
                'no_hp' => $this->input->post('no_hp'),
                'alamat' => $this->input->post('alamat'),
                'email' => $this->input->post('email')
            ];

            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = './uploads/profile/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048; // 2MB
                $config['file_name'] = $this->input->post('id') . '_' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $data['image'] = $upload_data['file_name'];

                    // Remove old picture if exists
                    $old_picture = $this->m_penyewa->get_image($data['id']);
                    if ($old_picture && file_exists('./uploads/profile/' . $old_picture)) {
                        unlink('./uploads/profile/' . $old_picture);
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>');
                    redirect('penyewa/profile');
                }
            }

            if ($this->m_penyewa->update_profile($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Profile berhasil diubah!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Profile gagal diubah!</div>');
            }
            redirect('penyewa/profile');
        }
    }

    public function ubah_password()
    {
        $this->form_validation->set_rules('password1', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('password2', 'Password Baru', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('password3', 'Ulangi Password Baru', 'required|trim|matches[password2]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">' . validation_errors() . '</div>');
            redirect('penyewa/profile');
        } else {
            $id = $this->input->post('id');
            $current_password = $this->input->post('password1');
            $new_password = $this->input->post('password2');

            $user = $this->m_penyewa->get_user_by_id($id);

            if (password_verify($current_password, $user['password'])) {
                $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);

                if ($this->m_penyewa->update_password($id, $new_password_hash)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Password berhasil diubah!</div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Password gagal diubah!</div>');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Password lama salah!</div>');
            }
            redirect('penyewa/profile');
        }
    }
}
