<?php require_once("db.php") ?>
<?php
$message = "";
if (isset($_POST["name"])) {
    if(empty($_POST["name"])){
        $message = "ekleme başarısız";
    }
    else{
        $query = $db->prepare("insert into airplanes(name)values
        (:name)");
    $insert = $query->execute(array(
        "name" => $_POST["name"]
    ));
    if ($insert) {
?>
        <script>
            window.location.href = "all_airplanes.php";
        </script>
<?php
    } else {
        $message = "ekleme başarısız";
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
    <title>Uçak Ekle</title>
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
                <form method="Post" action="addplane.php">
                    <?php

                    if ($message != "") {
                    ?>
                        <div class="alert alert-danger"><?php echo $message ?></div>
                    <?php
                    }

                    ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Uçak İsmi</label>
                        <input name="name" type="text" class="form-control" id="name">
                    </div>
                    <button type="submit" class="btn btn-primary">Ekle</button>
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