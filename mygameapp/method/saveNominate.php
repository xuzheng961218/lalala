<?php

require_once '../includes/DbOperation.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new DbOperation();
    $response['error'] = false;
    $name = $_POST['name'];
    $age = $_POST['age'];
    $relation = $_POST['relation'];
    $contact = $_POST['contact'];
    $db->saveNominate($name, $age, $relation, $contact);

}else{
    $response['error'] = true;
    $response['message'] = "Request not allowed";
}

echo json_encode($response);