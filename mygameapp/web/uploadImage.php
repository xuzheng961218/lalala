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

if(isset($_POST['submit'])){
    $number=0;

	$name1 = $_POST['name1'];
	$img1 = $_FILES['image1']['name'];
	$name2 = $_POST['name2'];
	$img2 = $_FILES['image2']['name'];
	$name3 = $_POST['name3'];
	$img3 = $_FILES['image3']['name'];
	$name4 = $_POST['name4'];
	$img4 = $_FILES['image4']['name'];

    if(verifyInput($name1, $img1) && verifyInput($name2, $img2) && verifyInput($name3, $img3) && verifyInput($name4, $img4)){
        $number=1;
    }else{
         echo "<script>alert('Some field missing')</script>";
    }
	
    //&& verifyInput($name2, $img2) && verifyInput($name3, $img3) && verifyInput($name4, $img4)



    if($number == 1){
        if(move_uploaded_file($_FILES['image1']['tmp_name'], "photo-".$name1) && move_uploaded_file($_FILES['image2']['tmp_name'], "photo-".$name2) && move_uploaded_file($_FILES['image3']['tmp_name'], "photo-".$name3) && move_uploaded_file($_FILES['image4']['tmp_name'], "photo-".$name4)){
            $pathInfo1 = "http://localhost/mygameapp/web/photo-".$name1;
            $pathInfo2 = "http://localhost/mygameapp/web/photo-".$name2;
            $pathInfo3 = "http://localhost/mygameapp/web/photo-".$name3;
            $pathInfo4 = "http://localhost/mygameapp/web/photo-".$name4;

            $sql = "INSERT INTO question (description1, description2, description3, description4, photo1, photo2, photo3, photo4) VALUES ('$name1','$name2','$name3','$name4', '$pathInfo1','$pathInfo2' ,'$pathInfo3' ,'$pathInfo4')";
            if ($con->query($sql) === TRUE) {
                echo "New record created successfully";
                echo "<script>alert('Image has been Uploaded to Folder')</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }

        }else{
                echo "<script>alert('Image cannot be uploaded to Folder')</script>";

        }
    }	
}

function verifyInput($name, $image){
    if(!empty($name) && !empty($image)){
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
		<title>Image Upload Into Folder Using PHP</title>
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

            .btn{
                margin-top: 30px;
                background-color: #9795cf;
                border-color: #9795cf;
                width: 300px;
            }

            .btn:hover{
                background-color: #e8d3ff;
                border-color: #e8d3ff;
            }

            h4{
                margin-bottom: 30px;
                color: #9692af;
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

<h2 class="center-text">Upload New Question</h2>
<h4 style="text-align: center">Notice: One question consists of 4 photo descriptions and 4 photos uploaded each time</h4>

<form action="uploadImage.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-6" style="text-align: right">
            <label>Photo1-Description</label>
        </div>
        <div class="col-sm-6" style="text-align: left">
            <input type="text" name="name1">
        </div>
    </div>
<br>
    <div class="row">
        <div class="col-sm-6" style="text-align: right">
            <label>Select Image To Upload</label>
        </div>
        <div class="col-sm-6" style="text-align: left">
            <input type="file" name="image1">
        </div>
<br>
        <br>
        <div class="row">
            <div class="col-sm-6" style="text-align: right">
                <label>Photo2-description</label>
            </div>
            <div class="col-sm-6" style="text-align: left">
                <input type="text" name="name2">
            </div>
        </div>

<br>
        <div class="row">
            <div class="col-sm-6" style="text-align: right">
                <label>Select Image To Upload</label>
            </div>
            <div class="col-sm-6" style="text-align: left">
                <input type="file" name="image2">
            </div>
        </div>
<br>
        <div class="row">
            <div class="col-sm-6" style="text-align: right">
                <label class=>Photo3-Description</label>
            </div>
            <div class="col-sm-6" style="text-align: left">
                <input class= type="text" name="name3">
            </div>
        </div>

<br>
        <div class="row">
            <div class="col-sm-6" style="text-align: right">
                <label>Select Image To Upload</label>
            </div>
            <div class="col-sm-6" style="text-align: left">
                <input type="file" name="image3">
            </div>
        </div>

<br>
        <div class="row">
            <div class="col-sm-6" style="text-align: right">
                <label>Photo4-Description</label>
            </div>
            <div class="col-sm-6" style="text-align: left">
                <input type="text" name="name4">
            </div>
        </div>

<br>
        <div class="row">
            <div class="col-sm-6" style="text-align: right">
                <label>Select Image To Upload</label>
            </div>
            <div class="col-sm-6" style="text-align: left">
                <input type="file" name="image4">
            </div>
        </div>

        <button type="submit" name="submit" class="btn btn-primary center-block" style="text-align: center">Upload</button>

	
</form>


</body>
</html>




