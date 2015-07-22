<?php

	date_default_timezone_set('Asia/Bangkok');
	mb_internal_encoding("UTF-8");

	function xorffswapnibbleencrypt($inputstring)
	{
		$outputstring = "";
		$arrayOfInputCharacters = str_split($inputstring);
		for($ii=0;$ii<count($arrayOfInputCharacters);$ii++)
			$outputstring .= dechex((ord($arrayOfInputCharacters[$ii]) ^ 0x0f) & 0x0f).dechex((ord($arrayOfInputCharacters[$ii]) ^ 0xf0) >> 4);
		return $outputstring;
	}

	header('HTTP/1.1 200 OK');
	header('Content-Type: application/json; charset=utf-8');
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

	

	$news_array_for_json = array("longnewsimage" => "../Headline/image/guruEngChi.png" , "fractions" => array());
	array_push($news_array_for_json["fractions"],array(0,42,138,190,"news.html"));
	array_push($news_array_for_json["fractions"],array(0,192,138,343,"news2.html"));

	echo xorffswapnibbleencrypt(mb_convert_encoding(preg_replace("/\\\\u([0-9abcdef]{4})/", "&#x$1;", json_encode($news_array_for_json)) , 'UTF-8', 'HTML-ENTITIES'));
	exit();
?>