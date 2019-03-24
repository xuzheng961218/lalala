<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .center-text{
            text-align: center;
        }
        #nav-img{
           margin-top: -15px;
        }

        h1{
            background-image: url(web-image/purple.png);
            padding: 50px;
            margin-top: 0px;
        }
        .navbar{
            margin-bottom: 0px;
        }
        * {
            box-sizing: border-box;
        }


        .row {
            margin: 20px;
        }

        /* Add padding BETWEEN each column */
        .row,
        .row > .column {
            padding: 10px;
        }

        /* Create four equal columns that floats next to each other */
        .column {
            float: left;
            width: 25%;
        }

        /* Clear floats after rows */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Content */
        .content {
            background-color: #e8d3ff;
            padding: 10px;
            height: 360px;
        }

        .des{
            color: white;
            font-weight: bolder;
        }


    </style>
</head>

<body>
<nav class="navbar navbar-default navbar-static-top" >
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
<div class="head-bar">
    <h1 class="center-text">Sentence Game for Children</h1>
</div>


<!-- Portfolio Gallery Grid -->
<div class="row">
    <div class="column">
        <div class="content">
            <img src="web-image/login.png" alt="Mountains" style="width:100%">
            <h3>Login</h3>
            <p>Existing users can login in this page on app</p>
        </div>
    </div>
    <div class="column">
        <div class="content">
            <img src="web-image/register.png" alt="Lights" style="width:100%">
            <h3>Register</h3>
            <p>Users can sign up in this page on app, you can click <a href="showUser.php" class="des">View User</a> to view the user list </p>
        </div>
    </div>
    <div class="column">
        <div class="content">
            <img src="web-image/consent.png" alt="Lights" style="width:100%">
            <h3>Consent Form</h3>
            <p>The consent form is used to ask if users are willing to stay remain on database and receive newsletter. You can click <a href="showStatement.php" class="des">View Consent</a> to see data</p>
        </div>
    </div>
    <div class="column">
        <div class="content">
            <img src="web-image/question.png" alt="Lights" style="width:100%">
            <h3>Questions</h3>
            <p>Questions will be shown randomly in this page on app, you can click <a href="showQuestion.php" class="des">View Question</a> to see questions and pictures.</p>
            <p>You can click <a href="showAnswer.php" class="des">View Result</a> to see users' answer</p>
        </div>
    </div>
</div>

<div class="row">

<div class="column">
    <div class="content">
        <img src="web-image/detail.png" alt="Nature" style="width:100%">
        <h3>User Detail</h3>
        <p>Users need to fill in their family information after creating account, you can click <a href="showDetail.php" class="des">View Details</a> to see this information by entering username of a specific user </p>
    </div>
</div>
<div class="column">
    <div class="content">
        <img src="web-image/language.png" alt="Mountains" style="width:100%">
        <h3>Language Related Questions</h3>
        <p>The language related issues are asked after family information, and you can also click <a href="showDetail.php" class="des">View Details</a> to see  </p>
    </div>
</div>

    <div class="column">
        <div class="content">
            <img src="web-image/feedback.png" alt="Lights" style="width:100%">
            <h3>Feedback</h3>
            <p>You can click <a href="showFeedback.php" class="des">Feedback</a> to see users' feedback about the survey</p>
        </div>
    </div>
        <div class="column">
            <div class="content">
                <img src="web-image/nomination.png" alt="Lights" style="width:100%">
                <h3>Nomination</h3>
                <p>You can click <a href="showNomination.php" class="des">Nomination</a> to see if user nominate a friend</p>
            </div>
        </div>

</div>

</div>

</body>

</html>