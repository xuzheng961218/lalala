<?php
/**
 * Created by PhpStorm.
 * User: Kun
 * Date: 2019-03-09
 * Time: 22:38
 */

$host = "localhost";
$user = "root";
$DBpass = "";
$db = "mygameapp";

$con = mysqli_connect($host, $user, $DBpass, $db);
if ( $con-> connect_error ){
    // If there is an error with the connection, stop the script and display the error.
    die ('Failed to connect to MySQL: ' .$con-> connect_error);
}

?>



<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .center-text{
            text-align: center;
            font-family: "Times New Roman", Times, serif;
        }
        #nav-img{
            margin-top: -15px;
        }
        h2{
            background-image: url(web-image/purple.png);
            margin-top: 0px;
            padding: 50px;
            margin-bottom: 20px;
            font-weight: bold;
            font-family: "Times New Roman", Times, serif;
        }
        .navbar{
            margin-bottom: 0px;
        }
        .table-font{
            font-size: 16px;
            font-family: "Times New Roman", Times, serif;
        }
        .table-head{
            font-size: 18px;
            font-family: "Times New Roman", Times, serif;
        }
        table{
            margin: 20px;
        }

        label{
            margin-left: 20px;
            font-family: "Times New Roman", Times, serif;
        }
        input{
            margin-left: 20px;
            margin-right: 20px;
            padding-bottom: 10px;
        }

        .btn{
            font-size: 15px;
            font-weight: bold;
            background-color: #9795cf;;
            border-color: #9795cf;
            text-align: center;
            font-family: "Times New Roman", Times, serif;

        }

        .top:link{
            text-decoration: none;
            color: white;
        }

        .top{
            color: white;
        }

        .btn:hover{
            background-color: #e8d3ff;
            border-color: #e8d3ff;
        }



    </style>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand"><img id="nav-img" src="web-image/nav.png"></a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="mainpage.php">Home</a></li>
                <li><a href="showUser.php">View User</a></li>
                <li><a href="showQuestion.php">View Question</a></li>
                <li><a href="showAnswer.php">View Result</a></li>
                <li><a href="uploadImage.php">Upload Question</a></li>
                <li><a href="showFeedback.php">Feedback</a></li>
                <li><a href="showNomination.php">Nomination</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="mainpage.php">How to use  <img src="web-image/question-mark.png"></a></li>
                <li><a href="login.php">Log out</a></li>
            </ul>
        </div>
    </div>
</nav>

<h2 class="center-text">User Information</h2>

<div class="row" >
    <div class="col-sm-6" style="text-align: right">
        <button class="btn btn-primary"><a href="showDetail.php" class="top">Click here to view user details</a></button>
    </div>
    <div class="col-sm-6" style="text-align: left">
        <button class="btn btn-primary"><a href="showStatement.php" class="top">Click here to view consent</a></button>
    </div>
</div>



<?php

$sql = "SELECT id, username, email, age FROM user";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    echo "<table class='table table-hover'><thead class='table-head'><tr><th>Id</th><th>Username</th><th>Email</th><th>Age(Month)</th></tr></thead>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tbody class='table-font'><tr><td>" . $row["id"] . "</td><td>" . $row["username"] . "</td><td> " . $row["email"] . "</td><td>".$row["age"]."</td></tr></tbody>";
    }
    echo "</table>";
} else {
    echo "<script>alert('No Result')</script>";
}



?>






</body>

</html>
