<?php

require_once '../includes/DbOperation.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new DbOperation();
    $response['error'] = false;
    $username = $_POST['username'];
    $otherLanguage = $_POST['ifotherlanguage'];
    $languageType = $_POST['languagetype'];
    $time = $_POST['howoften'];
    $familyDifficulty = $_POST['iffamilydifficulty'];
    $difficultyDetail = $_POST['familydifficulty'];
    $disability = $_POST['ifdisability'];
    $disabilityDetail = $_POST['disability'];
    $concer = $_POST['ifconcer'];
    $concerDetail = $_POST['concer'];
    $db->saveLanguage($username, $otherLanguage, $languageType, $time, $familyDifficulty, $difficultyDetail, $disability, $difficultyDetail, $concer, $concerDetail);

}else{
    $response['error'] = true;
    $response['message'] = "Request not allowed";
}

echo json_encode($response);