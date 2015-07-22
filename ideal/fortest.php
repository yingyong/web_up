<?php
header("content-type: application/x-javascript; charset=UTF8");
date_default_timezone_set("Asia/Bangkok");
include("database.php");
$type = $_POST["type"];
if ($type == "sendSMS") {
	$studentusername = $_POST['username'];
	$mobile = $_POST['mobile'];

	$link = mysql_connect(DATABASE_GLOBAL_PATH, GLOBAL_USERNAME, GLOBAL_PASSWORD);
	mysql_query("set names utf8");
	mysql_select_db(TABLE_GLOBAL_NAME);

	$sql = "select FCODE,FMOBILE,FPASSWORD,FUSERNAME from tstudent where FUSERNAME = '".$studentusername."'";
	$result = mysql_query($sql, $link);
	$out = mysql_fetch_assoc($result);
	mysql_close($link);

	if (!$out['FCODE']) {		
		echo json_encode('nousername');
	} else {
		
		if ($mobile=='no') {
			$mobile=$out['FMOBILE'];
		}

		$username = "idealx";
		$password ="ideal123";
		$to = $mobile;
		$sender = "IDEALPRIVAT";
		$baseurl ="http://messagedd.com";
		$text = urlencode("USERNAME = ".$out['FUSERNAME']. " : PASSWORD = ".$out['FPASSWORD']);
		$url =
		"$baseurl/httpapi/sendsms/sendsms.aspx?username=$username&password=$password&to=$to&text=$text&sender=$sender"; 
	
		$ret = file($url);
		echo json_encode($ret[0]);

	}
} else if ($type == "keepLog") {
	$studentusername = $_POST['username'];
	$mobile = $_POST['mobile'];
	$date = date("YmdHis");

	$link = mysql_connect(DATABASE_GLOBAL_PATH, GLOBAL_USERNAME, GLOBAL_PASSWORD);
	mysql_query("set names utf8");
	mysql_select_db(TABLE_GLOBAL_NAME);

	$sql = "insert into smslog values('".$date."', '".$mobile."', '".
		$studentusername."')";

	if (!mysql_query($sql, $link)) {
		mysql_close($link);
		echo json_encode("fail");
	} else {
		mysql_close($link);
		echo json_encode("yes");
	}
}
?>