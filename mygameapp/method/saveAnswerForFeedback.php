<?php
/**
 * Created by PhpStorm.
 * User: Kun
 * Date: 2019-03-17
 * Time: 13:18
 */

require_once '../includes/DbOperation.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new DbOperation();
    $response['error'] = false;
    $q1 = $_POST['Q1'];
    $q2 = $_POST['Q2'];
    $q3 = $_POST['Q3'];
    $db->saveAnswerForFeedback($q1, $q2, $q3);

}else{
    $response['error'] = true;
    $response['message'] = "Request not allowed";
}

echo json_encode($response);