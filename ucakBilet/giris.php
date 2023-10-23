<?php require_once("db.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Giriş Yap</title>
</head>

<body>
    <?php include("header.php") ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 mt-5">
            <form action="giris.php" method="POST">
                <div style="display: flex;justify-content:center;">
                    <h1 class="display-5">Giriş Yap</h1>
                </div>
                <div class="form-floating">
                    <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Eposta Adresi</label>
                </div>
                <div class="form-floating">
                    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Şifre</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Giriş Yap</button>
                <div>
                    hesabın yok mu ? <a href="kayit.php" style="text-decoration: none;">kayıt ol</a>
                </div>
                <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>

</html>
<?php

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = sha1($_POST["password"]);
    $query = $db->query("select * from users where email='$email' and password='$password'")->fetch(PDO::FETCH_ASSOC);
    if ($query) {
        session_start();
        $_SESSION["name"] = $query["name"];
        $_SESSION["email"] = $query["email"];
        $_SESSION["id"] = $query["id"];
        setcookie("name", $query["name"]);
        setcookie("id", $query["id"]);
        if ($query["isAdmin"]) {
            setcookie("isAdmin", "admin");
        }

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
                title: 'Giriş başarılı ' +
                    "<?php echo $query['name'] ?>"
            })
            setTimeout(() => {
                window.location.href = "/ucakbilet";
            }, 1000);
        </script>
    <?php
    } else {
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
                icon: 'error',
                title: 'Eposta veya şifre hatalı'
            })
        </script>
<?php
    }
}

?>