<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <!-- <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Dashboard</h6> -->
            </div>
            <!-- <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                <a href="#" class="btn btn-primary btn-round">Add Customer</a>
            </div> -->
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-luggage-cart"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Ketersedian Kamar</p>
                                    <!-- <h4 class="card-title"><?= $totalkamar ?></h4> -->

                                    <p class="card-subtitle">Kosong :
                                        <?= $kosong ?></p>
                                    <!-- <p class="card-subtitle">Kamar tersedia : <?= $totalkamar ?></p> -->
                                    <p class="card-subtitle">Terisi :
                                        <?= $terisi ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Jumlah Penghuni</p>
                                    <h4 class="card-title"><?= $penghuni ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="icon-wallet text-success"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Saldo</p>
                                    <h4 class="card-title">Rp.<?= number_format($saldo, 0, ',', '.') ?> </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                    <i class="fa fa-comment-alt"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Keluhan</p>
                                    <h4 class="card-title"><?= $keluhan ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <h3 class="text-center">Data Teggat penghuni</h3>
            <div class="table-responsive">
                <table class="display table table-striped table-hover">
                    <?= $this->session->flashdata('message'); ?>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Penghuni</th>
                            <th>Tanggal Sewa</th>
                            <th>Tanggal habis</th>
                            <th>Durasi sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($jangkawaktupenghuni as $row) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['checkIn'] ?></td>
                                <td><?= $row['checkOut'] ?></td>

                                <td>
                                    <?php if ($row['sisa_jangka'] === NULL) : ?>
                                        <p>Belum Dimulai</p>
                                    <?php else : ?>
                                        <?= $row['sisa_jangka'] ?> Hari
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>