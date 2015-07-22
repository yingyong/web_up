<?php
	// e r r o r _ r e p o r t i n g (E_ALL);
	include("../mcrypt1578i.php");
	date_default_timezone_set('Asia/Bangkok');

	// new variables : ModdTP 2014-11(November)-18(Tuesday) // begin
	$MAX_TEXTFILE_SIZE = 524288;
	$SCREENSAVER_CONFIG_JSON_FILENAME = "../scr_admin/screensaver_config_json.txt";
	$PATTERN_SCREENSAVER_SEQUENCE_POSTNAME = "pattern_screensaver_sequence";

	$array_of_screensaver_config = array();
	$array_of_input_branch = array();
	$array_total = array();
	$screensaver_config_json_text_content = "";
	$static_ip_each_number = array();
	$screen_saver_pack = array();

	$pattern_screensaver_sequence = 0;
	$wait_for_screensaver_seconds = "0";
	$last_ip_block = 0;
	$slot_number = "0";
	$checkbox_file = false;
	$filepath = "";
	$datestart_f = "";
	$dateexpire_f = "";
	$timeplay_f = "";
	$timestop_f = "";
	$diff_date_start_from_presentday = 0;
	$diff_date_expire_from_presentday = 0;
	//$diff_time_play_from_current = 0;
	//$diff_time_stop_from_current = 0;
	$result_string = "";

	$branch_id = "";
	$static_ip = "";
	$mcrypt = new MCrypt();
	// new variables : ModdTP 2014-11(November)-18(Tuesday) // end

	function xorffswapnibbleencrypt($inputstring)
	{
		$outputstring = "";
		$arrayOfInputCharacters = str_split($inputstring);
		for($ii=0;$ii<count($arrayOfInputCharacters);$ii++)
			$outputstring .= dechex((ord($arrayOfInputCharacters[$ii]) ^ 0x0f) & 0x0f).dechex((ord($arrayOfInputCharacters[$ii]) ^ 0xf0) >> 4);
		return $outputstring;
	}

	// new function : ModdTP 2014-11(November)-18(Tuesday) // begin
	function valid_time_string($time_string)
	{
		if((!empty($time_string))?is_string($time_string):false)
		{
			$colon_pos = mb_strpos(trim($time_string) , ":");
			if(($colon_pos!==false)&&is_numeric($colon_pos))
			{
				$time_array = explode(":" , trim($time_string));
				if((!empty($time_array))?(count($time_array)==2):false)
					if(is_numeric($time_array[0])&&is_numeric($time_array[1]))
					{
						$int_hour = intval($time_array[0]);
						$int_minute = intval($time_array[1]);
						return (($int_hour>=0)&&($int_hour<=23)&&($int_minute>=0)&&($int_minute<=59));
					}
				return false;
			}
			return false;
		}
		return false;
	}
	// new function : ModdTP 2014-11(November)-18(Tuesday) // end

	// new function : ModdTP 2014-11(November)-18(Tuesday) // begin
	function time_string_to_minutes($time_string)
	{
		if(!empty($time_string))
		{
			$colon_pos = mb_strpos($time_string , ":");
			if(($colon_pos!==false)&&is_numeric($colon_pos))
			{
				$time_array = explode(":" , $time_string);
				if((!empty($time_array))?(count($time_array)==2):false)
					if(is_numeric($time_array[0])&&is_numeric($time_array[1]))
						return (intval($time_array[0])*60)+intval($time_array[1]);
				return 0;
			}
			return 0;
		}
		return 0;
	}
	// new function : ModdTP 2014-11(November)-18(Tuesday) // end

	function json_decode_with_decrypt($paramHttpRawPostData)
	{
		global $result_string;
		$datetime_part_of_string = "";
		//echo "Hi! <br />\r\n";
		$result_string = "";
		if(!is_null($paramHttpRawPostData))
		{
			//echo "Current Server DateTime |".date("Y-m-d H:i:s")."|<br />\r\nAs Timestamp |".var_export(date("U"),true)."|";
			$decoded_http_raw_post_data = base64_decode(trim($paramHttpRawPostData) , false);
			//v a r _ d u m p($decoded_http_raw_post_data);
			$decoded_http_raw_post_data_as_array = unpack("C*" , $decoded_http_raw_post_data);
			//echo str_replace(var_export($decoded_http_raw_post_data_as_array,true),array('\r','\n'),'');
			//echo '<br />\r\n';
			if(is_array($decoded_http_raw_post_data_as_array)&&(!is_null($decoded_http_raw_post_data_as_array)))
			{
				if(count($decoded_http_raw_post_data_as_array)>=19)
				{
					$ii = 0;
					for($ii=count($decoded_http_raw_post_data_as_array)-1;($ii>1)&&(!is_null($decoded_http_raw_post_data_as_array[$ii-1]));$ii--)
					{
						$decoded_http_raw_post_data_as_array[$ii] ^= $decoded_http_raw_post_data_as_array[$ii-1];
						$result_string = chr($decoded_http_raw_post_data_as_array[$ii]) . $result_string;
						if($ii<18)
							$datetime_part_of_string .= chr($decoded_http_raw_post_data_as_array[$ii]);
					}
					if(($ii>=1)?(is_null($decoded_http_raw_post_data_as_array[$ii-1])):$ii==0)
						switch($decoded_http_raw_post_data_as_array[$ii])
						{
							case 0:
								$decoded_http_raw_post_data_as_array[$ii] = '6';
							break;
							case 1:
								$decoded_http_raw_post_data_as_array[$ii] = '8';
							break;
							case 2:
								$decoded_http_raw_post_data_as_array[$ii] = '7';
							break;
							case 3:
								$decoded_http_raw_post_data_as_array[$ii] = '9';
							break;
							case 4:
								$decoded_http_raw_post_data_as_array[$ii] = '3';
							break;
							case 5:
								$decoded_http_raw_post_data_as_array[$ii] = '5';
							break;
							case 6:
								$decoded_http_raw_post_data_as_array[$ii] = '4';
							break;
							case 7:
								$decoded_http_raw_post_data_as_array[$ii] = '0';
							break;
							case 8:
								$decoded_http_raw_post_data_as_array[$ii] = '2';
							break;
							default:
								$decoded_http_raw_post_data_as_array[$ii] = '1';
						}
					//$result_string = var_export($decoded_http_raw_post_data_as_array[0],true) . "|" . var_export($decoded_http_raw_post_data_as_array[1],true) . "|" . var_export($decoded_http_raw_post_data_as_array[2],true) . "|" . $result_string;
					$result_string = $decoded_http_raw_post_data_as_array[$ii] . $result_string;
					$datetime_part_of_string .= $decoded_http_raw_post_data_as_array[$ii];
					$datetime_part_of_string = trim($datetime_part_of_string);
					$datetime_timestamp = mktime( intval(substr($datetime_part_of_string,8,2)) , intval(substr($datetime_part_of_string,10,2)) , ((intval(substr($datetime_part_of_string,14))>=500)?1:0)+intval(substr($datetime_part_of_string,12,2)) , intval(substr($datetime_part_of_string,4,2)) , intval(substr($datetime_part_of_string,6,2)) , intval(substr($datetime_part_of_string,0,4)) );
					//$datetime_timestamp -= 25200; // Shift it to GMT (Greenich Mean Time)
					$server_timestamp = intval(date("U"));
					$result_string = trim($result_string);
					//$resultFile = fopen("result_".mb_substr($result_string , 0 , 17).".txt","w");
					//fwrite($resultFile , $result_string);
					//fclose($resultFile);
					$json_part_of_string = mb_substr($result_string , 17);
					if(abs($datetime_timestamp-$server_timestamp)<=120)
					{
						//echo $json_part_of_string;
						//$jsonFile = fopen("apk-downloader-checker_".mb_substr($result_string , 0 , 17).".json","w");
						//fwrite($jsonFile , $json_part_of_string);
						//fclose($jsonFile);
						return json_decode($json_part_of_string , true);
						////return $result_string;
						////return $json_part_of_string;
					}
					else
					{
						////$json_part_of_string .= ";datetime_part_of_string='".$datetime_part_of_string."';timestamp_diff=".abs($datetime_timestamp-$server_timestamp);
						return false;
					}
					// e c h o "Gap ".abs($datetime_timestamp-$server_timestamp)." seconds | Proper gap ? ".(?"true":"false")."<br />\r\n|<br />\r\nDateTime Part |".$datetime_part_of_string."|<br />\r\nJSON Part |".$json_part_of_string."|";
				}
				else
					return false;
			}
			else
				return false;
		}
		else
			return false;
	}

	$decryptJSONResult = (array_key_exists("info",$_GET)?json_decode_with_decrypt($_GET["info"]):false);

	// new code for screensaver : ModdTP 2014-11(November)-18(Tuesday) // begin

	if(is_array($decryptJSONResult))
		if(!empty($decryptJSONResult))
		{
			if(array_key_exists("branch" , $decryptJSONResult))
			{
				$branch_id = trim($decryptJSONResult["branch"]);
			}
			if(array_key_exists("static_ip" , $decryptJSONResult))
			{
				$static_ip = trim($decryptJSONResult["static_ip"]);
			}
		}
	if((!empty($branch_id))&&(!empty($static_ip)))
	{
		if(file_exists($SCREENSAVER_CONFIG_JSON_FILENAME)) //?is_file($SCREENSAVER_CONFIG_JSON_FILENAME)&&(!is_dir($SCREENSAVER_CONFIG_JSON_FILENAME))&&is_readable($SCREENSAVER_CONFIG_JSON_FILENAME):false)
		{
			$screensaver_config_json_text_content = file_get_contents( $SCREENSAVER_CONFIG_JSON_FILENAME , false , NULL , 0 , $MAX_TEXTFILE_SIZE );
			if(!empty($screensaver_config_json_text_content))
			{
				$screensaver_config_json_text_content = trim($mcrypt->decrypt(trim($screensaver_config_json_text_content)));
				if(!empty($screensaver_config_json_text_content))
				{
					$array_total = json_decode($screensaver_config_json_text_content,true);
					if(empty($array_total)||($array_total===false))
					{
						$array_total = array();
						$screensaver_config_json_text_content = "{}";
					}
				}
			}
		}
		////echo "read '".$SCREENSAVER_CONFIG_JSON_FILENAME."' = ".$screensaver_config_json_text_content;
		if(!empty($array_total))
			if(array_key_exists("branch_".$branch_id , $array_total)?(array_key_exists("pattern_screensaver_sequence",$array_total["branch_".$branch_id])&&array_key_exists("wait_for_screensaver_seconds",$array_total["branch_".$branch_id])):false)
			{
				////echo "<br />\r\n<br />\r\n<br />\r\n".json_encode($array_total["branch_".$branch_id])."<br />\r\n<br />\r\n";
				////v a r _ d u m p ($array_total["branch_".$branch_id]);
				////echo "<br />\r\n<br />\r\n";
				$static_ip_each_number = explode("." , $static_ip);
				if(!empty($static_ip_each_number))
					if(count($static_ip_each_number)==4)
					{
						$last_ip_block = intval($static_ip_each_number[3]);
						//$array_total["branch_".$branch_id]["pattern_screensaver_sequence"] = "1";
						////echo "last ip block = ".$static_ip_each_number[3]."<br />\r\n<br />\r\npattern screensaver sequence = "
						////	.$array_total["branch_".$branch_id]["pattern_screensaver_sequence"]."<br />\r\n<br />\r\n";
						$pattern_screensaver_sequence = intval($array_total["branch_".$branch_id]["pattern_screensaver_sequence"]);
						$wait_for_screensaver_seconds = trim($array_total["branch_".$branch_id]["wait_for_screensaver_seconds"]);
						$slot_number .= (((floor($last_ip_block / $pattern_screensaver_sequence)) % 3)+1);
						////echo "screen saver vdo file is at slot #".$slot_number."<br />\r\n<br />\r\n";
						if(  ( array_key_exists("filepath_".$slot_number , $array_total["branch_".$branch_id])
						&& array_key_exists("datestart_f".$slot_number , $array_total["branch_".$branch_id])
						&& array_key_exists("dateexpire_f".$slot_number , $array_total["branch_".$branch_id])
						&& array_key_exists("timeplay_f".$slot_number , $array_total["branch_".$branch_id])
						&& array_key_exists("timestop_f".$slot_number , $array_total["branch_".$branch_id]) )
						?
							( (!empty($array_total["branch_".$branch_id]["filepath_".$slot_number]))
							&& (!empty($array_total["branch_".$branch_id]["datestart_f".$slot_number]))
							&& (!empty($array_total["branch_".$branch_id]["dateexpire_f".$slot_number])) )
						: false)
						{
							if(array_key_exists("checkbox_file_".$slot_number , $array_total["branch_".$branch_id])
								?(($array_total["branch_".$branch_id]["checkbox_file_".$slot_number]!==null)
									?((mb_strtolower(trim($array_total["branch_".$branch_id]["checkbox_file_".$slot_number]))=="on")||(mb_strtolower(trim($array_total["branch_".$branch_id]["checkbox_file_".$slot_number]))=="true"))
									:false)
								:false)
								$checkbox_file = true;
							else
								$checkbox_file = false;

							$array_total["branch_".$branch_id]["filepath_".$slot_number] = trim($array_total["branch_".$branch_id]["filepath_".$slot_number]);
							$datestart_f = date_create_from_format("d/m/Y" , $array_total["branch_".$branch_id]["datestart_f".$slot_number]);
							$dateexpire_f = date_create_from_format("d/m/Y" , $array_total["branch_".$branch_id]["dateexpire_f".$slot_number]);
							$diff_date_start_from_presentday = date_diff($datestart_f , date_create("now") , false);
							if(($datestart_f < date_create("now"))&&($diff_date_start_from_presentday>0))
								$diff_date_start_from_presentday = -$diff_date_start_from_presentday;
							$diff_date_expire_from_presentday = date_diff($dateexpire_f , date_create("now") , false);
							if(($dateexpire_f < date_create("now"))&&($diff_date_expire_from_presentday>0))
								$diff_date_expire_from_presentday = -$diff_date_expire_from_presentday;
							if(!valid_time_string($array_total["branch_".$branch_id]["timeplay_f".$slot_number]))
								$array_total["branch_".$branch_id]["timeplay_f".$slot_number] = null;
							if(!valid_time_string($array_total["branch_".$branch_id]["timestop_f".$slot_number]))
								$array_total["branch_".$branch_id]["timestop_f".$slot_number] = null;

							//$diff_time_play_from_current = (time_string_to_minutes($array_total["branch_".$branch_id]["timeplay_f".$slot_number])-time_string_to_minutes(date_format(date_create("now"),"H:i")));
							//$diff_time_stop_from_current = (time_string_to_minutes($array_total["branch_".$branch_id]["timestop_f".$slot_number])-time_string_to_minutes(date_format(date_create("now"),"H:i")));


							////echo "checkbox_file_".$slot_number." : ".($checkbox_file?"true<br />\r\n":"false<br />\r\n");
							////echo "filepath_".$slot_number." : ".$array_total["branch_".$branch_id]["filepath_".$slot_number]."<br />\r\n";
							////echo "datestart_f".$slot_number." : ".date_format($datestart_f , 'Y-m-d')." ; diff with now : ".$diff_date_start_from_presentday->days."<br />\r\n";
							////echo "dateexpire_f".$slot_number." : ".date_format($dateexpire_f , 'Y-m-d')." ; diff with now : ".$diff_date_expire_from_presentday->days."<br />\r\n";
							//// //echo "timeplay_f".$slot_number." : ".$array_total["branch_".$branch_id]["timeplay_f".$slot_number]." ; diff with now : ".$diff_time_play_from_current."<br />\r\n";
							//// //echo "timestop_f".$slot_number." : ".$array_total["branch_".$branch_id]["timestop_f".$slot_number]." ; diff with now : ".$diff_time_stop_from_current."<br />\r\n";

							if($checkbox_file && (!empty($array_total["branch_".$branch_id]["filepath_".$slot_number])) && ($diff_date_start_from_presentday->days<=0) && ($diff_date_expire_from_presentday->days>=0) ) //&& ($diff_time_play_from_current<=0) && ($diff_time_stop_from_current>=0)
							{
								////echo "<br />\r\nOK , this is able to open the screen saver";
								$screen_saver_pack = array(
									"ID" => "ss-b".$branch_id."-sn".$slot_number."-p".$array_total["branch_".$branch_id]["timeplay_f".$slot_number]."-s".$array_total["branch_".$branch_id]["timestop_f".$slot_number]
									, "filename" => $array_total["branch_".$branch_id]["filepath_".$slot_number]
									, "WaitTime" => $wait_for_screensaver_seconds*1000
									, "StartPlayAtTime" => trim($array_total["branch_".$branch_id]["timeplay_f".$slot_number])
									, "StopPlayAtTime" => trim($array_total["branch_".$branch_id]["timestop_f".$slot_number])
									, "Property" => "clip"
								);
							}
							//else
							//{
							////	echo "<br />\r\nDenied , this is not able to open the screen saver";
							//}
						}
					}
			}
	}
	////else
	////	echo "Invalid Parameters";

	// new code for screensaver : ModdTP 2014-11(November)-18(Tuesday) // end

	header('HTTP/1.1 200 OK');
	header('Content-Type: application/json; charset=utf-8');
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); // A first date of UNIX (in the past) means anytime expiration.

	// /* เดิม อยู่ที่ http://www.idealup.com/guru_private/longnews.png */
	//a r r a y _ p u s h ( $news_array_for_json["fractions"] , array(0,0,138,441,"http://idealup.com/private/news.php") );

	//$news_array_for_json = array("longnewsimage" => "http://www.idealup.com/viewver/images/test_longnews_f01.png" , "fractions" => array());
	// //$news_array_for_json["screensaver"] = array("ID" => "ss000001" , "URL" => "http://www.idealup.com/viewver/images/testscreensaver01.png" , "WaitTime" => "15000" , "Property" => "image");
	// //$news_array_for_json["screensaver"] = array("ID" => "ss000002" , "URL" => "http://www.idealup.com/booking_server/test/testvdo1.mp4" , "WaitTime" => "15000" , "Property" => "clip");
	// //$news_array_for_json["screensaver"] = array("ID" => "ss000003" , "URL" => "http://www.idealup.com/viewver/screensaver/gradient-test.mp4" , "WaitTime" => "15000" , "Property" => "clip");

	$news_array_for_json = array("longnewsimage" => "../Headline/image/guruEngChi.png" , "fractions" => array());
	array_push($news_array_for_json["fractions"],array(0,42,138,190,"news.html"));
	array_push($news_array_for_json["fractions"],array(0,192,138,343,"news2.html"));
	//$news_array_for_json["debug"] = (empty($array_total)?(" no data from ".$SCREENSAVER_CONFIG_JSON_FILENAME):(" some data from ".$SCREENSAVER_CONFIG_JSON_FILENAME));
	//$news_array_for_json["debug"] = $result_string;

	if(!empty($screen_saver_pack))
		$news_array_for_json["screensaver"] = $screen_saver_pack;
	////else
	////{
	////	$news_array_for_json["screensaver"] = null;
	////	//$news_array_for_json["branch"] = $branch_id;
	////	//$news_array_for_json["static_ip"] = $static_ip;
	////	//$news_array_for_json["slot_number"] = $slot_number;
	////	//$news_array_for_json["checkbox_file"] = $checkbox_file;
	////	//$news_array_for_json["filepath_".$slot_number] = ($array_total["branch_".$branch_id]["filepath_".$slot_number]);
	////	//$news_array_for_json["diff_date_start_from_presentday"] = $diff_date_start_from_presentday->days;
	////	//$news_array_for_json["diff_date_expire_from_presentday"] = $diff_date_expire_from_presentday->days;
	////}
	//array_push($news_array_for_json["fractions"],array(0,29,138,157,"http://www.google.co.th/"));
	//array_push($news_array_for_json["fractions"],array(0,166,138,327,"http://www.thairath.co.th/"));
	//array_push($news_array_for_json["fractions"],array(0,336,138,441,"http://www.idealphysics.com/"));
	////$news_array_for_json["info"] = $decryptJSONResult; //mb_convert_encoding(preg_replace("/\\\\u([0-9abcdef]{4})/", "&#x$1;", json_encode($_GET)) , 'UTF-8', 'HTML-ENTITIES');

	echo xorffswapnibbleencrypt(mb_convert_encoding(preg_replace("/\\\\u([0-9abcdef]{4})/", "&#x$1;", json_encode($news_array_for_json)) , 'UTF-8', 'HTML-ENTITIES'));
	exit();
?>