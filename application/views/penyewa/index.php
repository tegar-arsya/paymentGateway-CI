<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
            </div>
        </div>

        <div class="row">
            <!-- Card 1: Durasi Sewa -->
            <div class="col-sm-6 col-md-4 mb-4">
                <div class="card card-stats card-round shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <p class="card-category mb-1">Durasi Sewa</p>
                                <?php
                                $found = false;
                                foreach ($total_jangka as $j) :
                                    if ($j['id_user'] == $user['id']) :
                                        $found = true;
                                ?>
                                        <h4 class="card-title"><?= $j['total_jangka'] ?> hari</h4>
                                    <?php
                                        break;
                                    endif;
                                endforeach;
                                if (!$found) : ?>
                                    <h4 class="card-title">Belum Sewa</h4>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Sisa Masa Sewa -->
            <div class="col-sm-6 col-md-4 mb-4">
                <div class="card card-stats card-round shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <p class="card-category mb-1">Sisa Masa Sewa</p>
                                <?php
                                $found = false;
                                foreach ($sisa_jangka as $j) :
                                    if ($j['id_user'] == $user['id']) :
                                        $found = true;
                                        if ($j['sisa_jangka'] === NULL) :
                                ?>
                                            <h4 class="card-title">Belum Dimulai</h4>
                                        <?php elseif ($j['sisa_jangka'] == 0) : ?>
                                            <h4 class="card-title">Sudah Berakhir</h4>
                                        <?php else : ?>
                                            <h4 class="card-title"><?= $j['sisa_jangka'] ?> hari</h4>
                                <?php
                                        endif;
                                        break;
                                    endif;
                                endforeach;
                                if (!$found) : ?>
                                    <h4 class="card-title">Belum Sewa</h4>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
