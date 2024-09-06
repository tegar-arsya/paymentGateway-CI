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
                    <a href="#">Data Keluhan</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4>Data Keluhan</h4>
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
                                        <th>Kode Kamar</th>
                                        <th>Nama Penghuni</th>
                                        <th>Keluhan</th>
                                        <th>Gambar</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($keluhan as $row) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['kode_kamar'] ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['keluhan'] ?></td>
                                            <td><img src="<?= base_url('uploads/keluhan/' . $row['gambar']); ?>" class="img-thumbnail" style="width:80px; height:80px;"></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="<?= base_url('admin/hapus_keluhan/' . $row['id_keluhan']) ?>" onClick='return confirm("Apakah anda yakin ingin menghapus keluhan ini?")' class="btn btn-link btn-danger"> <i class="fa fa-times"></i></a>
                                                </div>
                                            </td>
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