<?php
/**
 * Created by PhpStorm.
 * User: Kun
 * Date: 2019-03-20
 * Time: 12:03
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
            text-align: center;
            font-family: "Times New Roman", Times, serif;
            color: white;


        }

        .btn:hover{
            background-color: #e8d3ff;
            color: white;
            border-color: #e8d3ff;
        }

        a{
            color: white;
        }

        a:link{
            text-decoration: none;
            color: white;
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

<h2 class="center-text">User Detail</h2>


<form action="showDetail.php" method="post" enctype="multipart/form-data" class="form-horizontal">

    <div class="input-group">
        <label style="font-size: 15px">You can view user details by entering username</label>
        <input type="text" style=" border-radius: 10px" name="username" placeholder="Username">
        <span class="input-group-btn" style="width:10px;">
            <button type="submit" name="submit" class="btn btn-default" style="text-align: center">Search</button>
        </span>
        <span class="input-group-btn" style="width:10px;">
            <button class="btn btn-default" style="text-align: center"><a href="showUser.php">Go back to check username</a></button>
        </span>
    </div>
</form>


<?php
if(isset($_POST['submit'])) {

    $username = $_POST['username'];

    $sql = "SELECT parentName, childName, childGender, dateOfBirth, postcode, phoneNumber, mumAge, mumEducation, dadAge, dadEducation, childEthnic FROM detail WHERE username ='" . $username." '";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        echo "<table class='table table-bordered'><thead class='table-head'><tr><th>Detail</th><th>Answer</th></tr></thead>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tbody class='table-font'>
                <tr>
                    <td>Parent's name</td>
                    <td>" . $row["parentName"] . "</td>
                </tr>
                 <tr>
                    <td>Child's name</td>
                    <td>" . $row["childName"] . "</td>
                </tr>
                 <tr>
                    <td>Is your child a girl or a boy?</td>
                    <td>" . $row["childGender"] . "</td>
                </tr>
                 <tr>
                    <td>Child's date of birth (dd/mm/yyyy)</td>
                    <td>" . $row["dateOfBirth"] . "</td>
                </tr>
                <tr>
                    <td>Postcode</td>
                    <td>" . $row["postcode"] . "</td>
                </tr>
                <tr>
                    <td>Phone number </td>
                    <td>" . $row["phoneNumber"] . "</td>
                </tr>
                <tr>
                    <td>How old is your child's mum?</td>
                    <td>" . $row["mumAge"] . "</td>
                </tr>
                <tr>
                    <td>You child's mum's highest education was</td>
                    <td>" . $row["mumEducation"] . "</td>
                </tr>
                <tr>
                    <td>How old is your child's dad?</td>
                    <td>" . $row["dadAge"] . "</td>
                </tr>
                <tr>
                    <td>You child's dad's highest education was</td>
                    <td>" . $row["dadEducation"] . "</td>
                </tr>
                <tr>
                    <td>Your child's ethnic group</td>
                    <td>" . $row["childEthnic"] . "</td>
                </tr>
               </tbody>";
        }
        echo "</table>";
    } else {
        echo "<script>alert('No result for family information')</script>";
    }

 $sql = "SELECT otherLanguage, languageType, times, familyDifficulty, difficultyDetail, disability, disabilityDetail, concer, concerDetail FROM languageQuestion WHERE username ='" . $username." '";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        echo "<table class='table table-bordered'>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tbody class='table-font'>
                <tr>
                    <td>Does your child hear any language other than English in a typical week, either through family or at a childcare setting or in a language class?</td>
                    <td>" . $row["otherLanguage"] . "</td>
                </tr>
                 <tr>
                    <td>What is the other language they sometimes hear?</td>
                    <td>" . $row["languageType"] . "</td>
                </tr>
                 <tr>
                    <td>And if they hear another language sometimes, how often does your child hear the language other than English in a typical week? Please include languages the child hears at childcare settings as well as family members' homes</td>
                    <td>" . $row["times"] . "</td>
                </tr>
                 <tr>
                    <td>Is there anyone in the child’s immediate family (brothers/sisters/parents only) with a speech / language difficulty or dyslexia?   </td>
                    <td>" . $row["familyDifficulty"] . "</td>
                </tr>
                <tr>
                    <td>If yes please give details here. What relation are they to the child, and what is or was their difficulty?</td>
                    <td>" . $row["difficultyDetail"] . "</td>
                </tr>
                <tr>
                    <td>Does your child have a developmental disability (e.g. Cerebral Palsy, ASD, Fragile X syndrome, Muscular dystrophy, Di George syndrome, Down’s syndrome, Williams syndrome)?</td>
                    <td>" . $row["disability"] . "</td>
                </tr>
                <tr>
                    <td>If yes please give details here</td>
                    <td>" . $row["disabilityDetail"] . "</td>
                </tr>
                <tr>
                    <td>Have you or anyone else had any concerns about your child’s hearing or communication?/td>
                    <td>" . $row["concer"] . "</td>
                </tr>
                <tr>
                    <td>If yes please give details here</td>
                    <td>" . $row["concerDetail"] . "</td>
                </tr>
                
               </tbody>";
        }
        echo "</table>";
    } else {
        echo "<script>alert('No result for language related details')</script>";
    }
}

?>

</body>

</html>

