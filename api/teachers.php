<?php
include './config.php';






if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['name'])) {
        die('pass all fields');
    }

    $name = htmlspecialchars($_POST['name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $start_date = htmlspecialchars($_POST['start_date']);
    $end_date = htmlspecialchars($_POST['end_date']);
    $department = htmlspecialchars($_POST['department']);
    $description = htmlspecialchars($_POST['description']);

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
        $sql = "INSERT INTO teachers SET name=:name,last_name=:last_name,start_date=:start_date,end_date=:end_date,department=:department,description=:description";

        if ($destPath) {
            $sql .= ",profile=:profile";
        }


        $smt = $db->prepare($sql);
        $smt->bindParam(':name', $name);
        $smt->bindParam(':last_name', $last_name);
        $smt->bindParam(':start_date', $start_date);
        $smt->bindParam(':end_date', $end_date);
        $smt->bindParam(':department', $department);
        $smt->bindParam(':description', $description);


        if ($destPath) {
            $smt->bindParam(':profile', $destPath);
        }

        $response = [];
        if ($smt->execute()) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'inserting failed';
        }
    } catch (exception $e) {
        $response['error'] = $e->getMessage();
    };

    echo json_encode($response);
}
