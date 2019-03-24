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

?>



<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Show Questions</title>
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
            padding: 50px;
            margin-top: 0px;
            font-family:"Times New Roman", Times, serif;
            font-weight: bold;

        }
        .navbar{
            margin-bottom: 0px;
        }
        .table-head{
            font-size: 20px;
        }

        .btn{
            font-size: 15px;
            font-weight: bold;
            background-color: #9795cf;;
            text-align: center;
            font-family: "Times New Roman", Times, serif;
            color: white;


        }

        .btn:hover{
            background-color: #e8d3ff;
            color: white;
            border-color: #e8d3ff;
        }

        h4{
            margin-left: 5px;
            font-family: "Times New Roman", Times, serif;
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
        table{
            margin-top: 25px;
            font-size: 20px;
            font-family: "Times New Roman", Times, serif;

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
                <li><a href="showFeedback.php.php">Feedback</a></li>
                <li><a href="showNomination.php">Nomination</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="mainpage.php">How to use  <img src="web-image/question-mark.png"></a></li>
                <li><a href="login.php">Log out</a></li>
            </ul>
        </div>
    </div>
</nav>

<h2 class="center-text">Questions</h2>

<h4>The total number of questions in the database now is: <?php echo $index ?></h4>

<form action="showQuestion.php" method="post" enctype="multipart/form-data" class="form-horizontal">

    <div class="input-group">
        <label style="font-size: 15px">I want to view question</label>
        <input type="text" style=" border-radius: 10px" name="questionIndex" placeholder="Question ID">
        <span class="input-group-btn" style="width:30px;">
            <button type="submit" name="submit" class="btn btn-default" style="text-align: center">Search</button>
        </span>
    </div>
</form>




<?php
if(isset($_POST['submit'])){
    $show = true;
    $questionShown =$_POST['questionIndex'];

    if (!empty($questionShown)){
        if(!is_numeric($questionShown)){
            echo "<script>alert('Invalid Input!')</script>";
            $show = false;
        }else if (intval($questionShown) > intval($index)) {
            echo "<script>alert('No such question')</script>";
            $show = false;
        }
    }else{
        echo "<script>alert('question cannot not be empty')</script>";
        $show = false;
    }



    if($show == true){
        $stmt = $con->prepare("SELECT question1, question2, question3,question4,photo1, photo2, photo3, photo4 FROM question WHERE id= ?");
        $stmt-> bind_param("i", $questionShown);
        $stmt-> execute();
        $stmt->store_result();
        $stmt->bind_result($des1, $des2, $des3, $des4, $photo1, $photo2, $photo3, $photo4);
        $stmt->fetch();
        $question = array();
        $question['des1']= $des1;
        $question['des2']= $des2;
        $question['des3']= $des3;
        $question['des4']= $des4;
        $question['photo1'] = $photo1;
        $question['photo2'] = $photo2;
        $question['photo3'] = $photo3;
        $question['photo4'] = $photo4;


        echo '<table class="table table-hover">
              <thead class="table-head">
              <tr>
                <th style="text-align: center">Question Description</th>
                <th style="text-align: center">Image</th>
              </tr>
              </thead>
              <tbody class="table-body">
              <tr>
                <td style="text-align:center">'.$question['des1'].'</td>
                <td style="text-align:center"> <img src="'.$question['photo1']. '" width="150px" height="150px"/></td>
              </tr>
              <tr>
                <td style="text-align:center">'.$question['des2'].'</td>
                <td style="text-align:center"> <img src="'.$question['photo2']. '" width="150px" height="150px"/></td>
              </tr>
              <tr>
                <td style="text-align:center">'.$question['des3'].'</td>
                <td style="text-align:center"> <img src="'.$question['photo3']. '" width="150px" height="150px"/></td>
              </tr>
              <tr>
                <td style="text-align:center">'.$question['des4'].'</td>
                <td style="text-align:center"> <img src="'.$question['photo4']. '" width="150px" height="150px"/></td>
              </tr>
              </tbody>';



        /* echo '<img src="'.$question['photo1']. '" width="200px" height="200"/>';
         echo '<img src="'.$question['photo2']. '" width="200px" height="200"/>';
         echo '<img src="'.$question['photo3']. '" width="200px" height="200"/>';
         echo '<img src="'.$question['photo4']. '" width="200px" height="200"/>';*/



    }



}
?>
</body>
</html>