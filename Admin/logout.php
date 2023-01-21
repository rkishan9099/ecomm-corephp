<?php
include("config.php");
unset($_SESSION["login"]);
unset($_SESSION["username"]);
unset($_SESSION["email"]);
header("location:login.php");
?>