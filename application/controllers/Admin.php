<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_admin');
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('role_id') != 1) {
            redirect('auth');
        }
    }
    public function index()
    {
        $data = [
            'totalkamar' => $this->m_admin->TotalKamar(),
            'keluhan' => $this->m_admin->TotalKeluhan(),
            'kosong' => $this->m_admin->TotalKamarKosong(),
            'terisi' => $this->m_admin->TotalKamarTerisi(),
            'penghuni' => $this->m_admin->TotalPenghuni(),
            'saldo' => $this->m_admin->TotalSaldo(),
            'jangkawaktupenghuni' => $this->m_admin->JangkaWaktuPenghuni(),
        ];
        if ($data['saldo'] === null) {
            $data['saldo'] = 0;
        }

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function kamar()
    {
        $data = [
            'kamar' => $this->m_admin->kamar(),
            'kamar1' => $this->m_admin->kamar(),
        ];
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/kamar', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function tambah_kamar()
    {
        $no_kamar = $this->input->post('no_kamar');
        $kode_kamar = $this->input->post('kode_kamar');
        $harga = $this->input->post('harga');
        $deskripsi = $this->input->post('deskripsi');
        $fasilitas = $this->input->post('fasilitas');

        $config['upload_path'] = './uploads/kamar/';
        $config['allowed_types'] = 'jpg|png|gif';
        $config['overwrite'] = true;
        $config['max_size'] = '20000';
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);

        $files = $_FILES;
        $images = [];
        $error = false;

        foreach ($files['foto']['name'] as $key => $image) {
            $_FILES['foto[]']['name'] = $files['foto']['name'][$key];
            $_FILES['foto[]']['type'] = $files['foto']['type'][$key];
            $_FILES['foto[]']['tmp_name'] = $files['foto']['tmp_name'][$key];
            $_FILES['foto[]']['error'] = $files['foto']['error'][$key];
            $_FILES['foto[]']['size'] = $files['foto']['size'][$key];

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto[]')) {
                $error = true;
                $data['error'] = $this->upload->display_errors();
                break;
            } else {
                $images[] = $this->upload->data('file_name');
            }
        }

        if ($error) {
            $errorData = [
                'error' => $this->upload->display_errors()
            ];
            $this->session->set_flashdata('message', '<p class="text-danger"> Error: ' . $errorData['error'] . '</p> ');
            redirect('admin/kamar');
        } else {
            $data = [
                'no_kamar' => $no_kamar,
                'kode_kamar' => $kode_kamar,
                'harga' => $harga,
                'deskripsi' => $deskripsi,
                'status' => 0,
                'date_created' => time(),
                'foto' => json_encode($images),
                'fasilitas' => json_encode($fasilitas)
            ];
            $this->m_admin->tambah('tbl_kamar', $data);
            $this->session->set_flashdata('message', '<p class="text-success"> Kamar Berhasil Ditambahkan</p> ');
            redirect('admin/kamar');
        }
    }


    public function edit_kamar()
    {
        $id_kamar = $this->input->post('id_kamar');
        $no_kamar = $this->input->post('no_kamar');
        $kode_kamar = $this->input->post('kode_kamar');
        $harga = $this->input->post('harga');
        $deskripsi = $this->input->post('deskripsi');
        $fasilitas = $this->input->post('fasilitas');

        $foto = $_FILES['foto'];

        $config['upload_path'] = './uploads/kamar/';
        $config['allowed_types'] = 'jpg|png|gif';
        $config['overwrite'] = true;
        $config['max_size'] = '20000';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        $existing_images = $this->db->select('foto')->get_where('tbl_kamar', ['id_kamar' => $id_kamar])->row()->foto;
        $existing_images = json_decode($existing_images, true);

        // Ensure $existing_images is an array
        if (!is_array($existing_images)) {
            $existing_images = [];
        }

        $new_images = [];
        $error = false;

        foreach ($foto['name'] as $key => $image) {
            if (!empty($foto['name'][$key])) {
                $_FILES['foto[]']['name'] = $foto['name'][$key];
                $_FILES['foto[]']['type'] = $foto['type'][$key];
                $_FILES['foto[]']['tmp_name'] = $foto['tmp_name'][$key];
                $_FILES['foto[]']['error'] = $foto['error'][$key];
                $_FILES['foto[]']['size'] = $foto['size'][$key];

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('foto[]')) {
                    $error = true;
                    $data['error'] = $this->upload->display_errors();
                    $this->session->set_flashdata('message', 'Periksa file foto!');
                    break;
                } else {
                    $new_images[] = $this->upload->data('file_name');
                }
            }
        }

        if (!$error) {
            // Merge new and existing images
            $merged_images = array_merge($existing_images, $new_images);

            $data = [
                'no_kamar' => $no_kamar,
                'kode_kamar' => $kode_kamar,
                'harga' => $harga,
                'deskripsi' => $deskripsi,
                'date_created' => time(),
                'foto' => json_encode($merged_images),
                'fasilitas' => json_encode($fasilitas)
            ];

            $this->m_admin->ubah(['id_kamar' => $id_kamar], 'tbl_kamar', $data);
            $this->session->set_flashdata('message', '<p class="text-success"> Kamar Berhasil Diubah</p>');
        } else {
            $this->session->set_flashdata('message', 'Gagal mengunggah gambar baru.');
        }

        redirect('admin/kamar');
    }


    public function hapus_kamar($id_kamar)
    {
        $where = array('id_kamar' => $id_kamar);

        // Retrieve the existing images for the room
        $data = $this->m_admin->ambil_id_kamar('tbl_kamar', $id_kamar);
        $existing_images = json_decode($data->foto, true);

        // Path to the upload directory
        $path = './uploads/kamar/';

        // Delete each image file
        if (is_array($existing_images)) {
            foreach ($existing_images as $image) {
                $image_path = $path . $image;
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
            }
        }

        // Delete the room record from the database
        if ($this->m_admin->delete_kamar('tbl_kamar', $id_kamar)) {
            $this->session->set_flashdata('message', '<p class="text-danger"> Kamar Berhasil Dihapus</p> ');
        } else {
            $this->session->set_flashdata('message', 'Gagal menghapus kamar.');
        }

        redirect('admin/kamar');
    }

    public function penghuni()
    {
        $data = [
            'penghuni' => $this->m_admin->penghuni(),
        ];
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/penghuni', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function transaksi()
    {
        $data = [
            'transaksi' => $this->m_admin->transaksi(),
        ];
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/transaksi', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function laporan()
    {
        $data = [
            'laporan' => $this->m_admin->laporan(),
        ];

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function akun()
    {
        $data = [
            'akun' => $this->m_admin->akun(),
        ];

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/akun', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function keluhan()
    {
        $data = [
            'keluhan' => $this->m_admin->keluhan(),
        ];
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/keluhan', $data);
        $this->load->view('admin/templates/footer', $data);
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
        redirect('admin/keluhan');
    }
    public function hapus_akun($id)
    {
        $where = array('id' => $id);

        $this->m_admin->hapus($where, 'tbl_user');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Berhasil menghapus Akun!
</div>');
        redirect('admin/akun');
    }
    public function hapus_transaksi($order_id)
    {
        $where = array('order_id' => $order_id);

        $this->m_admin->hapus($where, 'tbl_transaksi');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Berhasil menghapus transaksi!
</div>');
        redirect('admin/transaksi');
    }

    public function hapus_penghuni($id_penghuni)
    {
        $where = array('id_penghuni' => $id_penghuni);

        $this->m_admin->hapus($where, 'tbl_penghuni');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Berhasil menghapus penghuni!
</div>');
        redirect('admin/penghuni');
    }


    public function profile()
    {
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function edit_profile()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No Hp', 'required|trim|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat Asal', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">' . validation_errors() . '</div>');
            redirect('admin/profile');
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
                    $old_picture = $this->m_admin->get_image($data['id']);
                    if ($old_picture && file_exists('./uploads/profile/' . $old_picture)) {
                        unlink('./uploads/profile/' . $old_picture);
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>');
                    redirect('admin/profile');
                }
            }

            if ($this->m_admin->update_profile($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Profile berhasil diubah!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Profile gagal diubah!</div>');
            }
            redirect('admin/profile');
        }
    }

    public function ubah_password()
    {
        $this->form_validation->set_rules('password1', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('password2', 'Password Baru', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('password3', 'Ulangi Password Baru', 'required|trim|matches[password2]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">' . validation_errors() . '</div>');
            redirect('admin/profile');
        } else {
            $id = $this->input->post('id');
            $current_password = $this->input->post('password1');
            $new_password = $this->input->post('password2');

            $user = $this->m_admin->get_user_by_id($id);

            if (password_verify($current_password, $user['password'])) {
                $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);

                if ($this->m_admin->update_password($id, $new_password_hash)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Password berhasil diubah!</div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Password gagal diubah!</div>');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Password lama salah!</div>');
            }
            redirect('admin/profile');
        }
    }

    // public function filter()
    // {
    //     $month = $this->input->get('month');
    //     $data['laporan'] = $this->m_admin->getLaporanByMonth($month);
    //     $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

    //     $this->load->view('admin/templates/sidebar', $data);
    //     $this->load->view('admin/laporan', $data);
    //     $this->load->view('admin/templates/footer', $data);
    // }

    // public function generate_pdf()
    // {
    //     $this->load->library('pdfgenerator');

    //     $month = $this->input->get('month');

    //     // Check if month is set and in the correct format
    //     if (empty($month) || !preg_match("/^\d{4}-\d{2}$/", $month)) {
    //         // If month is not set or invalid, use the current month
    //         $month = date('Y-m');
    //     }

    //     $data['laporan'] = $this->m_admin->getLaporanByMonth($month);

    //     if (empty($data['laporan'])) {
    //         echo "No data found for the month: " . $month;
    //         return;
    //     }

    //     $data['total_saldo'] = array_sum(array_column($data['laporan'], 'gross_amount'));
    //     $data['selected_month'] = $month;  // Pass the selected month to the view

    //     $html = $this->load->view('admin/pdf_laporan', $data, true);
    //     $this->pdfgenerator->generate($html, 'laporan_' . $month, true, 'A4', 'portrait');
    // }


    public function filter()
    {
        $year = $this->input->get('year');
        $month = $this->input->get('month');

        if (empty($year)) {
            $year = date('Y');
        }

        // Jika bulan kosong atau tidak valid, set ke null
        $month = (empty($month) || $month === '') ? null : intval($month);

        $data['laporan'] = $this->m_admin->getLaporanByYearMonth($year, $month);
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['selected_year'] = $year;
        $data['selected_month'] = $month;

        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function generate_pdf()
    {
        $this->load->library('pdfgenerator');

        $year = $this->input->get('year');
        $month = $this->input->get('month');

        if (empty($year) || !preg_match("/^\d{4}$/", $year)) {
            $year = date('Y');
        }

        // Jika bulan kosong atau tidak valid, set ke null
        $month = (empty($month) || $month === '') ? null : intval($month);

        $data['laporan'] = $this->m_admin->getLaporanByYearMonth($year, $month);

        if (empty($data['laporan'])) {
            echo "Tidak ada data dalam periode tersebut";
            return;
        }

        $data['total_saldo'] = array_sum(array_column(array_filter($data['laporan'], function ($row) {
            return $row['status_code'] == 200;
        }), 'gross_amount'));
        $data['selected_year'] = $year;
        $data['selected_month'] = $month;

        $period = $year . ($month ? '-' . sprintf("%02d", $month) : '');
        $html = $this->load->view('admin/pdf_laporan', $data, true);
        $this->pdfgenerator->generate($html, 'laporan_' . $period, true, 'A4', 'portrait');
    }
}
