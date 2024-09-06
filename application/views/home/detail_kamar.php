<style>
    /* General Styling */
    .single-property.section {
        padding: 50px 0;
        background-color: #f8f9fa;
        margin-top: -50px;
    }

    .section-heading h5 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        text-align: center;
        margin-bottom: 30px;
        position: relative;
        display: inline-block;
    }

    .section-heading h5::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: -10px;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background-color: red;
        border-radius: 4px;
    }

    .carousel-inner img {
        height: 450px;
        object-fit: cover;
        border-radius: 8px;
    }

    .main-content {
        margin-top: 30px;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .main-content h4 {
        margin-bottom: 15px;
        color: #007bff;
    }

    .main-content span.category {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .info-table ul {
        list-style: none;
        padding: 0;
        margin-top: 30px;
    }

    .info-table li {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
        padding: 15px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .info-table li p {
        margin: 0;
        color: #333;
    }

    .fasilitas img {
        margin-right: 8px;
    }

    .fasilitas li {
        margin-bottom: 8px;
    }

    .icon-button a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .icon-button a i {
        margin-right: 8px; /* Adding space between the icon and the text */
    }

    .icon-button a:hover {
        background-color: #218838;
    }
</style>

<div class="single-property section">
    <div class="container">
        <div class="row">
            <div class="section-heading">
                <h5>| Detail Kamar</h5>
            </div>
            <div class="col-lg-8">
                <div id="kamarCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php if (!empty($kamar['foto'])) : ?>
                            <?php
                            $photos = json_decode($kamar['foto'], true);
                            foreach ($photos as $index => $photo) : ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <img src="<?= base_url('uploads/kamar/' . $photo) ?>" class="d-block w-100" alt="Room Image">
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

                <div class="main-content">
                    <span class="category"><?= htmlspecialchars($kamar['kode_kamar']) ?></span>
                    <h4>No Kamar : <?= htmlspecialchars($kamar['no_kamar']) ?></h4>
                    <h4>Rp. <?= number_format($kamar['harga'], 0, ',', '.') ?> /Bulan</h4>
                    <div>
                        <h4>Deskripsi:</h4>
                        <p><?= htmlspecialchars($kamar['deskripsi']) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="info-table">
                    <ul>
                        <li>
                            <span>Status:</span>
                            <p><?= $kamar['status'] == 1 ? 'Dihuni' : 'Kosong' ?></p>
                        </li>
                        <li>
                            <h5>Fasilitas:</h5>
                            <ul class="list-unstyled">
                                <?php
                                $IconFasilitas = [
                                    'WiFi' => 'wifi-icon.png',
                                    'AC' => 'ac-icon.png',
                                    'Televisi' => 'tv-icon.png',
                                    'Kulkas' => 'kulkas-icon.png',
                                    'Kasur' => 'kasur-icon.png',
                                    'Lemari' => 'lemari-icon.png',
                                    'Halaman Beratap' => 'halaman-icon.png'
                                ];

                                $selectedFasilitas = json_decode($kamar['fasilitas'], true);

                                if (!empty($selectedFasilitas)) {
                                    foreach ($selectedFasilitas as $fasilitas) {
                                        if (array_key_exists($fasilitas, $IconFasilitas)) {
                                            echo '<li><img src="' . base_url('assets/images/fasilitas/' . $IconFasilitas[$fasilitas]) . '" alt="' . htmlspecialchars($fasilitas) . '" style="max-width: 24px;"> ' . htmlspecialchars($fasilitas) . '</li>';
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="icon-button">
                            <a href="<?= base_url('auth'); ?>"><i class="fa fa-calendar"></i>PesanSekarang</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
