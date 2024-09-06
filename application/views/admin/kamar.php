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
                    <a href="#">Data Kamar</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4>Data Kamar</h4>
                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#TambahKamar">
                                <i class="fa fa-plus"></i>
                                Tambah Kamar
                            </button>
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
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th>Status Kamar</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($kamar as $row) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['no_kamar'] ?></td>
                                            <td><?= $row['kode_kamar'] ?></td>
                                            <td>Rp.<?= number_format($row['harga'], 0, ',', '.') ?></td>
                                            <td>
                                                <?php
                                                $images = json_decode($row['foto']);
                                                if ($images) {
                                                    foreach ($images as $image) {
                                                        echo '<img src="' . base_url('uploads/kamar/' . $image) . '" class="img-thumbnail" style="width:80px; height:80px; margin-right: 5px;">';
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <!-- <td>
                                                <?php
                                                $images = json_decode($row['foto'], true);
                                                if ($images && is_array($images) && count($images) > 0) {
                                                    $first_image = $images[0];
                                                    echo '<img src="' . base_url('uploads/kamar/' . $first_image) . '" class="img-thumbnail" style="width:80px; height:80px;">';
                                                }
                                                ?>
                                            </td> -->

                                            <td>
                                                <?= $row['status'] == 0 ? 'Kosong' : 'Terisi' ?>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#EditKamar<?= $row['id_kamar']; ?>" class="btn btn-link btn-primary btn-lg"><i class="fa fa-edit"></i></a>
                                                    <a href="<?= base_url('admin/hapus_kamar/' . $row['id_kamar']) ?>" onClick='return confirm("Apakah anda yakin ingin menghapus kamar ini?")' class="btn btn-link btn-danger"><i class="fa fa-times"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit Kamar -->
                                        <div class="modal fade" id="EditKamar<?= $row['id_kamar']; ?>" tabindex="-1" aria-labelledby="EditKamarLabel<?= $row['id_kamar']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="EditKamarLabel<?= $row['id_kamar']; ?>">Edit Kamar</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?= base_url(); ?>admin/edit_kamar" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="no_kamar" class="form-label">No Kamar</label>
                                                                <input type="hidden" value="<?= $row['id_kamar'] ?>" name="id_kamar">
                                                                <input type="text" class="form-control" id="no_kamar" name="no_kamar" value="<?= $row['no_kamar'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="kode_kamar" class="form-label">Kode Kamar</label>
                                                                <input type="text" class="form-control" id="kode_kamar" name="kode_kamar" value="<?= $row['kode_kamar'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="harga" class="form-label">Harga</label>
                                                                <input type="number" class="form-control" id="harga" name="harga" value="<?= $row['harga'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $row['deskripsi'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="fasilitas" class="form-label">Fasilitas</label><br>
                                                                <?php
                                                                $availableFasilitas = ['AC', 'Kasur', 'Lemari', 'Halaman Beratap'];
                                                                $selectedFasilitas = !empty($row['fasilitas']) ? json_decode($row['fasilitas'], true) : [];
                                                                foreach ($availableFasilitas as $fasilitas) {
                                                                    $checked = in_array($fasilitas, $selectedFasilitas) ? 'checked' : '';
                                                                    echo '<div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="fasilitas[]" value="' . $fasilitas . '" ' . $checked . '>
                        <label class="form-check-label">' . $fasilitas . '</label></div>';
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="foto" class="form-label">Foto</label>
                                                                <input type="file" class="form-control" id="foto" name="foto[]" multiple>
                                                                <div class="mt-2">
                                                                    <?php
                                                                    if ($images) {
                                                                        foreach ($images as $image) {
                                                                            echo '<img src="' . base_url('uploads/kamar/' . $image) . '" class="img-thumbnail" style="width:80px; height:80px; margin-right: 5px;">';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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

<!-- Modal Tambah Kamar -->
<div class="modal fade" id="TambahKamar" tabindex="-1" aria-labelledby="TambahKamarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TambahKamarLabel">Tambah Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/tambah_kamar') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="no_kamar" class="form-label">No Kamar</label>
                        <input type="text" class="form-control" id="no_kamar" name="no_kamar" required>
                    </div>
                    <div class="mb-3">
                        <label for="kode_kamar" class="form-label">Kode Kamar</label>
                        <input type="text" class="form-control" id="kode_kamar" name="kode_kamar" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                    </div>
                    <div class="mb-3">
                        <label for="fasilitas" class="form-label">Fasilitas</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="AC" id="fasilitas_ac" name="fasilitas[]">
                            <label class="form-check-label" for="fasilitas_ac">
                                AC
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Kasur" id="fasilitas_kasur" name="fasilitas[]">
                            <label class="form-check-label" for="fasilitas_kasur">
                                Kasur
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Lemari" id="fasilitas_lemari" name="fasilitas[]">
                            <label class="form-check-label" for="fasilitas_lemari">
                                Lemari
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Halaman Beratap" id="fasilitas_halaman" name="fasilitas[]">
                            <label class="form-check-label" for="fasilitas_halaman">
                                Halaman Beratap
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto[]" multiple required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>