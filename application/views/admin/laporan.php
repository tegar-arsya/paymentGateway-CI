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
                    <a href="#">Data Laporan</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4>Data Laporan</h4>
                            <form method="get" action="<?= base_url('admin/filter') ?>" class="ms-auto">
                                <div class="input-group">
                                    <select name="year" class="form-control" required>
                                        <?php
                                        $current_year = date('Y');
                                        for ($i = $current_year; $i >= $current_year - 5; $i--) {
                                            $selected = (isset($selected_year) && $selected_year == $i) ? 'selected' : '';
                                            echo "<option value='$i' $selected>$i</option>";
                                        }
                                        ?>
                                    </select>
                                    <select name="month" class="form-control">
                                        <option value="">Semua Bulan</option>
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            $month_name = date('F', mktime(0, 0, 0, $i, 1));
                                            $selected = (isset($selected_month) && $selected_month == $i) ? 'selected' : '';
                                            echo "<option value='$i' $selected>$month_name</option>";
                                        }
                                        ?>
                                    </select>
                                    <button class="btn btn-primary" type="submit">Filter</button>
                                    <a href="<?= base_url('admin/generate_pdf') . '?year=' . (isset($selected_year) ? $selected_year : date('Y')) . (isset($selected_month) && $selected_month !== null ? '&month=' . $selected_month : '') ?>" class="btn btn-danger ms-2" target="_blank">Cetak PDF</a>
                                </div>
                            </form>
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
                                        <th>Tanggal Pembayaran</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $total_saldo = 0;
                                    foreach ($laporan as $row) {
                                        $total_saldo += $row['status_code'] == 200 ? $row['gross_amount'] : 0; ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['no_kamar'] ?></td>
                                            <td><?= $row['kode_kamar'] ?></td>
                                            <td><?= isset($row['nama_penghuni']) ? $row['nama_penghuni'] : $row['nama'] ?></td>
                                            <td><?= date('d-m-Y', strtotime($row['transaction_time'])) ?></td>
                                            <td>Rp.<?= number_format($row['gross_amount'], 0, ',', '.') ?></td>
                                            <td>
                                                <span class="badge badge-sm <?= $row['status_code'] == 200 ? 'badge-success' : 'badge-danger'; ?>">
                                                    <?= $row['status_code'] == 200 ? 'Berhasil' : 'Pending'; ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5">Total Saldo</th>
                                        <th colspan="2">Rp.<?= number_format($total_saldo, 0, ',', '.') ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>