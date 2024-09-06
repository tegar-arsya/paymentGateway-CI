<style>
/* Owl Carousel Item Styling */
.owl-carousel .item {
    height: 400px;
    background-size: cover;
    background-position: center;
    position: relative;
}

.item-1 {
    background-image: url('images/slide1.jpg');
}

.item-2 {
    background-image: url('images/slide2.jpg');
}

.item-3 {
    background-image: url('images/slide3.jpg');
}

/* Header Text Styling */
.header-text {
    position: absolute;
    bottom: 30px;
    left: 30px;
    color: #fff;
    background-color: rgba(0, 0, 0, 0.6);
    padding: 20px 30px;
    border-radius: 12px;
    max-width: 400px;
    font-family: 'Arial', sans-serif;
    animation: fadeInUp 1s ease-out;
}

.header-text h2 {
    margin: 0;
    font-size: 32px;
    font-weight: bold;
}

.header-text .category {
    font-size: 16px;
    font-style: italic;
}

/* Animasi */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Styling untuk FAQ Section */
.faq-section {
    padding: 60px 20px;
    background-color: #f0f0f0;
    font-family: 'Arial', sans-serif;
}

.faq-section h2 {
    text-align: center;
    margin-bottom: 40px;
    font-size: 32px;
    font-weight: bold;
    color: #333;
}

.faq-item {
    margin-bottom: 25px;
}

.faq-question {
    background-color: #007bff;
    color: white;
    padding: 15px 20px;
    cursor: pointer;
    border-radius: 8px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: background-color 0.3s ease;
}

.faq-question:hover {
    background-color: #0056b3;
}

.faq-answer {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    margin-top: 10px;
    border-left: 4px solid #007bff;
    overflow: hidden;
    display: none;
    opacity: 0;
    transition: opacity 0.3s ease;
}

/* FAQ Icon */
.faq-question::after {
    content: '+';
    font-size: 18px;
}

.faq-question.open::after {
    content: '-';
}

.faq-answer.open {
    display: block;
    opacity: 1;
}

.faq-answer ol {
    margin-left: 20px;
    padding-left: 20px;
}

.faq-answer li {
    margin-bottom: 10px;
}

/* Styling Responsif */
@media (max-width: 768px) {
    .main-banner {
        height: 300px;
    }

    .header-text {
        font-size: 14px;
        padding: 10px;
    }

    .faq-section h2 {
        font-size: 24px;
    }

    .faq-question {
        font-size: 14px;
        padding: 10px;
    }

    .faq-answer {
        padding: 10px;
    }
}
</style>

<div class="main-banner">
    <div class="owl-carousel owl-banner">
        <div class="item item-1">
            <div class="header-text">
                <span class="category">Kontrakan <em>Cendana</em></span>
                <h2>Ayo!<br>Dapatkan Kos Nyaman di Jawa Barat</h2>
            </div>
        </div>
        <div class="item item-2">
            <div class="header-text">
                <span class="category">Kontrakan <em>Cendana</em></span>
                <h2>Nikmati fasilitas lengkap dan akses mudah</h2>
            </div>
        </div>
        <div class="item item-3">
            <div class="header-text">
                <span class="category">Kontrakan <em>Cendana</em></span>
                <h2>Sewa Sekarang!</h2>
                <h3 style="color: white;">Temukan tempat yang sempurna untuk hidup produktif dan menyenangkan</h3>
            </div>
        </div>
    </div>
</div>

<!-- Section FAQ -->
<div class="faq-section">
    <h2>Frequently Asked Questions</h2>
    <div class="faq-item">
        <h3 class="faq-question">Bagaimana cara meyewa kontrakan?</h3>
        <div class="faq-answer">
            <p>Untuk menyewa kontrakan, ikuti langkah-langkah berikut:</p>
            <ol>
                <li>Pastikan Anda telah memiliki akun.</li>
                <li>Login dengan email dan password terdaftar.</li>
                <li>Pilih kamar dari menu "Sewa".</li>
                <li>Periksa detail kamar dan pilih tanggal check-in dan check-out.</li>
                <li>Konfirmasi sewa dan lakukan pembayaran.</li>
                <li>Setelah pembayaran berhasil, kamar akan terisi.</li>
                <li>Riwayat transaksi dapat dilihat di menu "Riwayat Sewa".</li>
            </ol>
        </div>
    </div>
    <div class="faq-item">
        <h3 class="faq-question">Apakah bisa melakukan survei terlebih dahulu?</h3>
        <div class="faq-answer">
            <p>Ya, Anda dapat menghubungi kami untuk survei lokasi.</p>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.faq-question').forEach(item => {
    item.addEventListener('click', () => {
        const answer = item.nextElementSibling;

        // Toggle open class for FAQ answer and question icon
        answer.classList.toggle('open');
        item.classList.toggle('open');
    });
});
</script>
