<?php

 
//importing required script
require_once '../includes/DbOperation.php';
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
        $db = new DbOperation();
        $sql = "SELECT image FROM image";
        $result = mysql_query($sql);
        $json_array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $json_array[] = $row;

        }

        echo json_encode($json_array);

 
       
}