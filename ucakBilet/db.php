<?php 

try {
    $db = new PDO("mysql:host=localhost;dbname=ucakbilet;charset=utf8", "root", "usbw");
} catch ( PDOException $e ){
    print $e->getMessage();
}
