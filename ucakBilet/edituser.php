<?php require_once("db.php") ?>
<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $user = $db->query("select * from users where id=$id")->fetch(PDO::FETCH_OBJ);
} else {
?>
    <script>
        window.location.href = "all_users.php";
    </script>
    <?php
}

$message = "";
if (isset($_POST["name"]) && isset($_POST["id"]) && isset($_POST["email"])) {
    if (empty($_POST["name"])) {
        $message = "düzenleme başarısız";
    } else {
        $query = $db->prepare("update users set name=:name,email=:email where id=:id");
        $insert = $query->execute(array(
            "name" => $_POST["name"],
            "email" => $_POST["email"],
            "id" => $_POST["id"],
        ));
        if ($insert) {
    ?>
            <script>
                window.location.href = "all_users.php";
            </script>
<?php
        } else {
            $message = "düzenleme başarısız";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <style>

    </style>
</head>

<body>
    <?php include("header.php") ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form method="Post" action="edituser.php">
                    <input name="id" value="<?php echo $user->id ?>" type="hidden">
                    <?php

                    if ($message != "") {
                    ?>
                        <div class="alert alert-danger"><?php echo $message ?></div>
                    <?php
                    }

                    ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Kullanıcı Ad Soyad</label>
                        <input value="<?php echo $user->name ?>" name="name" type="text" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Kullanıcı Eposta</label>
                        <input value="<?php echo $user->email ?>" name="email" type="email" class="form-control" id="email">
                    </div>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

    </script>
</body>

</html>