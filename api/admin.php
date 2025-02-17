<?php
include './config.php';

if (isset($_POST['add_admin'])) {

    $name = htmlspecialchars($_POST['name']);
    $last_name = isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : "";
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : "";
    $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : "";
    $country = isset($_POST['country']) ? htmlspecialchars($_POST['country']) : "";
    $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : "";
    $postal_code = isset($_POST['postal_code']) ? htmlspecialchars($_POST['postal_code']) : "";
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : "";
    $school_id =  htmlspecialchars($_POST['school_id']);

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
        $sql = "INSERT INTO admins (name, last_name, email, password, school_id, role, phone, profile, address, country, city, postal_code) VALUES (:name, :last_name, :email, :password, :school_id, :role, :phone, :profile, :address, :country, :city, :postal_code)";
        $smt = $db->prepare($sql);
        $smt->bindParam(':name', $name);
        $smt->bindParam(':last_name', $last_name);
        $smt->bindParam(':email', $email);
        $smt->bindParam(':password', $password);
        $smt->bindParam(':school_id', $school);
        $smt->bindParam(':role', $role);
        $smt->bindParam(':phone', $phone);
        $smt->bindParam(':address', $address);
        $smt->bindParam(':country', $country);
        $smt->bindParam(':city', $city);
        $smt->bindParam(':postal_code', $postal_code);

        $smt->bindParam(':profile', $destPath);



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
    exit;
}

if (isset($_POST['get_admin'])) {
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
}
