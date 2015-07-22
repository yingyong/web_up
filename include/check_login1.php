<?php
header('Access-Control-Allow-Origin: *');
session_start(); 
include("startconnect.inc");
//$username = $_POST['user'];
//$username = 'Test';
//$username = 'CHONTHICHA.ANA';
//$password = '42254';
$username = strtoupper(trim($_POST["user"]));
$password = strtolower(trim($_POST["pass"]));
$key = $_POST["key"];
$err="";

if ($username == ''){
   $err.="ERROR 01"; 
}

$sql = "update tstudent set flogin_verify='' where fcode='{$studentlogin_code}'";
$res_u = $db->Execute($sql);

$sql = "select u.fpassword,concat(u.ftitle,u.fname,' ',u.fsurname),u.fname,u.fsurname,u.fcode,u.fbranch from tstudent u where u.fusername='$username'"; 
$result = $db->Execute($sql);
if ($result === false) die("failed[1]");
if (!$result->EOF) {
	$pw = trim($result->fields[0]);
	$userlogin_name = $result->fields[1];
	$userlogin_fname = $result->fields[2];
	$userlogin_lname = $result->fields[3];
	$studentlogin_code=$result->fields[4];
	$userlogin_branch = $result->fields[5];
	if ($password != $pw) {
		$err.="Invalid user/password[2]"; 
	}else {			
		$sql = "update tstudent set flogin_verify='{$key}' where fcode='{$studentlogin_code}'";
		$res_u = $db->Execute($sql);
	}
} else {
	$err.="Invalid user/password[1]";
}

include("stopconnect.inc");

$_SESSION["usercode"] = $username;
$_SESSION["username"] = $username;
$_SESSION["userlogin_name"] = $userlogin_name;
$_SESSION["userlogin_fname"] = $userlogin_fname;
$_SESSION["userlogin_lname"] = $userlogin_lname;
$_SESSION["studentlogin_code"] = $studentlogin_code;
$_SESSION["userlogin_branch"] = $userlogin_branch;

echo (strlen($err)==0)?1:$err;

//echo $_SESSION["username"];

/*if($username!=""){
	//echo $username;
	$json_data=array(
	"username"=>$username,
	"password"=>$password,
	"key"=>$key
	);
	$json= json_encode($json_data);
	echo $json;
}*/

?>
