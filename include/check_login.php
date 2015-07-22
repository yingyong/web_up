<?php 
header('Content-Type: application/json; charset=UTF-8');
header('Content-type: text/javascript; charset=UTF-8');
header('Content-Type: application/x-javascript; charset=UTF-8');
//require_once('demoConnect.php'); 

$server = "www.ideal-x.net";
$dbusername = "admindb";
$dbpassword = "idealadm*27";
$database = "Learning";


$con = mysql_connect($server, $dbusername, $dbpassword) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);


//$username = 'SUNTARAPHON.JEE';
//$password = '1732325';

$username = trim($_POST["username"]);
$password = trim($_POST["password"]);
//$username = trim($_GET["username"]);
//$password = trim($_GET["password"]);
//$username = 'admin';
//$password = trim($_GET["password"]);
//mysql_select_db($database_demoConnect, $demoConnect);
//$q="SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."'";
$q = "SELECT * FROM tstudent WHERE FUSERNAME='$username' AND FPASSWORD ='$password' ";
//$q = "SELECT * FROM user WHERE username='$username'";
$qr=mysql_query($q);
if($rs=mysql_fetch_array($qr)){
$json_data=array(
"username"=>$rs['FUSERNAME'],
"password"=>$rs['FPASSWORD'],
//"password"=>$rs['FPASSWORD'],
//"password"=>$rs['password'],
);
}

else{
$json_data=array(
"username"=>'error',
"password"=>'error',
//"username"=>$rs['username'],
//"password"=>$rs['password'],
);
}

/*if($rs=mysql_fetch_array($qr)){
$json_data=array(
"username"=>$rs['username'],
//"username"=>$rs['username'],
//"password"=>$rs['password'],
);
}
else{
$json_data=array(
"username"=>'error',
//"username"=>$rs['username'],
//"password"=>$rs['password'],
);
}*/


$json= json_encode($json_data);
$callback = empty($_GET["callback"]) ? 'callback' : $_GET["callback"];
echo $callback . "(" . $json . ")";
exit(0);


?>
