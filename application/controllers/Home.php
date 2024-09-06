<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $this->load->view('home/templates/header');
        $this->load->view('home/index');
        $this->load->view('home/templates/footer');
    }

    public function kamar()
    {
        $data = [
            'kamar' => $this->m_admin->kamar(),
        ];

        $this->load->view('home/templates/header');
        $this->load->view('home/kamar', $data);
        $this->load->view('home/templates/footer');
    }

    public function tentang()
    {
        $this->load->view('home/templates/header');
        $this->load->view('home/tentang');
        $this->load->view('home/templates/footer');
    }

    public function kontak()
    {
        $this->load->view('home/templates/header');
        $this->load->view('home/kontak');
        $this->load->view('home/templates/footer');
    }

    public function detail_kamar($id_kamar)
    {
        $data = [
            'kamar' => $this->m_admin->get_kamar_by_id($id_kamar),
        ];

        $this->load->view('home/templates/header');
        $this->load->view('home/detail_kamar', $data);
        $this->load->view('home/templates/footer');
    }

    public function GuestMessage()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('subject', 'Judul', 'required');
        $this->form_validation->set_rules('message', 'Pesan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form lagi
            $this->load->view('home/kontak');
        } else {
            // Jika validasi sukses, simpan data ke database
            $data = array(
                'nama' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'judul' => $this->input->post('subject'),
                'pesan' => $this->input->post('message')
            );

            $this->m_admin->insert($data);

            // Tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Pesan berhasil dikirim!');
            redirect('home/kontak');
        }
    }
}
