<?php require_once("db.php") ?>
<?php

if ($_POST) {
    if (
        isset($_POST["id"])
    ) {
        $query = $db->prepare("DELETE FROM airplanes WHERE id = :id");
        $delete = $query->execute(array(
            'id' => $_POST['id']
        ));
    }
}
