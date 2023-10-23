<?php require_once("db.php") ?>
<?php

if ($_POST) {
    if (
        isset($_POST["city1Id"]) && isset($_POST["city2Id"])
        && isset($_POST["airplaneId"]) && isset($_POST["seatNumber"])
        && isset($_POST["dateTime"]) && isset($_POST["price"])
    ) {
        $query = $db->prepare("insert into tickets(userId,airplaneId,airportId,seatNumber,dateTime,city1Id,city2Id,price)values(?,?,?,?,?,?,?,?)");
        $insert = $query->execute(array(
            $_POST["userId"], $_POST["airplaneId"], 0, $_POST["seatNumber"], $_POST["dateTime"], $_POST["city1Id"], $_POST["city2Id"], $_POST["price"]
        ));
        if ($insert) {
            echo "Bilet Satın Alma Başarılı";
        } else {
            echo "Bilet Satın Alma Başarısız";
        }
    } else {
    }
}
