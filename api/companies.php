<?php

if (!isset($_POST['name'], $_POST['password'],$_POST['plan_type'],$_POST['plane_name'],$_POST['language'],$_POST['phone_number'],$_POST['currency'])) {
    die('all fields required');
}

include './config.php';
$name = htmlspecialchars($_POST['name']);
$password = htmlspecialchars($_POST['password']);
$account_url = isset($_POST['account_url']) ? htmlspecialchars($_POST['account_url']) : ''; // Default to empty string
$phone_number =  htmlspecialchars($_POST['phone_number']) ;
$website = isset($_POST['website']) ? htmlspecialchars($_POST['website']) : ''; // Default to empty string
$address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; // Default to empty string
$plan_name =  htmlspecialchars($_POST['plan_name']);
$plan_type =  htmlspecialchars($_POST['plan_type']);
$currency = htmlspecialchars($_POST['currency']);
$language =  htmlspecialchars($_POST['language']);
$status = isset($_POST['status']) ? htmlspecialchars($_POST['status']) : ''; // Default to empty string
$profile = isset($_POST['profile']) ? htmlspecialchars($_POST['profile']) : ''; // Default to empty string
try {
    $database = new Database();
    $db = $database->connect();
    $sql = "INSERT INTO companies (name, password, account_url, phone_number, website, address, plan_name, plan_type, currency, language, status, profile) VALUES (
    :name, :password, :account_url, :phone_number, :website, :address, :plan_name, :plan_type, :currency, :language, :status, :profile)";
    $smt = $db->prepare($sql);
    $smt->bindParam(':name', $name);
    $smt->bindParam(':password', $password);
    $smt->bindParam(':account_url', $account_url);
    $smt->bindParam(':phone_number', $phone_number);
    $smt->bindParam(':website', $website);
    $smt->bindParam(':address', $address);
    $smt->bindParam(':plan_name', $plan_name);
    $smt->bindParam(':plan_type', $plan_type);
    $smt->bindParam(':currency', $currency);
    $smt->bindParam(':language', $language);
    $smt->bindParam(':status', $status);
    $smt->bindParam(':profile', $profile);
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
