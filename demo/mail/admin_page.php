<?
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
		exit();
	}

	if($_SESSION['Status'] != "ADMIN")
	{
		echo "This page for Admin only!";
		exit();
	}	
	
	mysql_connect("www.ideal-x.net","admindb","iddqdidfa");
	mysql_select_db("mydatabase");
	$strSQL = "SELECT * FROM tstudent WHERE UserID = '".$_SESSION['UserID']."' ";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
?>
<html>
<head>
<title>ThaiCreate.Com Tutorials</title>
</head>
<body>
  Welcome to Admin Page! <br>
  <table border="1" style="width: 300px">
    <tbody>
      <tr>
        <td width="87"> &nbsp;Username</td>
        <td width="197"><?=$objResult["Username"];?>
        </td>
      </tr>
      <tr>
        <td> &nbsp;Name</td>
        <td><?=$objResult["Name"];?></td>
      </tr>
    </tbody>
  </table>
  <br>
  <a href="edit_profile.php">Edit</a><br>
  <br>
  <a href="logout.php">Logout</a>
</body>
</html>
