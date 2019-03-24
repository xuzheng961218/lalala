<?php
/**
 * Created by PhpStorm.
 * User: Kun
 * Date: 2019-03-13
 * Time: 17:10
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

// when user pressed login button
if (isset($_POST['submit'])) {
	$uname = $_POST['user'];
	$oldPassword = $_POST['old-pass'];
	$newPassword = $_POST['new-pass'];
	$repeatPassword = $_POST['repeat-new-pass'];

	if(empty($_POST['user'])){
		$message_empty = "username cannot be empty";
		echo "<script type='text/javascript'>alert('$message_empty');</script>";

	}else {
		$stmt = $con->prepare("SELECT username, password FROM psychologist WHERE username = ? AND password = ?");
		$stmt-> bind_param("ss", $uname, $oldPassword);
		$stmt-> execute();
		$stmt->store_result();
		if($stmt->num_rows != 1){
			$message_incorrect = "username or password incorrect";
			echo "<script type='text/javascript'>alert('$message_incorrect');</script>";
		}else{
		    if(!empty($newPassword)){
                if($newPassword == $repeatPassword){
                    $stmt = $con->prepare("UPDATE psychologist SET password = ? WHERE username = ?");
                    $stmt-> bind_param("ss", $newPassword, $uname);
                    $stmt-> execute();
                    if($stmt-> execute()){
                        echo "<script>alert('Change password successfully')</script>";
                    }
                }else{
                    $message_no_match = "New password and repeat new password different";
                    echo "<script type='text/javascript'>alert('$message_no_match');</script>";
                }
            }else{
                echo "<script>alert('New password cannot be empty')</script>";
            }


		}
	}
}

?>



<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{
            background-image: url(web-image/loginBG.png);
        }
        .login-form {
            width: 340px;
            margin: 50px auto;
        }
        .login-form form {
            margin-top: auto;
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 50px;
        }
        .login-form h2 {
            margin: 0 0 15px;
        }
        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
        }
        .btn {
            font-size: 15px;
            font-weight: bold;
            background-color: darkslateblue;
        }
        .btn:hover{
            background-color: #9795cf;
            border-color: #9795cf;
        }
        .btn-link:link{
            text-decoration: none;
            font-weight: bold;
        }

    </style>
</head>

<body>
<div class="login-form">
    <form method="POST" action="changePass.php">
        <h2 class="text-center">Change Password</h2>

        <div class="form-group">
        <input type="text" name="user" class="form-control" placeholder="Username"><br>
        </div>
        <div class="form-group">
        <input type="password" name="old-pass" class="form-control" placeholder="Old Password""><br>
        </div>
        <div class="form-group">
            <input type="password" name="new-pass" class="form-control" placeholder="New Password""><br>
        </div>
        <div class="form-group">
            <input type="password" name="repeat-new-pass" class="form-control" placeholder="Repeat New Password""><br>
        </div>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Confirm</button>
            <br>
            <button class="btn btn-primary btn-block"><a href="login.php" style="color: white" class="btn-link">Go back to login</button>
        </div>
    </form>

</div>
</body>
</html>