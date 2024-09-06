<style>
/* General Section Styles */
.properties.section {
    padding: 60px 0;
    background-color: #f4f4f4;
}

.section-heading {
    margin-bottom: 40px;
}

.section-title {
    font-size: 28px;
    color: #444;
    text-transform: uppercase;
    position: relative;
    display: inline-block;
    padding-bottom: 10px;
    letter-spacing: 1.5px;
}

.section-title::before {
    content: '';
    position: absolute;
    left: 50%;
    bottom: 0;
    width: 80px;
    height: 4px;
    background-color: #007bff;
    transform: translateX(-50%);
}

/* Card Item Styles */
.item {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
    margin-bottom: 40px;
    padding: 20px;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.item:hover {
    transform: translateY(-12px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
}

.room-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-bottom: 2px solid #e5e5e5;
}

.item-details {
    padding: 20px;
}

.category {
    display: block;
    font-size: 16px;
    color: #555;
    margin-bottom: 12px;
}

.price {
    font-size: 20px;
    color: #007bff;
    margin-bottom: 12px;
    font-weight: bold;
}

.room-number {
    font-size: 18px;
    color: #333;
    margin-bottom: 25px;
}

.main-button {
    margin-top: 15px;
}

.main-button a {
    display: inline-block;
    padding: 12px 25px;
    font-size: 16px;
    color: white;
    background-color: #007bff;
    border-radius: 25px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.main-button a:hover {
    background-color: #0056b3;
}

/* Responsive Design */
@media (max-width: 768px) {
    .room-image {
        height: 180px;
    }

    .section-title {
        font-size: 22px;
    }
}

</style>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="section-heading">
                <h5 class="section-title">Daftar Kamar</h5>
            </div>
        </div>
    </div>
    <div class="row">
        <?php if (!empty($kamar)) : ?>
            <?php foreach ($kamar as $row) {
                $photos = json_decode($row['foto'], true);
                $first_photo = !empty($photos) ? $photos[0] : 'default-image.jpg';
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <img src="<?= base_url('uploads/kamar/' . $first_photo); ?>" alt="Room Image" class="room-image">
                        <div class="item-details">
                            <span class="category"><?= htmlspecialchars($row['kode_kamar']) ?></span>
                            <h6 class="price">Rp. <?= number_format($row['harga'], 0, ',', '.') ?></h6>
                            <h4 class="room-number">No Kamar: <?= htmlspecialchars($row['no_kamar']) ?></h4>
                            <div class="main-button">
                                <a href="<?= base_url(); ?>home/detail_kamar/<?= $row['id_kamar']; ?>">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php else : ?>
            <div class="col-12 text-center">
                <p>Data kamar tidak ditemukan.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
