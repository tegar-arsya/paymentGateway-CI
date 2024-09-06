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
                    <a href="#">Profile</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Profil Akun</div>
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url(); ?>penyewa/edit_profile" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                        <input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>" placeholder="Nama" />
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp">No Hp</label>
                                        <input type="number" name="no_hp" class="form-control" value="<?= $user['no_hp'] ?>" placeholder="No HP " />
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat Asal</label>
                                        <input type="text" name="alamat" class="form-control" value="<?= $user['alamat'] ?>" placeholder="Alamat" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email2">Email Address</label>
                                        <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" placeholder=" Email" />
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Foto</label>
                                        <input type="file" name="image" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-a  ction">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Ubah Password</div>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url(); ?>penyewa/ubah_password" method="post">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="password1">Password Lama</label>
                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                        <input type="password" name="password1" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password2">Password Baru</label>
                                        <input type="password" name="password2" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password3">Ulangi Password Baru</label>
                                        <input type="password" name="password3" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>