<?php
include("adodb/adodb.inc.php");
putenv("TZ=Asia/Bangkok");
$db=&ADONewConnection('mysql');
if (@$db->PConnect('203.151.20.22','admindb','idealadm*27','Learning')) {
	mysql_query("SET NAMES TIS620"); 
} else {
	print "ERROR: Cannot Database".'<BR>'.$db->ErrorMsg(); 
} 
?>