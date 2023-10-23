<?php require_once("db.php") ?>
<?php

if (isset($_GET["id"])) {
    $query = $db->prepare("update users set isAdmin=:isAdmin where id=:id");
    $insert = $query->execute(array(
        "id" => $_GET["id"],
        "isAdmin" => 1,
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

?>