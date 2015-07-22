<?php
	header("access-control-allow-origin: *");

	//$_POST['name'] = '6104';
	$name = $_POST['name'];

	$objConnect = mysql_connect("localhost","idealup_booking","@booking*27");
	$objDB = mysql_select_db("idealup_booking");

	$strSQL = "SELECT * FROM course WHERE courseid = '".$name."' ";
	mysql_query("SET NAMES UTF8");
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);

	$arr = array('name' => $objResult['name'],
				'course'=>$objResult['courseid'],
				'detail' => $objResult['description'],
				'price' => $objResult['price']
				);
	echo json_encode($arr);
	
	mysql_close($objConnect);
?> 