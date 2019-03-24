<?php

$host = "localhost";
$user = "root";
$DBpass = "";
$db = "mygameapp";

$con = mysqli_connect($host, $user, $DBpass, $db);
if ( $con-> connect_error ){
    // If there is an error with the connection, stop the script and display the error.
    die ('Failed to connect to MySQL: ' .$con-> connect_error);
}

$index = 0;
$sql = "SELECT id FROM question";
$result = $con->query($sql);
while($row = $result->fetch_assoc()){
    $index++;
}

$userNumber = 0;
$sql_getUserNumber = "SELECT id FROM user";
$result_for_usernumber = $con->query($sql_getUserNumber);
while($row_for_usernum = $result_for_usernumber->fetch_assoc()){
    $userNumber++;
}


function checkInvalidInput($input){
    if(is_numeric($input)){
        return true;
    }else{
        return false;
    }
}

?>




<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Show Answers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .center-text{
            text-align: center;
            font-family: "Times New Roman", Times, serif;
        }

        h2{
            background-image: url(web-image/purple.png);
            padding: 50px;
            margin-top: 0px;
            font-family:"Times New Roman", Times, serif;
            font-weight: bold;

        }
        .navbar{
            margin-bottom: 0px;
        }
        #nav-img{
            margin-top: -15px;
        }
        thead{
            font-size: 20px;
        }
        table{
            margin-top: 25px;
            margin-left: 15px;
            margin-right: 25px;
            font-size: 17px;
            font-family: "Times New Roman", Times, serif;
            text-align: center;

        }

        input{
            border-radius: 10px;
        }

        .see{
            color: #9795cf;
            font-weight: bold;
        }

        label{
            font-family: "Times New Roman", Times, serif;
            font-size: 17px;
            font-weight: lighter;
        }

        .btn{
            margin-top: 10px;
            background-color: #9795cf;
            border-color: #9795cf;
            width: 200px;
        }

        .btn:hover{
            background-color:#e8d3ff;
            border-color: #e8d3ff;
        }

        th{
            text-align: center;
        }

        .see:hover{
            color: #e8d3ff;
        }

        .see:link{
            text-decoration: none;
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

<h2 class="center-text">Results</h2>

<div class = "row">
    <div class="col-sm-6" style="text-align: center">
        <h4>The total number of questions in the database now is: <?php echo $index ?></h4>
        <a href="showQuestion.php" class="see">See question here</a>
    </div>
    <div class="col-sm-6" style="text-align: center">
        <h4>The total number of user in the database now is: <?php echo $userNumber ?></h4>
        <a href="showUser.php" class="see">See user ID here</a>
    </div>


    <br>
    <br>
    <br>
    <br>

<form action="showAnswer.php" method="post" enctype="multipart/form-data">
    <div class="row" >
        <div class="col-sm-6" style="text-align: right">
            <label>Which question you want to see</label>
        </div>
        <div class="col-sm-6" style="text-align: left">
            <input type="text" name="questionIndex" placeholder="Enter question ID">
        </div>
    </div>
    <div class="row" >
        <div class="col-sm-6" style="text-align: right">
            <label>Which user you want to see</label>
        </div>
        <div class="col-sm-6" style="text-align: left">
            <input type="text" name="userIndex" placeholder="Enter user ID">
        </div>
    </div>
    <button type="submit" name="submit" class="btn btn-primary center-block" style="text-align: center">Search</button>
</form>

<?php

if(isset($_POST['submit'])){
    $fetch = 0;
    $questionFetch = $_POST['questionIndex'];
    $userFetch = $_POST['userIndex'];



    if (empty($questionFetch) && empty($userFetch)){
        echo "<script>alert('Two fields cannot be both empty')</script>";
        $fetch = 0;
    }



    if(!empty($questionFetch) && empty($userFetch)){
        $valid = checkInvalidInput($questionFetch);
        if($valid == true) {
            if(intval($questionFetch) > intval($index)){
                echo "<script>alert('No such question')</script>";
                $fetch = 0;
            }else{
                $fetch = 1;
            }
        }else{
            echo "<script>alert('Invalid Input')</script>";
        }
    }

    if(!empty($userFetch) && empty($questionFetch)){
        $valid = checkInvalidInput($userFetch);
        if ($valid == true){
            $fetch = 2;
        }else{
            $fetch = 0;
            echo "<script>alert('Invalid Input')</script>";
        }

    }

    if(!empty($userFetch) && !empty($questionFetch)){
        $valid1 = checkInvalidInput($questionFetch);
        $valid2 = checkInvalidInput($userFetch);
        if($valid1 && $valid2){
            $fetch = 3;
        }else{
            echo "<script>alert('Invalid Input')</script>";
            $fetch = 0;
        }
    }

    if($fetch == 1){
        $sql = "SELECT uID, qID, questionContext, answer_q FROM answerForQuestion WHERE qID=" . $questionFetch;
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            echo "<table class='table table-hover'><thead class='table-head'><tr><th>userID</th><th>qID</th><th>question-context</th><th>answer</th></tr></thead>";
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tbody class='table-body'><tr><td>" . $row["uID"] . "</td><td>".$row["qID"]."</td><td>" . $row["questionContext"] . "</td><td> " . $row["answer_q"] . "</td></tr></tbody>";
            }
            echo "</table>";
        } else {
            echo "<script>alert('No result')</script>";
        }
    }


    if($fetch == 2) {
        $sql = "SELECT uID, qID, questionContext, answer_q FROM answerForQuestion WHERE uID=" . $userFetch;
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            echo "<table class='table table-hover'><thead class='table-head'><tr><th>userID</th><th>questionID</th><th>question-context</th><th>answer</th></tr></thead>";
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tbody class='table-body'><tr><td>" . $row["uID"] . "</td><td>".$row["qID"]."</td><td>" . $row["questionContext"] . "</td><td> " . $row["answer_q"] . "</td></tr></tbody>";
            }
            echo "</table>";
        } else {
            echo "<script>alert('No result')</script>";
        }


    }


    if($fetch == 3) {
        $sql = "SELECT uID, questionContext, answer_q FROM answerForQuestion WHERE uID='" .$userFetch. "'AND qID='" .$questionFetch."'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            echo "<table class='table table-hover'><thead class='table-head'><tr><th>userID</th><th>question-context</th><th>answer</th></tr></thead>";
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tbody class='table-body'><tr><td>" . $row["uID"] . "</td><td>" . $row["questionContext"] . "</td><td> " . $row["answer_q"] . "</td></tr></tbody>";
            }
            echo "</table>";
        } else {
            echo "<script>alert('No result')</script>";
        }

    }

}



?>
</body>
</html>
