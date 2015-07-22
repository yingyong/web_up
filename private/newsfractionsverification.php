<?php
	// e r r o r _ r e p o r t i n g (E_ALL);
	date_default_timezone_set('Asia/Bangkok');
	mb_internal_encoding("UTF-8");

	function xorffswapnibbleencrypt($inputstring)
	{
		$outputstring = "";
		$arrayOfLatestVersion = str_split($inputstring);
		for($ii=0;$ii<count($arrayOfLatestVersion);$ii++)
			$outputstring .= dechex((ord($arrayOfLatestVersion[$ii]) ^ 0x0f) & 0x0f).dechex((ord($arrayOfLatestVersion[$ii]) ^ 0xf0) >> 4);
		return $outputstring;
	}

	function xorffswapnibbledncrypt($inputEncryptedString)
	{
		$outputDecryptedString = "";
		$arrayOfEncryptedString = str_split($inputEncryptedString);
		if(is_array($arrayOfEncryptedString))
		{
			$ii=0;
			while( ($ii+1)<count($arrayOfEncryptedString) )
			{
				$outputDecryptedString .= chr( ((hexdec($arrayOfEncryptedString[$ii]) ^ 0x0f) & 0x0f) | ((hexdec($arrayOfEncryptedString[$ii+1]) ^ 0x0f) << 4) );
				$ii += 2;
			}
		}
		return $outputDecryptedString;
	}

	$newsfractions_info = array();
	$response_from_newsfractions = file_get_contents( "newsfractions.php" , false , stream_context_create(
		array('http'=>
			array(
				'timeout' => 12
			)
		)
	));
	$response_from_newsfractions = (empty($response_from_newsfractions)?"":trim($response_from_newsfractions));
	$array_newsfractions = array();

	header('HTTP/1.1 200 OK');
	header('Content-Type: text/html; charset=utf-8');
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); // A first date of UNIX (in the past) means anytime expiration.
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Cache-control" content="no-cache" />
<meta http-equiv="Expires" content="Thu, 01 Jan 1970 00:00:01 GMT" />
<title>ตรวจสอบ  News Fractions</title>
</head>
<body>
<br /><center><b style="margin : 6px; padding : 3px; text-align : center; border : 1px solid #662299; background-color : #CC88FF;">&nbsp;<i>&nbsp;<u>ตรวจสอบ  News Fractions</u>&nbsp;</i>&nbsp;</b></center><br /><br />
<div width="96%" style="width : 96%; margin : 12px; padding : 6px; overflow-x : scroll; border : 2px solid #996622; background-color : #FFCC88;"><h3>รับข้อมูลจาก newsfractions.php =</h3> <pre><?php
	echo ((mb_strlen($response_from_newsfractions)>384)?mb_substr($response_from_newsfractions,0,384):$response_from_newsfractions);
	if(mb_strlen($response_from_newsfractions)>384)
		echo " ...";
?></pre></div><br />
<div width="96%" style="width : 96%; margin : 12px; padding : 6px; overflow-x : scroll; border : 2px solid #996622; background-color : #FFCC88;"><h3>ผลถอดรหัส =</h3> <pre><?php
	$decrypted_from_newsfractions = trim(xorffswapnibbledncrypt($response_from_newsfractions));
	echo ((mb_strlen($decrypted_from_newsfractions)>384)?mb_substr($decrypted_from_newsfractions,0,384):$decrypted_from_newsfractions);
	if(mb_strlen($decrypted_from_newsfractions)>384)
		echo " ...";
	//echo mb_strlen($decrypted_from_newsfractions)."</pre>";
	if( (mb_substr($decrypted_from_newsfractions,0,1)=="{") && (mb_substr($decrypted_from_newsfractions,mb_strlen($decrypted_from_newsfractions)-1,mb_strlen($decrypted_from_newsfractions))=="}") )
	{
		$array_newsfractions = json_decode($decrypted_from_newsfractions,true);
		if($array_newsfractions===false)
			$array_newsfractions = array();
?></pre></div><br />
<div width="96%" style="width : 96%; margin : 12px; padding : 6px; overflow-x : scroll; border : 2px solid #996622; background-color : #FFCC88;"><h3>แสดงข้อมูลภายใน JSON =</h3> <pre><?php
		echo var_export($array_newsfractions,true);
?></pre></div>
<?php
		if(array_key_exists("longnewsimage",$array_newsfractions))
			echo "<center><div width=\"80%\" style=\"width : 80%; margin : 12px; padding : 16px; text-align : center; overflow-x : scroll; border : 2px solid #AAAAAA; background-image: url('images/seamless_marble_cream_texture_by_hhh316-d311m8x.jpg'); background-repeat: repeat;\"><center><h3 style=\"color : #662222; background-color : #CCCCCC;\"> รูปที่ ".$array_newsfractions["longnewsimage"]."<br />(มีรูปพื้นหลัง เพื่อตรวจสอบ Alpha หรือ Transparent ของรูปข่าวโดยคร่าวๆ) </h3><img src=\"".$array_newsfractions["longnewsimage"]."\" style=\"border : 5px dashed #FFCC44;\" /></center></div></center>";
	}
	else
	{
?></pre></div>
<?php
	}

?></body>
</html><?php exit(); ?>