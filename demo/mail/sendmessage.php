<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>


<html>
 <body>
<?php

	$strTo = $_POST["txtTo"];
	if($strTo != ""){
		$strTo = "ideal.icomment@gmail.com";	
	}
	$strname = $_POST['txt_name'];
	$strSubject = "ติดต่อจาก $strname";
	
	 $strMessage  = "<b>ชื่อ:</b>".$_POST["txt_name"]
	."<br/></br><b>อีเมล:</b> ".$_POST["txt_email"]
	."<br/></br><b>ข้อความ:</b> ".$_POST["txt_message"];
	
	
	
	//*** Uniqid Session ***//
	$strSid = md5(uniqid(time()));

	$strHeader = "From: "."ส่งข้อความ จาก :".$_POST["txt_name"]."\nReply-To: ".$_POST["txt_email"]."";
	

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
		 echo "<script> alert('กรุณากรอกข้อมูลให้ครบถ้วน'); window.history.back(); </script>";		
		exit();	
	}
	
	if(trim($_POST["txt_email"]) == "")
	{
		 echo "<script> alert('กรุณากรอกข้อมูลให้ครบถ้วน'); window.history.back(); </script>";		
		exit();	
	}
	
	if(trim($_POST["txt_message"]) == "")
	{
		 echo "<script> alert('กรุณากรอกข้อมูลให้ครบถ้วน'); window.history.back(); </script>";		
		exit();	
	}
	

	$flgSend = @mail($strTo,$strSubject,null,$strHeader);  // @ = No Show Error //
	if($flgSend)
	{
		 echo "<script> alert('ส่ง email สำเร็จ'); window.history.back(); </script>";
	}
	else
	{
		echo "<script> alert('ไม่สามารถส่ง email ได้'); window.history.back(); </script>";
	}
?>

	</body>
</html>