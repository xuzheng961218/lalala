<?php

require_once '../includes/DbOperation.php';

$response = array();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    	$db = new DbOperation();
        $response['error'] = false;
        $qID = $_POST['qID'];
        $uID = $_POST['uID'];
        $questionContext = $_POST['questionContext'];
        $answer_q = $_POST['answer_q'];
        $db->saveAnswerForQuestion($qID, $uID, $questionContext, $answer_q);
      
}else{
    $response['error'] = true;
    $response['message'] = "Request not allowed";
}
 
echo json_encode($response);