<!doctype html>
<html>
<head>
<meta charset="utf-8">

</head>

<body>
<?php

ying();

echo "<script language=\"javascript\" type=\"text/javascript\">
alert('ส่ง email สำเร็จ');
window.location = \"../../ideal/contact-comment.html\";
</script>
";

function ying (){
	$strTo = "ideal.icomment@gmail.com";
	$strN = $_POST['branch'];
	$strD = date("d-m-Y");
	$strSubject = "ข้อเสนอแนะ สาขาบุรีรัมย์ $strN $strD ";
	$strMessage  = "<B>วันที่ :</B>&nbsp;".$dateday = date("d-m-Y")
			."<br/></br>"
			."<br/></br><B>แนะนำสาขาบุรีรัมย์</B>  :"."<br/><br/>".$_POST["c_branch"]
			."<br/></br>"
			."<br/></br>..................................................................."
			."<br/></br><B>	
รังสินี โขงรัมย์ (หนิง)</B>  :"."<br/><br/>".$_POST["cstaff1"]
			."<br/></br>"
			."<br/></br>..................................................................."
			."<br/></br><B>วรุณกาญจน์ ทองงามวรเสฏฐ์ (ฟ่าง)</B>  :"."<br/><br/>".$_POST["cstaff2"]
			."<br/></br>"
			."<br/></br>..................................................................."
			."<br/></br><B>สุพานา คะโลรัมย์ (นา)</B>  :"."<br/><br/>".$_POST["cstaff3"]
			."<br/></br>"
			."<br/></br>..................................................................."
			."<br/></br>"
			."<br/></br><B>อีเมลผู้แนะนำ</B>  :".$_POST["email"]
			;
		
	
	$strSid = md5(uniqid(time()));
	$strHeader = "";
	$strHeader .= "From:"."ข้อเสนอแนะ สาขาบุรีรัมย์ :".$_POST["branch"]."\nReply-To: ".$_POST["name"]."";
	$strHeader .= "MIME-Version: 1.0\n";
	$strHeader .= "Content-Type: multipart/mixed; boundary=\"".$strSid."\"\n\n";
	$strHeader .= "This is a multi-part message in MIME format.\n";
	$strHeader .= "--".$strSid."\n";
	$strHeader .= "Content-type: text/html; charset=utf-8\n";
	$strHeader .= "Content-Transfer-Encoding: 7bit\n\n";
	$strHeader .= $strMessage."\n\n";

	
	
	$flgSend = @mail($strTo,$strSubject,null,$strHeader);  
}

?>
</body>
</html>