<?php

if (!isset($_POST['name'], $_POST['password'])) {
    die('all fields required');
}

include './config.php';
$name = htmlspecialchars($_POST['name']);
$password = htmlspecialchars($_POST['password']);
try {
    $database = new Database();
    $db = $database->connect();
    $sql = "SELECT name,role,status,last_login,id,email,profile FROM admins where name=:name and password=:password";
    $smt = $db->prepare($sql);
    $smt->bindParam(':name', $name);
    $smt->bindParam(':password', $password);
    $smt->execute();
    $admin = $smt->fetch();
    $response = [];
    if (!empty($admin)) {
        $response['status'] = 'success';
        $response['data'] = $admin;
    } else {
        $response['status'] = 'failed';
        $response['message'] = 'no user with that credentials';
    }
} catch (exception $e) {
    echo "Error: " . $e->getMessage();
};

echo json_encode($response);
