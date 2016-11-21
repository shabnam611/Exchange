<html>
<head>
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
		if (admin_logged_in()) {
		    ?>
		    <div id="name" style="color:#FF1600;">
		    <?php
		    echo "Hello";
		    ?>
		        <?php echo $_SESSION['username'];?></div>
		        <div id='logout'>
		            <form action="admin_logout.php">
		            <button id="logout_button" type="">Log Out</button>
		        </form>
		        </div>
		    <?php
		}
		?>
		</div>
	</div>
