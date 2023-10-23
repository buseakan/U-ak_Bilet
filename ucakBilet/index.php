<?php require_once("db.php") ?>
<?php

$cities = $db->query("select * from cities")->fetchAll(PDO::FETCH_OBJ);
$airplanes = $db->query("select * from airplanes")->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilet - Anasayfa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <style>

    </style>
</head>

<body>
    <?php include("header.php") ?>

    <div id="container">
        <div id="imageDiv"></div>
        <div id="ticketDiv">
            <div style="position: absolute;left:0;top:0;padding:6px;">
                <h4>Bilet Satın Al</h4>
            </div>
            <div>
                <label class="form-label" for="location1">Nereden</label>
                <select id="location1" class="form-control">
                    <option value="">Şehir Seçiniz</option>
                    <?php
                    foreach ($cities as $city) {
                    ?>
                        <option value="<?php echo $city->id ?>"><?php echo $city->cityName ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <label class="form-label" for="location2">Nereye</label>
                <select id="location2" class="form-control">
                    <option value="">Şehir Seçiniz</option>
                    <?php
                    foreach ($cities as $city) {
                    ?>
                        <option value="<?php echo $city->id ?>"><?php echo $city->cityName ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <label class="form-label" for="airplane">Uçak</label>
                <select id="airplane" class="form-control">
                    <option value="">Uçak Seçiniz</option>
                    <?php
                    foreach ($airplanes as $airplane) {
                    ?>
                        <option value="<?php echo $airplane->id ?>"><?php echo $airplane->name ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <label class="form-label" for="seat">Koltuk</label>
                <select id="seat" class="form-control">
                    <option value="">Koltuk Seçiniz</option>
                    <?php
                    for ($i = 1; $i <= 70; $i++) {
                    ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <label class="form-label" for="date">Tarih</label>
                <input type="date" id="date" class="form-control">
            </div>
            <div style="font-size: 18px;">
                <span id="price">-</span>₺
            </div>
            <div>
                <button <?php echo isset($_COOKIE["id"]) ? "" : "disabled"; ?> onclick="buy_ticket()" class="btn btn-primary">Satın Al</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let l1;
        let l2;
        $("#location1").change(() => {
            l1 = $("#location1").val();
            if (l1 && l2) {
                let total = l1 > l2 ? l1 + l2 : l2 + l1
                $("#price").html(total - 1.7);
            }
        })
        $("#location2").change(() => {
            l2 = $("#location2").val();
            if (l1 && l2) {
                let total = l1 > l2 ? l1 + l2 : l2 + l1
                $("#price").html(total * 1.7);
            }
        })

        function buy_ticket() {
            let city1Id = $("#location1").val();
            let city2Id = $("#location2").val();
            let airplaneId = $("#airplane").val();
            let seatNumber = $("#seat").val();
            let dateTime = $("#date").val();
            let price = $("#price").html();
            if (price === "-") {
                return;
            }
            $.ajax({
                url: "buyticket.php",
                method: "POST",
                data: {
                    city1Id,
                    city2Id,
                    airplaneId,
                    seatNumber,
                    dateTime,
                    price,
                    userId: <?php echo $_COOKIE["id"]; ?>
                },
                success: (data) => {
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
                        icon: data == "Bilet Satın Alma Başarılı" ? 'success' : "error",
                        title: data
                    })
                },
                error: () => {
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
                        title: 'Bilet Satın Alma Başarısız'
                    })
                }
            })
        }
    </script>
</body>

</html>