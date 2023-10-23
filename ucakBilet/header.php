<?php session_start() ?>
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                <use xlink:href="#bootstrap" />
            </svg>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="index.php" class="nav-link px-2 link-secondary">Anasayfa</a></li>
            <?php
            if (isset($_COOKIE["id"])) {
            ?>
                <li>
                    <a href="mytickets.php" class="nav-link px-2 link-dark">Biletlerim</a>
                </li>
            <?php
            }
            ?>
            <?php
            if (isset($_COOKIE["id"]) && isset($_COOKIE["isAdmin"])) {
            ?>
                <li>
                    <a href="all_tickets.php" class="nav-link px-2 link-dark">Biletler</a>
                </li>
                <li>
                    <a href="all_airplanes.php" class="nav-link px-2 link-dark">Uçaklar</a>
                </li>
                <li>
                    <a href="all_cities.php" class="nav-link px-2 link-dark">Şehirler</a>
                </li>
                <li>
                    <a href="all_users.php" class="nav-link px-2 link-dark">Kullanıcılar</a>
                </li>
            <?php
            }
            ?>
        </ul>

        <div class="col-md-3 text-end">
            <?php

            if (isset($_COOKIE["id"])) {
            ?>
                <a href="cikis.php" class="btn btn-primary">Çıkış Yap</a>
            <?php
            } else {
            ?>
                <a href="giris.php" class="btn btn-outline-primary me-2">Giriş Yap</a>
                <a href="kayit.php" class="btn btn-primary">Kaydol</a>
            <?php
            }

            ?>
        </div>
    </header>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function logout() {
        <?php
        session_destroy();
        setcookie("name", time() - 1);
        ?>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title: 'Çıkış başarılı '
        })
        setTimeout(() => {
            window.location.href = "giris.php";
        }, 1000);
    }
</script>