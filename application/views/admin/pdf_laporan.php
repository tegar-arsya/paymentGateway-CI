<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Laporan Transaksi Kontrakan - <?= $selected_year . (isset($selected_month) ? ' - ' . date('F', mktime(0, 0, 0, $selected_month, 1)) : '') ?></h2>
    <table border="1" cellpadding="5" cellspacing="0">
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
            foreach ($laporan as $row) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['no_kamar'] ?></td>
                    <td><?= $row['kode_kamar'] ?></td>
                    <td><?= $row['nama_penghuni'] ?></td>
                    <td><?= date('d-m-Y', strtotime($row['transaction_time'])) ?></td>
                    <td>Rp.<?= number_format($row['gross_amount'], 0, ',', '.') ?></td>
                    <td><?= $row['status_code'] == 200 ? 'Berhasil' : 'Pending'; ?></td>
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
</body>

</html>