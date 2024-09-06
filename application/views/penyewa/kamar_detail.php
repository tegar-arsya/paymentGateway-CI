<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Detail Kamar</h3>
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
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Detail Kamar</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Detail Kamar</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form id="payment-form" method="post" action="<?= base_url('snap/finish') ?>">
                                    <p><strong>No Kamar : </strong> <?= $kamar['no_kamar']; ?></p>
                                    <p><strong>Kode Kamar : </strong> <?= $kamar['kode_kamar']; ?></p>
                                    <p><strong>Harga (per bulan) : </strong>Rp.<?= number_format($kamar['harga'], 0, ',', '.') ?> </p>
                                    <p><strong>Status : </strong> <?= $kamar['status'] == 1 ? 'Penuh' : 'Kosong'; ?></p>
                                    <div class="form-group">
                                        <label for="checkin">Tanggal Check-in</label>
                                        <input type="date" id="checkin" name="checkin" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="checkout">Tanggal Check-out</label>
                                        <input type="date" id="checkout" name="checkout" class="form-control" required>
                                    </div>

                                    <input type="hidden" name="result_type" id="result-type" value="">
                                    <input type="hidden" name="result_data" id="result-data" value="">
                                    <input type="hidden" name="email" id="email" value="<?= $user['email']; ?>">
                                    <input type="hidden" name="nama" id="nama" value="<?= $user['nama']; ?>">
                                    <input type="hidden" name="id_user" id="id_user" value="<?= $user['id']; ?>">
                                    <input type="hidden" name="id_kamar" id="id_kamar" value="<?= $kamar['id_kamar']; ?>">
                                    <input type="hidden" name="kode_kamar" id="kode_kamar" value="<?= $kamar['kode_kamar']; ?>">
                                    <input type="hidden" name="harga" id="harga" value="<?= $kamar['harga']; ?>">
                                    <input type="hidden" name="total_harga" id="total_harga" value="">
                                    <button type="submit" id="pay-button" class="btn btn-success">Sewa</button>
                                    <a href="<?= base_url('penyewa/sewa'); ?>" class="btn btn-secondary">Kembali</a>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div id="kamarCarousel" class="carousel slide">
                                    <div class="carousel-inner">
                                        <?php if (!empty($kamar['foto'])) : ?>
                                            <?php
                                            $photos = json_decode($kamar['foto'], true);
                                            foreach ($photos as $index => $photo) : ?>
                                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                    <img src="<?= base_url('uploads/kamar/' . $photo) ?>" class="d-block w-100" alt="">
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <a class="carousel-control-prev" href="#kamarCarousel" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#kamarCarousel" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-1i5gX-SgCXGprMgJ"></script>
<script type="text/javascript">
    $('#pay-button').click(function(event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");

        // Ambil data dari form
        var nama = $("#nama").val();
        var email = $("#email").val();
        var id_kamar = $("#id_kamar").val();
        var kode_kamar = $("#kode_kamar").val();
        var harga = $("#harga").val();
        var checkin = $("#checkin").val();
        var checkout = $("#checkout").val();

        // Hitung total harga
        var checkinDate = new Date(checkin);
        var checkoutDate = new Date(checkout);
        var months = (checkoutDate.getFullYear() - checkinDate.getFullYear()) * 12 + (checkoutDate.getMonth() - checkinDate.getMonth());
        var totalHarga = harga * months;

        $("#total_harga").val(totalHarga);

        // Kirim request ke backend untuk mendapatkan token pembayaran
        $.ajax({
            type: 'POST',
            url: '<?= site_url() ?>/snap/token',
            data: {
                nama: nama,
                email: email,
                id_kamar: id_kamar,
                kode_kamar: kode_kamar,
                harga: totalHarga
            },
            cache: false,
            success: function(data) {
                console.log('token = ' + data);

                snap.pay(data, {
                    onSuccess: function(result) {
                        $("#result-type").val('success');
                        $("#result-data").val(JSON.stringify(result));
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        $("#result-type").val('pending');
                        $("#result-data").val(JSON.stringify(result));
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        $("#result-type").val('error');
                        $("#result-data").val(JSON.stringify(result));
                        $("#payment-form").submit();
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error generating token:', textStatus, errorThrown);
            }
        });
    });
</script>
