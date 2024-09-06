<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-server-y7Pq55YdhPBlLtZloSbEi-ly"></script>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Dashboard</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Data Transaksi</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4>Data Transaksi</h4>
                            <!-- <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#TambahKamar">
                                <i class="fa fa-plus"></i>
                                Tambah Kamar
                            </button> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <?= $this->session->flashdata('message'); ?>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order ID</th>
                                        <th>Kode Kamar</th>
                                        <th>Tgl Transaksi</th>
                                        <th>Nama Penghuni</th>
                                        <th>Pembayaran</th>
                                        <th>Bank</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <!-- <th style="width: 10%">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($transaksi as $row) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['order_id'] ?></td>
                                            <td><?= $row['kode_kamar'] ?></td>
                                            <td><?= $row['transaction_time'] ?></td>
                                            <td><?= $row['customer_name'] ?></td>
                                            <td><?= $row['payment_type'] ?></td>
                                            <td><?= $row['bank'] ?></td>
                                            <td>Rp.<?= number_format($row['gross_amount'], 0, ',', '.') ?> </td>
                                            <td>
                                                <span class="badge badge-sm <?= $row['status_code'] == 200 ? 'badge-success' : 'badge-danger'; ?>">
                                                    <?= $row['status_code'] == 200 ? 'Berhasil' : 'Pending'; ?>
                                                </span>
                                            </td>
                                            <!-- <td>
                                                <div class="form-button-action">
                                                    <a href="<?= base_url('admin/hapus_transaksi/' . $row['order_id']) ?>" onClick='return confirm("Apakah anda yakin ingin menghapus transaksi ini?")' class="btn btn-link btn-danger"> <i class="fa fa-times"></i></a>
                                                </div>
                                            </td> -->
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>