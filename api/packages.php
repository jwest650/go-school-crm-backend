<?php
include './config.php';

$database = new Database();
$db = $database->connect();





if (isset($_POST['add_packages'])) {


    if (!isset($_POST['plan_type'], $_POST['plan_name'], $_POST['plan_currency'], $_POST['currency_plan'], $_POST['discount'], $_POST['discount_type'], $_POST['status'])) {
        die('all fields required');
    }


    $plan_name =  htmlspecialchars($_POST['plan_name']);
    $plan_type =  htmlspecialchars($_POST['plan_type']);
    $price =  htmlspecialchars($_POST['price']);
    $currency_plan = htmlspecialchars($_POST['currency_plan']);
    $plan_currency = htmlspecialchars($_POST['plan_currency']);
    $discount =  htmlspecialchars($_POST['discount']);
    $discount_type =  htmlspecialchars($_POST['discount_type']);
    $status = htmlspecialchars($_POST['status']);
    $trial_days = isset($_POST['trial_days']) ? htmlspecialchars($_POST['trial_days']) : ''; // Default to empty string
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

        $sql = "INSERT INTO packages (plan_name, plan_type, currency_plan, plan_currency, discount, discount_type, status, profile, trial_days,price) VALUES (
        :plan_name, :plan_type, :currency_plan, :plan_currency, :discount, :discount_type,:status, :profile, :trial_days,:price)";
        $smt = $db->prepare($sql);
        $smt->bindParam(':plan_name', $plan_name);
        $smt->bindParam(':plan_type', $plan_type);
        $smt->bindParam(':currency_plan', $currency_plan);
        $smt->bindParam(':plan_currency', $plan_currency);
        $smt->bindParam(':discount', $discount);
        $smt->bindParam(':discount_type', $discount_type);

        $smt->bindParam(':status', $status);
        $smt->bindParam(':profile', $destPath);
        $smt->bindParam(':trial_days', $trial_days);
        $smt->bindParam(':price', $price);
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
    exit;
}

if (isset($_POST['update_packages'])) {





    $plan_name =  htmlspecialchars($_POST['edit_plan_name']);
    $plan_type =  htmlspecialchars($_POST['edit_plan_type']);
    $price =  htmlspecialchars($_POST['edit_price']);
    $currency_plan = htmlspecialchars($_POST['edit_currency_plan']);
    $plan_currency = htmlspecialchars($_POST['edit_plan_currency']);
    $discount =  htmlspecialchars($_POST['edit_discount']);
    $discount_type =  htmlspecialchars($_POST['edit_discount_type']);
    $status = htmlspecialchars($_POST['edit_status']);
    $id = htmlspecialchars($_POST['id']);
    $trial_days = isset($_POST['edit_trial_days']) ? htmlspecialchars($_POST['edit_trial_days']) : ''; // Default to empty string
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

        $sql = "UPDATE packages SET plan_name=:plan_name, plan_type=:plan_type, currency_plan=:currency_plan, plan_currency=:plan_currency, discount=:discount, discount_type=:discount_type, status=:status, profile=:profile, trial_days=:trial_days, price=:price WHERE id=:id";
        $smt = $db->prepare($sql);
        $smt->bindParam(':plan_name', $plan_name);
        $smt->bindParam(':plan_type', $plan_type);
        $smt->bindParam(':currency_plan', $currency_plan);
        $smt->bindParam(':plan_currency', $plan_currency);
        $smt->bindParam(':discount', $discount);
        $smt->bindParam(':discount_type', $discount_type);

        $smt->bindParam(':status', $status);
        $smt->bindParam(':profile', $destPath);
        $smt->bindParam(':trial_days', $trial_days);
        $smt->bindParam(':price', $price);
        $smt->bindParam(':id', $id);
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
    exit;
}


if (isset($_POST['get_packages'])) {

    try {
        $sql = "SELECT
        p.*,
        COUNT(s.id) as total_subscribers
    FROM
        packages p
    LEFT JOIN schools s ON p.plan_name = s.plan_name AND p.plan_type = s.plan_type
    GROUP BY
        p.id";

        $totalCountsSql = "SELECT
        (SELECT COUNT(*) FROM packages WHERE status = 'active') AS total_active_plans,
        (SELECT COUNT(*) FROM packages WHERE status = 'inactive') AS total_inactive_plans,
        (SELECT COUNT(*) FROM packages) AS total_plans,
        (SELECT COUNT(DISTINCT plan_type) FROM packages ) AS total_plans_type
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
                'packages' => $packages,
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

if (isset($_POST['edit_packages'])) {

    $id =  htmlspecialchars($_POST['edit_packages']);
    try {
        $sql = "SELECT * FROM packages WHERE id=$id";
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

if (isset($_POST['delete_packages'])) {

    $id =  htmlspecialchars($_POST['id']);
    try {
        $sql = "DELETE FROM packages WHERE id=:id"; // Use a parameterized query
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
