<?php
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

//header("Content-Type: multipart/form-data");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');

header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');


include '../config.php';
$database = new Database();
$db = $database->connect();

if (isset($_POST['sign_up'])) {
    $email = htmlspecialchars($_POST['email']);
    $name = htmlspecialchars($_POST['name']);
    $password = htmlspecialchars($_POST['password']);
    $role = htmlspecialchars($_POST['role']);
    $school_name = htmlspecialchars($_POST['schoolName']);
    $phone_number = htmlspecialchars($_POST['mobileNumber']);
    $profile = isset($_POST['profile']) ? htmlspecialchars($_POST['profile']) : "";


    $sql = 'INSERT INTO users (name,email,password,role,school_name,phone_number,profile) VALUES(:name,:email,:password,:role,:school_name,:phone_number,:profile)';
    $smt = $db->prepare($sql);
    $smt->bindParam(':name', $name);
    $smt->bindParam(':email', $email);
    $smt->bindParam(':password', $password);
    $smt->bindParam(':role', $role);
    $smt->bindParam(':school_name', $school_name);
    $smt->bindParam(':phone_number', $phone_number);
    $smt->bindParam(':profile', $profile);

    try {
        $response = [];
        if ($smt->execute()) {
            $response['status'] = 'success';
            $sql = 'SELECT id, name,email,role,school_name,profile FROM users WHERE email =:email AND password =:password';
            $smt = $db->prepare($sql);

            $smt->bindParam(':email', $email);
            $smt->bindParam(':password', $password);
            $smt->execute();
            $user = $smt->fetch();
            $response = [];
            if (!empty($user)) {
                $response['status'] = 'success';
                $response['data'] = $user;
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'fetch failed';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'inserting failed';
        }
    } catch (exception $e) {
        $response['status'] = 'failed';
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response);
}

if (isset($_POST['sign_in'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);



    $sql = 'SELECT id, name,email,role,school_name,profile FROM users WHERE email =:email AND password =:password';
    $smt = $db->prepare($sql);

    $smt->bindParam(':email', $email);
    $smt->bindParam(':password', $password);


    try {
        $smt->execute();
        $user = $smt->fetch();
        $response = [];
        if (!empty($user)) {
            $response['status'] = 'success';
            $response['data'] = $user;
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'fetch failed';
        }
    } catch (exception $e) {
        $response['status'] = 'failed';
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response);
}
