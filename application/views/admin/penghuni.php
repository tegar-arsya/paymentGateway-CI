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
                    <a href="#">Data Penghuni</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4>Data Penghuni</h4>
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
                                        <th>No Kamar</th>
                                        <th>Kode Kamar</th>
                                        <th>Nama Penghuni</th>
                                        <th>Alamat</th>
                                        <th>CheckIn</th>
                                        <th>CheckOut</th>
                                        <!-- <th style="width: 10%">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($penghuni as $row) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['no_kamar'] ?></td>
                                            <td><?= $row['kode_kamar'] ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['alamat'] ?></td>
                                            <td><?= date('d-m-Y', strtotime($row['checkIn'])) ?></td>
                                            <td><?= date('d-m-Y', strtotime($row['checkOut'])) ?></td>
                                            <!-- <td>
                                                <div class="form-button-action">
                                                    <a href="<?= base_url('admin/hapus_penghuni/' . $row['order_id']) ?>" onClick='return confirm("Apakah anda yakin ingin menghapus akun ini?")' class="btn btn-link btn-danger"> <i class="fa fa-times"></i></a>
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