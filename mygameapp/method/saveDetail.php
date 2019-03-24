<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../includes/DbOperation.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new DbOperation();
    $response['error'] = false;
    $username = $_POST['username'];
    $parentName = $_POST['parentname'];
    $childName = $_POST['childname'];
    $childGender = $_POST['childgender'];
    $dateOfBirth = $_POST['dateofbirth'];
    $postcode = $_POST['postcode'];
    $phoneNumber = $_POST['phonenumber'];
    $mumAge = $_POST['mumage'];
    $mumEducation = $_POST['mumeducation'];
    $dadAge = $_POST['dadage'];
    $dadEducation = $_POST['dadeduaction'];
    $childEthnic = $_POST['childethnic'];

    $db->saveDetail($username, $parentName, $childName, $childGender, $dateOfBirth, $postcode, $phoneNumber, $mumAge, $mumEducation, $dadAge, $dadEducation, $childEthnic);

}else{
    $response['error'] = true;
    $response['message'] = "Request not allowed";
}

echo json_encode($response);