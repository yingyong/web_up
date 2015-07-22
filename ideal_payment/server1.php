<?php
	header("access-control-allow-origin: *");

	//$_POST['name'] = 'bp';
	$name = $_POST['name'];

	$objConnect = mysql_connect("localhost","idealup_booking","@booking*27");
	$objDB = mysql_select_db("idealup_booking");

	$strSQL = "SELECT * FROM course WHERE course = '".$name."' order by id ";
	mysql_query("SET NAMES UTF8");
	$objQuery = mysql_query($strSQL);
	while($objResult = mysql_fetch_array($objQuery)){

	/*$arr = array('name' => $objResult['name'],
				'course'=>$objResult['courseid'],
				'detail' => $objResult['description'],
				'price' => $objResult['price']
				);
	echo json_encode($arr);*/
	
	
	
	$json_data[]=array(
		'name' => $objResult['name'],
		'course' => $objResult['courseid'],
		'price' => $objResult['price']
				);
				
	}
	$json= json_encode($json_data);
	echo $json; 
	
	mysql_close($objConnect);
?>