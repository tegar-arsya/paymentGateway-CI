
<div class="contact section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="section-heading text-center">
                    <h5 style="color: red; text-align:center;">| Kontak Kami</h5>
                    <h2>Lihat Lokasi Cendana dan Kontak kami Melalui</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div id="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3964.8007762302605!2d107.4521389!3d-6.4196389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMjUnMTAuNyJTIDEwN8KwMjcnMDcuNyJF!5e0!3m2!1sid!2sid!4v1723023643146!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="item phone">
                            <img src="<?= base_url('assets/images/phone-icon.png'); ?> " alt="" style="max-width: 52px;">
                            <h6>+62 856-2414-7174<br><span>Nomor Telepone</span></h6>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="item email">
                            <img src="<?= base_url('assets/images/email-icon.png'); ?> " alt="" style="max-width: 52px;">
                            <h6>cendana@gmail.com<br><span>Email</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                <?php endif; ?>
                <form id="contact-form" action="<?php echo base_url('home/GuestMessage'); ?>" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="name">Nama</label>
                                <input type="name" name="name" id="name" placeholder="Your Name..." autocomplete="on" required>
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your E-mail..." required="">
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="subject">Judul</label>
                                <input type="subject" name="subject" id="subject" placeholder="Subject..." autocomplete="on">
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="message">Pesan</label>
                                <textarea name="message" id="message" placeholder="Your Message"></textarea>
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <button type="submit" id="form-submit" class="orange-button">Kirim Pesan</button>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>