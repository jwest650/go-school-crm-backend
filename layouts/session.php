<?php
session_start();

if (!isset($_SESSION["name"],$_SESSION['role'])) {
    header("location:login.php");
    exit;
}
