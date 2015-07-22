<?php

	$strTo = $_POST["txtTo"];
	$strname = $_POST['txt_name'];
	$strSubject = "ติดต่อจาก $strname";
	
	 $strMessage  = "<b>ชื่อ:</b>".$_POST["txt_name"]
	."<br/></br><b>อีเมล:</b> ".$_POST["txt_email"]
	."<br/></br><b>ข้อความ:</b> ".$_POST["txt_message"];
	
	
	
	//*** Uniqid Session ***//
	$strSid = md5(uniqid(time()));

	$strHeader = "";
	$strHeader .= "From: ".$_POST["txt_name"]."<".$_POST["txt_email"].">\nReply-To: ".$_POST["txt_email"]."";

	$strHeader .= "MIME-Version: 1.0\n";
	$strHeader .= "Content-Type: multipart/mixed; boundary=\"".$strSid."\"\n\n";
	$strHeader .= "This is a multi-part message in MIME format.\n";

	$strHeader .= "--".$strSid."\n";
	$strHeader .= "Content-type: text/html; charset=utf-8\n"; // or UTF-8 //
	$strHeader .= "Content-Transfer-Encoding: 7bit\n\n";
	$strHeader .= $strMessage."\n\n";
	
	//*** Attachment ***//
	/*if($_FILES["fileAttach"]["name"] != "")
	{
		$strFilesName = $_FILES["fileAttach"]["name"];
		$strContent = chunk_split(base64_encode(file_get_contents($_FILES["fileAttach"]["tmp_name"]))); 
		$strHeader .= "--".$strSid."\n";
		$strHeader .= "Content-Type: application/octet-stream; name=\"".$strFilesName."\"\n"; 
		$strHeader .= "Content-Transfer-Encoding: base64\n";
		$strHeader .= "Content-Disposition: attachment; filename=\"".$strFilesName."\"\n\n";
		$strHeader .= $strContent."\n\n";
	}*/
	if(trim($_POST["txt_name"]) == "")
	{
		$arr = array('response' => 'ไม่สามารถส่ง email ได้');
		echo json_encode($arr);
	}
	
	if(trim($_POST["txt_email"]) == "")
	{
		$arr = array('response' => 'ไม่สามารถส่ง email ได้');
		echo json_encode($arr);
	}
	
	if(trim($_POST["txt_message"]) == "")
	{
		$arr = array('response' => 'ไม่สามารถส่ง email ได้');
		echo json_encode($arr);
	}
	

	$flgSend = @mail($strTo,$strSubject,null,$strHeader);  // @ = No Show Error //
	if($flgSend)
	{
		$arr = array('response' => 'ส่ง email สำเร็จ');
		echo json_encode($arr);
		
		
	}
	else
	{
		$arr = array('response' => 'ไม่สามารถส่ง email ได้');
		echo json_encode($arr);
	}
?>