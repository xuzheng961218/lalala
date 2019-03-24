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

// when user pressed login button
if (isset($_POST['submit'])) {
	$uname = $_POST['user'];
	$password = $_POST['pass'];

	if(empty($_POST['user'])){
		$message_empty = "username cannot be empty";
		echo "<script type='text/javascript'>alert('$message_empty');</script>";

	}else {
		$stmt = $con->prepare("SELECT username, password FROM psychologist WHERE username = ?");
		$stmt-> bind_param("s", $uname);
		$stmt-> execute();
		$stmt->store_result();
		if($stmt->num_rows != 1){
			$message_no_exist = "username does not exist";
			echo "<script type='text/javascript'>alert('$message_no_exist');</script>";
		}else{
			$stmt->bind_result($name, $code);
			$stmt->fetch();
			$psychologist = array();
        	$psychologist['username'] = $name;
        	$psychologist['password'] = $code;
        	if($psychologist['password'] == $password){
        		header("location:mainpage.php");
        	}else{
        		$message_wrong_password = "You entered the wrong password";
        		echo "<script type='text/javascript'>alert('$message_wrong_password');</script>";
        	}
		}
	}
}

?>



<!DOCTYPE HTML> 
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign-In</title>
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
        .pull-right{
            color: darkslateblue;
        }
        .pull-right:link{
            text-decoration: none;
        }
    </style>
</head>

<body>
<div class="login-form">
    <form method="POST" action="login.php">
        <h2 class="text-center">Sentence Game for Children</h2>

        <div class="form-group">
        <input type="text" name="user" class="form-control" placeholder="Username"><br>
        </div>
        <div class="form-group">
        <input type="password" name="pass" class="form-control" placeholder="Password""><br>
        </div>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div class="clearfix">
            <a href="changePass.php" class="pull-right">Change Password</a>
        </div>
    </form>

</div>
</body>
</html> 