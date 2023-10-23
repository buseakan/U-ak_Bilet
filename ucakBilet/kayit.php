<?php require_once("db.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Kaydol</title>
</head>

<body>
    <?php include("header.php") ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 mt-5">
            <form action="kayit.php" method="POST">
                <div style="display: flex;justify-content:center;">
                    <h1 class="display-5">Kayıt Ol</h1>
                </div>
                <div class="form-floating">
                    <input name="name" type="string" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Ad Soyad</label>
                </div>
                <div class="form-floating">
                    <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Eposta Adresi</label>
                </div>
                <div class="form-floating">
                    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Şifre</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Kayıt Ol</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
            </form>
        </div>
        <div class="col-md-4"></div>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<?php

if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $query = $db->prepare(("insert into users(name,email,password)values(?,?,?)"));
    $insert = $query->execute((array(
        $_POST["name"], $_POST["email"], sha1($_POST["password"])
    )));
    if ($insert) {
?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
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
                title: 'Kayıt işlemi başarılı'
            })
            setTimeout(() => {
                window.location.href = "/ucakbilet/giris.php";
            }, 1000);
        </script>
<?php
    }
}

?>