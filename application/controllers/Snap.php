<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-a77sQB8yU5C82yXkJ7EPXzoB', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
		$this->load->library('form_validation');
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_penyewa');
	}

	public function index()
	{
		redirect('');
	}

	public function token()
	{

		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$kode_kamar = $this->input->post('kode_kamar');
		$harga = $this->input->post('harga');
		$id_kamar = $this->input->post('id_kamar');

		// Required
		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => $harga,
		);

		// Optional
		$item1_details = array(
			'id' => $id_kamar,
			'price' => $harga,
			'quantity' => 1,
			'name' => $kode_kamar,
		);

		// Optional
		$item_details = array($item1_details);


		// Optional
		$customer_details = array(
			'first_name'    => $nama,
			'email'         => $email,
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;

		$time = time();

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,

		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	public function finish()
	{
		$result = json_decode($this->input->post('result_data'), true);
		$type = $result['payment_type'];
		if ($type == 'bank_transfer') {
			$this->bank_transfer($result);
		} else if ($type == 'gopay') {
			$this->gopay($result);
		} else if ($type == 'qris') {
			$this->qris($result);
		} else if ($type == 'cstore') {
			$this->cstore($result);
		}
	}

	public function bank_transfer($result)
	{
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$id_kamar = $this->input->post('id_kamar');
		$id_user = $this->input->post('id_user');
		$checkin = $this->input->post('checkin');
		$checkout = $this->input->post('checkout');

		$data = [
			'order_id'	  		 => $result['order_id'],
			'customer_name'           => $nama,
			'customer_email'           => $email,
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,
			'gross_amount'		 => $result['gross_amount'],
			'payment_type' 		 => $result['payment_type'],
			'transaction_time'   => $result['transaction_time'],
			'bank'               => $result['va_numbers'][0]['bank'],
			'va_numbers'          => $result['va_numbers'][0]['va_number'],
			'status_message'     => $result['status_message'],
			'pdf_url'            => $result['pdf_url'],
			'transaction_status' => $result['transaction_status'],
			'status_code' => $result['status_code'],
			'finish_redirect_url' => $result['finish_redirect_url']
		];
		$data1 = [
			'id_transaksi'	  		 => $result['order_id'],
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,
			'tgl_pesan' => date('Y-m-d H:i:s'),
			'checkIn'           => $checkin,
			'checkOut'           => $checkout,
		];
		$data2 = [
			'id_transaksi'	  		 => $result['order_id'],
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,
			'tgl_sewa'           => $checkin,
			'tgl_habis'           => $checkout,
		];

		$data3 = [
			'id_transaksi'	  		 => $result['order_id'],
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,

		];

		$save = $this->m_penyewa->save_transaction($data);
		$save1 = $this->m_penyewa->save_penghuni($data1);
		$save2 = $this->m_penyewa->save_riwayat($data2);
		$save3 = $this->m_penyewa->save_laporan($data3);

		$this->m_penyewa->aktif($id_kamar);

		if ($save && $save1 && $save2 && $save3 == true) {
			$this->session->set_flashdata('message', '<p class="text-success"> Pembayaran Berhasil</p> ');
			redirect('penyewa/sewa');
		} else {
			$this->massage = "Error";
		}
	}

	public function gopay($result)
	{
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$id_kamar = $this->input->post('id_kamar');
		$id_user = $this->input->post('id_user');
		$checkin = $this->input->post('checkin');
		$checkout = $this->input->post('checkout');

		$data = [
			'order_id'	  		 => $result['order_id'],
			'customer_name'           => $nama,
			'customer_email'           => $email,
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,
			'gross_amount'		 => $result['gross_amount'],
			'payment_type' 		 => $result['payment_type'],
			'transaction_time'   => $result['transaction_time'],
			'status_message'     => $result['status_message'],
			'transaction_status' => $result['transaction_status'],
			'status_code' => $result['status_code'],
			'finish_redirect_url' => $result['finish_redirect_url'],
			// add
			'transaction_id' => $result['transaction_id']
		];
		$data1 = [
			'id_transaksi'	  		 => $result['order_id'],
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,
			'tgl_pesan' => date('Y-m-d H:i:s'),
			'checkIn'           => $checkin,
			'checkOut'           => $checkout,
		];
		$data2 = [
			'id_transaksi'	  		 => $result['order_id'],
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,
			'tgl_sewa'           => $checkin,
			'tgl_habis'           => $checkout,
		];

		$data3 = [
			'id_transaksi'	  		 => $result['order_id'],
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,

		];
		$save = $this->m_penyewa->save_transaction($data);
		$save1 = $this->m_penyewa->save_penghuni($data1);
		$save2 = $this->m_penyewa->save_riwayat($data2);
		$save3 = $this->m_penyewa->save_laporan($data3);

		$this->m_penyewa->aktif($id_kamar);

		if ($save && $save1 && $save2 && $save3 == true) {
			$this->session->set_flashdata('message', '<p class="text-success"> Pembayaran Berhasil</p> ');
			redirect('penyewa/sewa');
		} else {
			$this->massage = "Error";
		}
	}

	public function qris($result)
	{
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$id_kamar = $this->input->post('id_kamar');
		$id_user = $this->input->post('id_user');
		$checkin = $this->input->post('checkin');
		$checkout = $this->input->post('checkout');

		$data = [
			'order_id'	  		 => $result['order_id'],
			'customer_name'           => $nama,
			'customer_email'           => $email,
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,
			'gross_amount'		 => $result['gross_amount'],
			'payment_type' 		 => $result['payment_type'],
			'transaction_time'   => $result['transaction_time'],
			'status_message'     => $result['status_message'],
			'transaction_status' => $result['transaction_status'],
			'status_code' => $result['status_code'],
			'finish_redirect_url' => $result['finish_redirect_url'],
			// add
			'transaction_id' => $result['transaction_id']
		];
		$data1 = [
			'id_transaksi'	  		 => $result['order_id'],
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,
			'tgl_pesan' => date('Y-m-d H:i:s'),
			'checkIn'           => $checkin,
			'checkOut'           => $checkout,
		];
		$data2 = [
			'id_transaksi'	  		 => $result['order_id'],
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,
			'tgl_sewa'           => $checkin,
			'tgl_habis'           => $checkout,
		];
		$data3 = [
			'id_transaksi'	  		 => $result['order_id'],
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,

		];
		$save = $this->m_penyewa->save_transaction($data);
		$save1 = $this->m_penyewa->save_penghuni($data1);
		$save2 = $this->m_penyewa->save_riwayat($data2);

		$save3 = $this->m_penyewa->save_laporan($data3);

		$this->m_penyewa->aktif($id_kamar);

		if ($save && $save1 && $save2 && $save3 == true) {
			$this->session->set_flashdata('message', '<p class="text-success"> Pembayaran Berhasil</p> ');
			redirect('penyewa/sewa');
		} else {
			$this->massage = "Error";
		}
	}

	public function cstore($result)
	{
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$id_kamar = $this->input->post('id_kamar');
		$id_user = $this->input->post('id_user');
		$checkin = $this->input->post('checkin');
		$checkout = $this->input->post('checkout');

		$data = [
			'order_id'	  		 => $result['order_id'],
			'customer_name'           => $nama,
			'customer_email'           => $email,
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,
			'gross_amount'		 => $result['gross_amount'],
			'payment_type' 		 => $result['payment_type'],
			'transaction_time'   => $result['transaction_time'],
			'status_message'     => $result['status_message'],
			'pdf_url'            => $result['pdf_url'],
			'transaction_status' => $result['transaction_status'],
			'status_code' => $result['status_code'],
			'finish_redirect_url' => $result['finish_redirect_url'],
			//add
			'payment_code' => $result['payment_code']
		];
		$data1 = [
			'id_transaksi'	  		 => $result['order_id'],
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,
			'tgl_pesan' => date('Y-m-d H:i:s'),
			'checkIn'           => $checkin,
			'checkOut'           => $checkout,
		];
		$data2 = [
			'id_transaksi'	  		 => $result['order_id'],
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,
			'tgl_sewa'           => $checkin,
			'tgl_habis'           => $checkout,
		];
		$data3 = [
			'id_transaksi'	  		 => $result['order_id'],
			'id_kamar'           => $id_kamar,
			'id_user'           => $id_user,

		];
		$save = $this->m_penyewa->save_transaction($data);
		$save1 = $this->m_penyewa->save_penghuni($data1);
		$save2 = $this->m_penyewa->save_riwayat($data2);
		$save3 = $this->m_penyewa->save_laporan($data3);

		$this->m_penyewa->aktif($id_kamar);

		if ($save && $save1 && $save2 && $save3 == true) {
			$this->session->set_flashdata('message', '<p class="text-success"> Pembayaran Berhasil</p> ');
			redirect('penyewa/sewa');
		} else {
			$this->massage = "Error";
		}
	}
}
