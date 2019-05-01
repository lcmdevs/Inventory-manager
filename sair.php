<?php
session_start();
unset($_SESSION['matricula']);
header("location: login.php");
?>