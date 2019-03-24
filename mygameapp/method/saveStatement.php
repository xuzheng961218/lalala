<?php

require_once '../includes/DbOperation.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new DbOperation();
    $response['error'] = false;
    $username = $_POST['username'];
    $remain = $_POST['remain'];
    $newsletter = $_POST['newsletter'];
    $db->saveStatement($username, $remain, $newsletter);
}else{
    $response['error'] = true;
    $response['message'] = "Request not allowed";
}

echo json_encode($response);