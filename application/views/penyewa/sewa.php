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
                    <a href="#">Sewa</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Pilih Kamar</div>
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No Kamar</th>
                                        <th>Kode Kamar</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kamar as $row) : ?>
                                        <?php if ($row['status'] != 1) : ?>
                                            <tr>
                                                <td><?= $row['no_kamar']; ?></td>
                                                <td><?= $row['kode_kamar']; ?></td>
                                                <td><?= $row['harga']; ?></td>
                                                <td><?= $row['status'] == 1 ? 'Penuh' : 'Kosong'; ?></td>
                                                <td>
                                                    <?php
                                                    $sewa = false;
                                                    foreach ($riwayat as $r) {
                                                        if ($r['id_user'] == $user['id']) {
                                                            $sewa = true;
                                                            break;
                                                        }
                                                    }
                                                    if ($sewa) : ?>
                                                        <a href="#" onclick="swal('Anda sudah sewa', ' Anda tidak dapat menyewa kamar ini lagi', 'error'); return false;" class="btn btn-info btn-sm">Lihat Detail</a>
                                                    <?php else : ?>
                                                        <a href="<?= base_url('penyewa/detail/' . $row['id_kamar']); ?>" class="btn btn-info btn-sm">Lihat Detail</a>
                                                    <?php endif; ?>
                                                    <!-- Add SweetAlert library -->
                                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>