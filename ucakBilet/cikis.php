<?php
session_destroy();
setcookie("id", null, time() - 1);
setcookie("name", null, time() - 1);
setcookie("isAdmin", null, time() - 1);
header("location:index.php");
