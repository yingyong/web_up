<?php
	session_start();
	$user = $_SESSION["username"];
	$name = $_SESSION["name"];
	$sname = $_SESSION["surname"];
	$ename = $_SESSION["enname"];
	$esname = $_SESSION["ensname"];
	$email = $_SESSION["email"];
	$address = $_SESSION["address"];
	$title = $_SESSION["title"];
	echo "<script>localStorage.setItem('username',\"$user\");</script>";
	echo "<script>localStorage.setItem('name',\"$name\");</script>";
	echo "<script>localStorage.setItem('surname',\"$sname\");</script>";
	echo "<script>localStorage.setItem('enname',\"$ename\");</script>";
	echo "<script>localStorage.setItem('ensname',\"$esname  \");</script>";
	echo "<script>localStorage.setItem('email',\"$email\");</script>";
	echo "<script>localStorage.setItem('address',\"$address\");</script>";
	echo "<script>localStorage.setItem('title',\"$title\");</script>";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!--<meta content="width=1024" name="viewport" content="width=device-width minimum-scale=1, maximum-scale=1">-->
<meta http-equiv="cache-control" content="no-cache" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Untitled Document</title>
<link rel="stylesheet" href="css/stylesheet.css">
<script src="js/jquery.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/select.js"></script>
<link rel="stylesheet" href="css/jquery.mobile-1.3.1.min.css" />
<script src="js/jquery.mobile-1.3.1.min.js"></script>
<script>
	/*$(document).ready(function(e) {
        var username = localStorage.getItem('username');
		alert (username);
    });*/
</script>
</head>

<body onload="init()">
	<div data-role="page" id="select">
        <div data-role="content">
        	
        	<div class="teach">
                <div>
                	<a href="chat.html" data-transition="slide" target="_self" data-ajax="false" rel="external" onClick="setchatroom1();"><img src="images/p_muk_300.png"></a>
                </div><br>
                <div><img src="images/k_ploy_300.png"></div><br>
                <div><img src="images/p_orn_300.png"></div>
                <!--<div><h1><?php echo $_SESSION["username"]; ?></h1></div>-->
            </div>    
        </div>
        
            </div>
    
</body>
</html>
