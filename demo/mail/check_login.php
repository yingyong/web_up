<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?
session_start();
$hostname = "www.ideal-x.net"; //ชื่อโฮสต์
$user = "admindb"; //ชื่อผู้ใช้
$password = "iddqdidfa"; //รหัสผ่าน
$dbname = "Learning"; //ชื่อฐานข้อมูล
$tblname = "tstudent"; //ชื่อตาราง
// เริ่มติดต่อฐานข้อมูล
mysql_connect($hostname, $user, $password) or die("ติดต่อฐานข้อมูลไม่ได้");

// เลือกฐานข้อมูล
mysql_select_db($dbname) or die("เลือกฐานข้อมูลไม่ได้1");

// คำสั่ง SQL และสั่งให้ทำงาน
$sql = "SELECT * FROM tstudent WHERE FUSERNAME = '".mysql_real_escape_string($_GET['username'])."'
and FPASSWORD = '".mysql_real_escape_string($_GET['password'])."'"; //เช็คค่าข้อมูลที่ส่งมาจากฟอร์ม
$dbquery = mysql_db_query($dbname, $sql);

// หาจำนวนเรกคอร์ดข้อมูล
$num_rows = mysql_num_rows($dbquery);
if($num_rows==1){
header("location:www.idealphysics.com"); //ถ้าถูกต้องให้ไปตามหน้าที่คุณต้องการ
}else {
$code_error="<BR><FONT COLOR=\"red\">ข้อมูลที่คุณกรอกไม่ถูกต้อง กรุณา Login ใหม่อีกครั้ง</FONT>";
session_register("code_error");
header("location: login.php"); //ไม่ถูกต้องให้เด้งกลับไปหน้าเดิม
}
?>

</body>
</html>