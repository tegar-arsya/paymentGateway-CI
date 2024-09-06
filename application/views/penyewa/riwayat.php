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
                    <a href="#">Riwayat Sewa</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Riwayat Sewa</div>
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Kamar</th>
                                        <th>Kode Kamar</th>
                                        <th>Tanggal Sewa</th>
                                        <th>Tanggal Habis Sewa</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($riwayat as $row) : ?>
                                        <?php if ($row['id_user'] == $user['id']) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['no_kamar'] ?></td>
                                                <td><?= $row['kode_kamar'] ?></td>
                                                <td><?= date('d-m-Y', strtotime($row['tgl_sewa'])) ?></td>
                                                <td><?= date('d-m-Y', strtotime($row['tgl_habis'])) ?></td>
                                                <td><?= $row['status_code'] == 200 ? 'Berhasil' : 'Pending'; ?></td>
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