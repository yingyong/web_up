<?php
header("content-type: application/x-javascript; charset=UTF8");
date_default_timezone_set("Asia/Bangkok");
include("database.php");
$type = $_POST["type"];
if ($type == "getlog") {
	$filter = $_POST['filter'];	

	$link = mysql_connect(DATABASE_GLOBAL_PATH, GLOBAL_USERNAME, GLOBAL_PASSWORD);
	mysql_query("set names utf8");
	mysql_select_db(TABLE_GLOBAL_NAME);

	$sql = "select * from smslog where (1=1) ".$filter." order by 
	 datetime desc limit 100";
	$sql = str_replace("\'", "'", $sql);

	//die($sql);

	$result = mysql_query($sql, $link);
	$row = 0;

	while ($record = mysql_fetch_assoc($result)) {

		foreach ($record as $field => $value) {

			$out[$row][$field] = $value;	

		}

		$row++;		
	}

	mysql_close($link);
	echo json_encode($out);
}
?>