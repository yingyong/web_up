<?php
require_once("setPDF.php");
// เพิ่มหน้าใน PDF 
$pdf->AddPage();
//$pdf->AddFont('helvetica','','courier.php');
//$pdf->SetFont('helvetica','',10);

// กำหนด HTML code หรือรับค่าจากตัวแปรที่ส่งมา
//	กรณีกำหนดโดยตรง
//	ตัวอย่าง กรณีรับจากตัวแปร
// $htmlcontent =$_POST['HTMLcode'];
//$htmlcontent = $_GET['test']; 

$test = $_GET['test'];

$username = $_GET['username'];

$name = $_GET['name'];
$sname = $_GET['sname'];
$tel = $_GET['tel'];
$code = $_GET['code'];

$objConnect = mysql_connect("localhost","idealup_booking","@booking*27");
$objDB = mysql_select_db("idealup_booking");
$strSQL = "SELECT * FROM course WHERE 1 AND courseid = '".$code."'";
mysql_query("SET NAMES UTF8");
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
$intNumRows = mysql_num_rows($objQuery);

$coursename = $objResult['name'];
$price = $objResult['price'];
$hours = $objResult['time'];
$booking = $objResult['booking'];
$cancle = $objResult['cancle'];
$expire = $objResult['dateex'];


$code1 = substr($code, 0, 1);
$code2 = substr($code, 1,1);
$code3 = substr($code, 2,1);
$code4 = substr($code, 3,1);
$space = "";


$tel1 = substr($tel, 0, 3);
$tel2 = substr($tel, 3, 3);
$tel3 = substr($tel, 6, 4);
$resulttel = $tel1."-".$tel2."-".$tel3;


/*$objConnect = mysql_connect("203.151.20.22","admindb","iddqdidfa");
$objDB = mysql_select_db("learning");
$strSQL = "SELECT * FROM tstudent WHERE 1 AND FUSERNAME = '".$username."'";
mysql_query("SET NAMES UTF8");
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
$intNumRows = mysql_num_rows($objQuery);*/

$fusername = $objResult['FNAME'];

$htmlcontent.= '<table width="565" height="141" border="0">
  					<tr>
    					<td width="149" height="21" align="right">&nbsp;</td>
    					<td width="95" align="left">&nbsp;</td>
	
    					<td width="180" align="right">&nbsp;</td>
    					<td width="123" align="left" style="font-size:40px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$code.'</td>
  					</tr>
  					<tr>
  					  <td height="20" align="right">&nbsp;</td>
  					  <td align="left" style="font-size:32px;">&nbsp;&nbsp;&nbsp;'.$name.'</td>
  					  <td width="120" align="right">&nbsp;</td>
  					  <td align="left" style="font-size:30px;">'.$coursename.'</td>
  </tr>
					
					<tr>
    					<td width="149" height="21" align="right">&nbsp;</td>
    					 <td align="left" style="font-size:32px;">&nbsp;'.$sname.'</td>
	
    					<td width="135" height="21" align="right">&nbsp;</td>
    					<td width="95" align="left" style="font-size:36px;">'.$hours.'</td>
  					</tr>
					
					<tr>
    					<td width="149" height="21" align="right">&nbsp;</td>
    					<td width="95" align="left" style="font-size:36px;">'.$resulttel.'</td>
	
    					<td width="180" align="right">&nbsp;</td>
    					<td width="123" align="left" style="font-size:36px;">'.$booking.'</td>
  					</tr>
					
					<tr>
    					<td width="149" height="21" align="right"></td>
    					<td width="95" align="left"></td>
	
    					<td width="180" align="right">&nbsp;</td>
    					<td width="123" align="left" style="font-size:36px;">'.$cancle.'</td>
  					</tr>
					
					<tr>
    					<td width="149" height="22" align="right"></td>
    					<td width="95" align="left"></td>
	
    					<td width="180" align="right">&nbsp;</td>
    					<td width="123" align="left" style="font-size:36px;">'.$expire.'</td>
  					</tr>
					
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<br />
<table width="640" border="0" align="center">
  <tr>
    <td width="204" height="60" align="left" valign="middle"></td>
    <td width="193" align="left" valign="middle"></td>
    <td width="229" align="left" valign="middle"></td>
  </tr>
</table>
<table width="637" border="0" align="center">
  <tr>
    <td width="242" style="font-size:34px;margin-left:20px;line-height:1px;" height="38">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$name.'&nbsp;&nbsp;&nbsp;&nbsp;'.$sname.'</td>
    <td width="385" style="font-size:50px;line-height:100px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$code1.'&nbsp;&nbsp;'.$code2.'&nbsp;&nbsp;'.$code3.'&nbsp;&nbsp;'.$code4.'</td>
  </tr>
</table>
<table width="637" border="0" align="center">
  <tr>
    <td width="242" height="38" style="font-size:50px;line-height:100px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$price.'&nbsp;&nbsp;บาท</td>
    <td width="385" style="font-size:36px;">&nbsp;&nbsp;'.$tel.'</td>
  </tr>
</table>

';
				
				
				
				
//$htmlcontent.=$_GET['test']."<br/>";


/*$htmlcontent.="<div><p style='color:#ff6600'>$fusername</p> - $test</div>";

$htmlcontent.='<div><p style="color:#ff6600">'.$fusername.'</p> - $test</div>';

$htmlcontent.= '<table><tr><td>1515151515$fusername</td></tr></table>';
$htmlcontent.= '<p><hr></p>';*/

//$htmlcontent.=$_GET['test']."<br/>";
//$htmlcontent='<p style="color:#ff6600;">ทดสอบ987</p>';
$htmlcontent=stripslashes($htmlcontent);
$htmlcontent=AdjustHTML($htmlcontent);

// สร้างเนื้อหาจาก  HTML code
$pdf->writeHTML($htmlcontent, true, 0, true, 0);

// เลื่อน pointer ไปหน้าสุดท้าย
$pdf->lastPage();

// ปิดและสร้างเอกสาร PDF
$pdf->Output('test.pdf', 'I');
?>