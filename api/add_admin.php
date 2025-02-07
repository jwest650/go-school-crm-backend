<?php


include './config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $school = htmlspecialchars($_POST['school']);
    $role = htmlspecialchars($_POST['role']);
    $phone = htmlspecialchars($_POST['phone_number']);
    $profile = isset($_POST['profile']) ? htmlspecialchars($_POST['profile']) : "";
    try {
        $database = new Database();
        $db = $database->connect();
        $sql = "INSERT INTO admins SET name=:name,last_name=:last_name,email=:email,password=:password,school=:school,role=:role,phone=:phone,profile=:profile";
        $smt = $db->prepare($sql);



        $response = [];
        if ($smt->execute()) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'no user with that credentials';
        };
    } catch (exception $e) {
        $response['status'] = 'failed';
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response);
}
