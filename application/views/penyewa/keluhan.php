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
                    <a href="#">Keluhan</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Keluhan</div>
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="<?= base_url(); ?>penyewa/tambah_keluhan" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_user" value="<?= $user['id'] ?>">
                                <div class="col-md-6 col-lg-8">
                                    <div class="form-group">
                                        <label for="defaultSelect">No Kamar</label>
                                        <select class="form-select form-control" id="id_kamar" name="id_kamar" required>
                                            <option selected disabled> Pilih No kamar </option>
                                            <?php foreach ($riwayat as $row) : ?>
                                                <?php if ($row['id_user'] == $user['id']) : ?>
                                                    <option value="<?= $row['id_kamar'] ?>"><?= $row['kode_kamar']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="keluhan">Keluhan</label>
                                        <textarea class="form-control" name="keluhan" rows="5" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="gambar" class="form-label">Gambar</label>
                                        <input type="file" class="form-control" id="gambar" name="gambar">
                                    </div>

                                </div>
                                <div class="card-action">
                                    <button type="submit" class="btn btn-success">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>