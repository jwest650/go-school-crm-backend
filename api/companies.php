<?php

if (!isset($_POST['name'], $_POST['plan_type'], $_POST['plan_name'], $_POST['language'], $_POST['phone_number'], $_POST['currency'])) {
    die('all fields required');
}

include './config.php';
$name = htmlspecialchars($_POST['name']);
$account_url = isset($_POST['account_url']) ? htmlspecialchars($_POST['account_url']) : ''; // Default to empty string
$phone_number =  htmlspecialchars($_POST['phone_number']);
$website = isset($_POST['website']) ? htmlspecialchars($_POST['website']) : ''; // Default to empty string
$address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; // Default to empty string
$plan_name =  htmlspecialchars($_POST['plan_name']);
$plan_type =  htmlspecialchars($_POST['plan_type']);
$currency = htmlspecialchars($_POST['currency']);
$language =  htmlspecialchars($_POST['language']);
$status = isset($_POST['status']) ? htmlspecialchars($_POST['status']) : ''; // Default to empty string
$destPath = '';

try {
    $database = new Database();
    $db = $database->connect();
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
    $sql = "INSERT INTO schools (name,account_url, phone_number, website, address, plan_name, plan_type, currency, language, status, profile) VALUES (
    :name, :account_url, :phone_number, :website, :address, :plan_name, :plan_type, :currency, :language, :status, :profile)";
    $smt = $db->prepare($sql);
    $smt->bindParam(':name', $name);
    $smt->bindParam(':account_url', $account_url);
    $smt->bindParam(':phone_number', $phone_number);
    $smt->bindParam(':website', $website);
    $smt->bindParam(':address', $address);
    $smt->bindParam(':plan_name', $plan_name);
    $smt->bindParam(':plan_type', $plan_type);
    $smt->bindParam(':currency', $currency);
    $smt->bindParam(':language', $language);
    $smt->bindParam(':status', $status);
    $smt->bindParam(':profile', $destPath);
    $response = [];
    if ($smt->execute()) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'failed';
        $response['message'] = 'inserting failed';
    }
} catch (exception $e) {
    echo "Error: " . $e->getMessage();
};

echo json_encode($response);
