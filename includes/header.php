<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exchange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="main">
	<div id="banner">
	<div id="header">
	    <a href="index.php"><h1>Exchange</h1></a>
	</div>
<div id="user_area">
<?php

if (logged_in()) {
    ?>
    <div id="name">
    <?php
    echo "Hello";
    ?>
        <a href="profile.php"><?php echo $_SESSION['username'];?></a></div>
        <div id='logout'>
            <form action="logout.php">
            <button id="logout_button" type="">Log Out</button>
        </form>
        </div>
    <?php
}
else
{
    ?>

            <div id="reg">
                <form action="registration.php">
                <button id="sign_button" type="">Sign Up</button>
            </form>
            </div>
            <div id="log">
                <form action="login.php">
                <button id="log_button" type="">Log In</button>
            </form>
            </div>

    <?php
}
?>
</div>
<?php
if($_SESSION['status']!='0' && logged_in())
{
    ?>
        <div id="add_post">
            <form action="post.php">
                <button id="add_post_button" type="">Add a post</button>
            </form>
        </div>
    <?php
}
?>
</div>
