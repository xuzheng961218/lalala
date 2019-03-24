<?php

require_once '../includes/DbOperation.php';

$response = array();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new DbOperation();

       $response['error'] = false;
       $response['image'] = $db->getImage($_POST['id']);
       

	}else {
    $response['error'] = true;
    $response['message'] = "Request not allowed";
}
 
echo json_encode($response);