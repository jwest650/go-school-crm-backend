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
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $password = htmlspecialchars($_POST['password']);
    $role = strtolower(htmlspecialchars($_POST['role']));
    $school_name = htmlspecialchars($_POST['school_id']);
    $phone_number = htmlspecialchars($_POST['mobileNumber']);
    $profile = isset($_POST['profile']) ? htmlspecialchars($_POST['profile']) : "";
    $sql = '';
    if ($role == 'teacher') {
        $sql = 'INSERT INTO teachers (first_name,last_name,email,password,role,school_id,phone_number,profile) VALUES(:first_name,:last_name,:email,:password,:role,:school_id,:phone_number,:profile)';
    } else if ($role == 'parent') {
        $sql = 'INSERT INTO users (first_name,last_name,email,password,role,school_id,phone_number,profile) VALUES(:first_name,:last_name,:email,:password,:role,:school_id,:phone_number,:profile)';
    }

    $smt = $db->prepare($sql);
    $smt->bindParam(':first_name', $first_name);
    $smt->bindParam(':last_name', $last_name);
    $smt->bindParam(':email', $email);
    $smt->bindParam(':password', $password);
    $smt->bindParam(':role', $role);
    $smt->bindParam(':school_id', $school_name);
    $smt->bindParam(':phone_number', $phone_number);
    $smt->bindParam(':profile', $profile);

    try {
        $response = [];
        if ($smt->execute()) {
            $response['status'] = 'success';
            $sql = '';
            if ($role == 'teacher') {
                $sql = 'SELECT id, first_name,last_name,email,role,school_id,profile FROM teachers WHERE email =:email AND password =:password';
            } else if ($role == 'parent') {
                $sql = 'SELECT id, first_name,last_name,email,role,school_id,profile FROM users WHERE email =:email AND password =:password';
            }

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
    $role = htmlspecialchars($_POST['role']);



    $sql = '';

    if ($role == 'teacher') {
        $sql = 'SELECT id, first_name,last_name,email,role,school_id,profile FROM teachers WHERE email =:email AND password =:password';
    } else if ($role == 'parent') {
        $sql = 'SELECT id, first_name,last_name,email,role,school_id,profile FROM users WHERE email =:email AND password =:password';
    } else {
        $sql = 'SELECT id, name as first_name,last_name,email,role,profile,school_id FROM admins WHERE email =:email AND password =:password';
    }
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


if (isset($_POST['get_schools'])) {



    $sql = "SELECT * FROM schools";
    $smt = $db->prepare($sql);




    try {
        $smt->execute();
        $user = $smt->fetchAll();
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
