<?php

if (!isset($_POST['plan_type'],$_POST['plane_name'],$_POST['plan_currency'],$_POST['currency_plan'],$_POST['discount'],$_POST['discount_type'],$_POST['status'])) {
    die('all fields required');
}

include './config.php';

$plan_name =  htmlspecialchars($_POST['plan_name']);
$plan_type =  htmlspecialchars($_POST['plan_type']);
$currency_plan = htmlspecialchars($_POST['currency_plan']);
$plan_currency = htmlspecialchars($_POST['plan_currency']);
$discount =  htmlspecialchars($_POST['discount']);
$discount_type =  htmlspecialchars($_POST['discount_type']);
$status = htmlspecialchars($_POST['status']);
$profile = isset($_POST['profile']) ? htmlspecialchars($_POST['profile']) : ''; // Default to empty string
$trial_days = isset($_POST['trial_days']) ? htmlspecialchars($_POST['trial_days']) : ''; // Default to empty string
try {
    $database = new Database();
    $db = $database->connect();
    $sql = "INSERT INTO companies (plan_name, plan_type, currency_plan, plan_currency, discount, discount_type,status, profile,trial_days) VALUES (
    :plan_name, :plan_type, :currency_plan, :plan_currency, :discount, :discount_type,:status, :profile,:trial_days)";
    $smt = $db->prepare($sql);
    $smt->bindParam(':plan_name', $plan_name);
    $smt->bindParam(':plan_type', $plan_type);
    $smt->bindParam(':currency_plan', $currency_plan);
    $smt->bindParam(':plan_currency', $plan_currency);
    $smt->bindParam(':discount', $discount);
    $smt->bindParam(':discount_type', $discount_type);
   
    $smt->bindParam(':status', $status);
    $smt->bindParam(':profile', $profile);
    $smt->bindParam(':trail_days', $trail_days);
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
