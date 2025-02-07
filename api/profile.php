<?php
include './config.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_SESSION['id'];
    try {
        $database = new Database();
        $db = $database->connect();
        $sql = "SELECT * FROM admins WHERE id =:id";
        $smt = $db->prepare($sql);
        $smt->bindParam(':id', $id);

        $smt->execute();
        $admin = $smt->fetch();
        $response = [];
        if (!empty($admin)) {
            $response['status'] = 'success';
            $response['data'] = $admin;
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





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['name'], $_POST['id'])) {
        die('pass all fields');
    }

    $name = htmlspecialchars($_POST['name']);
    $id = htmlspecialchars($_POST['id']);
    $last_name = $_POST['last_name'] ? htmlspecialchars($_POST['last_name']) : "";
    $email = $_POST['email'] ? htmlspecialchars($_POST['email']) : "";
    $phone = $_POST['phone'] ? htmlspecialchars($_POST['phone']) : "";
    $address = $_POST['address'] ? htmlspecialchars($_POST['address']) : "";
    $country = $_POST['country'] ? htmlspecialchars($_POST['country']) : "";
    $city = $_POST['city'] ? htmlspecialchars($_POST['city']) : "";
    $postal_code = $_POST['postal_code'] ? htmlspecialchars($_POST['postal_code']) : "";
    $password = $_POST['new_password'] ? htmlspecialchars($_POST['new_password']) : "";
    $destPath = '';



    if (isset($_FILES['profile']) && $_FILES['profile']['error'] == UPLOAD_ERR_OK) {
        // Get file properties
        $fileTmpPath = $_FILES['profile']['tmp_name'];
        $fileName = $_FILES['profile']['name'];
        $fileSize = $_FILES['profile']['size'];
        $fileType = $_FILES['profile']['type'];

        // Define allowed file types and size limit (e.g., 2MB)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 5 * 1024 * 1024; // 2MB

        // Validate file type
        if (in_array($fileType, $allowedTypes) && $fileSize <= $maxFileSize) {
            // Set the upload directory
            $uploadDir = 'uploads/profile/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Move the uploaded file to the designated directory
            $destPath = $uploadDir . basename($fileName);
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // echo "File uploaded successfully: " . htmlspecialchars($destPath);
            } else {
                // echo "Error moving the uploaded file.";
            }
        } else {
            // echo "Invalid file type or size exceeded.";
        }
    }


    try {
        $database = new Database();
        $db = $database->connect();
        $sql = "UPDATE admins SET name=:name,last_name=:last_name,email=:email,phone=:phone,address=:address,city=:city,postal_code=:postal_code,country=:country";
        if ($password) {
            $sql .= ",password=:password";
        }
        if ($destPath) {
            $sql .= ",profile=:profile";
        }
        $sql .= " WHERE id=:id";

        $smt = $db->prepare($sql);
        $smt->bindParam(':name', $name);
        $smt->bindParam(':id', $id);
        $smt->bindParam(':last_name', $last_name);
        $smt->bindParam(':email', $email);
        $smt->bindParam(':phone', $phone);
        $smt->bindParam(':address', $address);
        $smt->bindParam(':city', $city);

        $smt->bindParam(':postal_code', $postal_code);
        $smt->bindParam(':country', $country);
        if ($destPath) {
            $smt->bindParam(':profile', $destPath);
        }
        if ($password) {
            $smt->bindParam(':password', $password);
        }
        $response = [];
        if ($smt->execute()) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'inserting failed';
        }
    } catch (exception $e) {
        $response['status'] = 'failed';
        $response['message'] = $e->getMessage();
    };

    echo json_encode($response);
}
