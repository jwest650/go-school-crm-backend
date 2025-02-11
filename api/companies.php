<?php
include './config.php';
$database = new Database();
$db = $database->connect();

if (isset($_POST['add_companies'])) {
    if (!isset($_POST['name'], $_POST['plan_type'], $_POST['plan_name'], $_POST['language'], $_POST['phone_number'], $_POST['currency'])) {
        die('all fields required');
    }


    $name = htmlspecialchars($_POST['name']);
    $account_url = isset($_POST['account_url']) ? htmlspecialchars($_POST['account_url']) : ''; // Default to empty string
    $phone_number =  htmlspecialchars($_POST['phone_number']);
    $website = isset($_POST['website']) ? htmlspecialchars($_POST['website']) : ''; // Default to empty string
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; // Default to empty string
    $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; // Default to empty string
    $plan_name =  htmlspecialchars($_POST['plan_name']);
    $plan_type =  htmlspecialchars($_POST['plan_type']);
    $currency = htmlspecialchars($_POST['currency']);
    $language =  htmlspecialchars($_POST['language']);
    $location =  htmlspecialchars($_POST['location']);
    $status = isset($_POST['status']) ? htmlspecialchars($_POST['status']) : ''; // Default to empty string
    $destPath = '';

    try {

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
        $sql = "INSERT INTO schools (name,account_url, phone_number, website, address, plan_name, plan_type, currency, language, status, profile,location,email) VALUES (
        :name, :account_url, :phone_number, :website, :address, :plan_name, :plan_type, :currency, :language, :status, :profile,:location,:email)";
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
        $smt->bindParam(':location', $location);
        $smt->bindParam(':email', $email);
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
}


if (isset($_POST['update_company'])) {



    $name = htmlspecialchars($_POST['edit_name']);
    $account_url = isset($_POST['edit_account_url']) ? htmlspecialchars($_POST['edit_account_url']) : ''; // Default to empty string
    $phone_number =  htmlspecialchars($_POST['edit_phone_number']);
    $website = isset($_POST['edit_website']) ? htmlspecialchars($_POST['edit_website']) : ''; // Default to empty string
    $email = isset($_POST['edit_email']) ? htmlspecialchars($_POST['edit_email']) : ''; // Default to empty string
    $address = isset($_POST['edit_address']) ? htmlspecialchars($_POST['edit_address']) : ''; // Default to empty string
    $plan_name =  htmlspecialchars($_POST['edit_plan_name']);
    $plan_type =  htmlspecialchars($_POST['edit_plan_type']);
    $currency = htmlspecialchars($_POST['edit_currency']);
    $language =  htmlspecialchars($_POST['edit_language']);
    $location =  htmlspecialchars($_POST['edit_location']);
    $id =  htmlspecialchars($_POST['edit_id']);
    $status = isset($_POST['edit_status']) ? htmlspecialchars($_POST['edit_status']) : ''; // Default to empty string
    $destPath = '';

    try {

        if (isset($_FILES['edit_profile']) && $_FILES['edit_profile']['error'] == UPLOAD_ERR_OK) {
            // Get file properties
            $fileTmpPath = $_FILES['edit_profile']['tmp_name'];
            $fileName = $_FILES['edit_profile']['name'];
            $fileSize = $_FILES['edit_profile']['size'];
            $fileType = $_FILES['edit_profile']['type'];

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
        $sql = " UPDATE schools SET name=:name,account_url=:account_url, phone_number=:phone_number, website=:website, address=:address, plan_name=:plan_name, plan_type=:plan_type, currency=:currency, language=:language, status=:status, profile=:profile,location=:location WHERE id=:id";
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
        $smt->bindParam(':location', $location);
        $smt->bindParam(':id', $id);
        $response = [];
        if ($smt->execute()) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'updating failed';
        }
    } catch (exception $e) {
        echo "Error: " . $e->getMessage();
    };

    echo json_encode($response);
}


if (isset($_POST['get_companies'])) {

    try {
        $sql = "SELECT * FROM schools";

        $totalCountsSql = "SELECT
        (SELECT COUNT(*) FROM schools WHERE status = 'active') AS total_active_schools,
        (SELECT COUNT(*) FROM schools WHERE status = 'inactive') AS total_inactive_schools,
        (SELECT COUNT(*) FROM schools) AS total_schools,
        (SELECT COUNT(DISTINCT location) FROM schools ) AS total_locations
    ";
        $smt = $db->prepare($sql);
        $smt->execute();
        $packages = $smt->fetchAll();
        $smt = $db->prepare($totalCountsSql);
        $smt->execute();
        $total = $smt->fetch();
        $response = [];
        if (!empty($packages) && !empty($total)) {
            $response['status'] = 'success';
            $response['data'] = array(
                'schools' => $packages,
                'total' => $total,
            );
        } else {
            $response['status'] = 'success';
            $response['message'] = 'empty';
            $response['data'] = [];
        }
    } catch (exception $e) {
        $response['status'] = 'failed';
        $response['message'] = $e->getMessage();
    }
    echo json_encode($response);
    exit;
}

if (isset($_POST['edit_school'])) {

    $id =  htmlspecialchars($_POST['edit_school']);
    try {
        $sql = "SELECT * FROM schools WHERE id=$id";
        $smt = $db->prepare($sql);
        $smt->execute();
        $data = $smt->fetch();
        $response = [];
        if (!empty($data)) {
            $response['status'] = 'success';
            $response['data'] = $data;
        } else {
            $response['status'] = 'success';
            $response['message'] = 'empty';
            $response['data'] = $data;
        }
    } catch (exception $e) {
        $response['status'] = 'failed';
        $response['message'] = $e->getMessage();
    }
    echo json_encode($response);
    exit;
}

if (isset($_POST['delete_companies'])) {

    $id =  htmlspecialchars($_POST['id']);
    try {
        $sql = "DELETE FROM schools WHERE id=:id"; // Use a parameterized query
        $smt = $db->prepare($sql);
        $smt->bindParam(':id', $id);


        $response = [];
        if ($smt->execute()) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'failed';
        }
    } catch (exception $e) {
        $response['status'] = 'failed';
        $response['message'] = $e->getMessage();
    }
    echo json_encode($response);
    exit;
}

if (isset($_POST['school_details'])) {

    $id =  htmlspecialchars($_POST['id']);
    try {

        $sql = "SELECT s.*, p.price FROM schools s JOIN packages p ON p.plan_name = s.plan_name AND p.plan_type = s.plan_type
        
        WHERE s.id = :id";
        $smt = $db->prepare($sql);
        $smt->bindParam(':id', $id);
        $smt->execute();
        $data = $smt->fetch();

        $response = [];
        if (!empty($data)) {
            $response['status'] = 'success';
            $response['data'] = $data;
        } else {
            $response['status'] = 'failed';
            $response['data'] = null;
        }
    } catch (exception $e) {
        $response['status'] = 'failed';
        $response['message'] = $e->getMessage();
    }
    echo json_encode($response);
    exit;
}
