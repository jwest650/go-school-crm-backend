<?php
session_start();


$_SESSION['id'] = $_POST['id'];
$_SESSION['name'] = $_POST['name'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['profile'] = $_POST['profile'];
$_SESSION['role'] = $_POST['role'];
$_SESSION['status'] = $_POST['status'];
$_SESSION['last_login'] = $_POST['last_login'];
