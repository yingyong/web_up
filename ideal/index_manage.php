<?php
	include('include/connect.php');
	session_start();
	if($_SESSION['user'] == "") {
		echo "<script>alert('please login');</script>";
		echo "<script>window.location = 'index.php';</script>";
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Manage Job Crop</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/stylesheet.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="js/jquery.confirm.css">
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" media="screen" href="js/elfinder-2.0-rc1/css/elfinder.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="js/elfinder-2.0-rc1/css/theme.css">
<link rel="stylesheet" href="js/themes/blue/style.css">
<link rel="stylesheet" href="js/themes/green/style.css">
<script src="../bootstrap/js/bootstrap.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/jquery-1.10.1.min.js"></script>
<script src="js/admin.js"></script>
<script src="js/jquery.confirm.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="css/elfinder.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/theme.css">
<script type="text/javascript" src="js/elfinder.min.js"></script>
<script type="text/javascript" src="js/i18n/elfinder.ru.js"></script>
<script src="js/jquery.tablesorter.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script>
	$(document).ready(function(e) {
		var elf = $('#elfinder').elfinder({
			url : 'include/connector.php'  // connector URL (REQUIRED)
			// lang: 'ru',             // language (OPTIONAL)
		}).elfinder('instance');
		 $("#typetable").tablesorter( {sortList: [[0,0], [0,0]]} ); 
		$('#form1').validate({
			rules: {
			  subject: {
				minlength: 2,
				required: true
			  },
			  	level: {
				minlength: 1,
				required: true
			  },
			  	type: {
				minlength: 2,
				required: true
			  },
			  	year: {
				minlength: 2,
				required: true
			  },
			  	part: {
				minlength: 1,
				required: true
			  },
			  	total: {
				minlength: 2,
				required: true
			  }
			},
				highlight: function(element) {
					$(element).closest('.control-group').removeClass('success').addClass('error');
				},
				success: function(element) {
					element
					.text('OK!').addClass('valid')
					.closest('.control-group').removeClass('error').addClass('success');
				}
	  	});

		$('#select-image').click(function(e) {
            //alert('test');
			var dtest = $('.elfinder-cwd-icon.elfinder-cwd-icon-image.ui-corner-all').attr('style');
		   	var dtest1 = $('.elfinder-path').text();
		  	var dtest2 = $('.elfinder-info-tb tr td').text();
		   	var dtest3 = $('.elfinder-cwd-filename').text();
		   	var dtest4 = $('.ui-corner-all.elfinder-navbar-dir.elfinder-tree-dir.ui-droppable.ui-state-active.ui-draggable').text();
		   	var dtest5 = $('.file-name').text();
		   	//alert(dtest1+"/"+dtest5);

			var imgattr = dtest1+"/"+dtest5;

			$('#dragandrophandler').html("<img src=temp_box/"+imgattr+">");
		   	$('#img-select').html("<b>ชุดข้อสอบ</b> : &nbsp;&nbsp;&nbsp;"+dtest5);
			//$('#img-select').attr('value',dtest5);
			$('#img-select1').attr('value',imgattr);
			$('#img-name').attr('value', dtest5);

			$.confirm({
				'title'		: 'Delete Confirmation',
				'message'	: 'You are about to delete this item. <br />It cannot be restored at a later time! Continue?<?php echo 'test' ?>',
				'buttons'	: {
					'Crop'	: {
						'class'	: 'blue',
						'action': function(){
						}
					},
					'Pass'	: {
						'class'	: 'gray',
						'action': function(){}
					},
					'Cancle' : {
						'class' : 'gray',
						'action': function(){
						}
					}
				}
			});

        });


       $('#select-img1').click(function(e) {

		   var dtest = $('.elfinder-cwd-icon.elfinder-cwd-icon-image.ui-corner-all').attr('style');
		   var dtest1 = $('.elfinder-path').text();
		   var dtest2 = $('.elfinder-info-tb tr td').text();
		   var dtest3 = $('.elfinder-cwd-filename').text();
		   var dtest4 = $('.ui-corner-all.elfinder-navbar-dir.elfinder-tree-dir.ui-droppable.ui-state-active.ui-draggable').text();
		   var dtest5 = $('.file-name').text();
		   //alert(dtest1+"/"+dtest5);

		   //alert('test');

		   var imgattr = dtest1+"/"+dtest5;
		   //$('#dragandrophandler img').attr('src',imgattr);
		   $('#dragandrophandler').html("<img src=temp_box/"+imgattr+">");
		   $('#img-select').html("ไฟล์ที่เลือก : "+dtest5);

			$.confirm({
				'title'		: 'Delete Confirmation',
				'message'	: 'You are about to delete this item. <br />It cannot be restored at a later time! Continue?<?php echo 'test' ?>',
				'buttons'	: {
					'Crop'	: {
						'class'	: 'blue',
						'action': function(){
						}
					},
					'Pass'	: {
						'class'	: 'gray',
						'action': function(){}
					},
					'Cancle' : {
						'class' : 'gray',
						'action': function(){
						}
					}
				}
			});
		});
		var obj = $('#dragandrophandler');
		obj.on('dragenter', function(e)
		{
			e.stopPropagation();
			e.preventDefault();
		});
		obj.on('dragover', function(e)
		{
			e.stopPropagation();
			e.preventDefault();
		});
		obj.on('drop', function(e)
		{
			$(this).css('boder', '2px dotted #0B85A1');
			e.preventDefault();
			var files = e.originalEvent.dataTransfer.files;
			handleFileUpload(files,obj);
		});

		$(document).on('dragenter', function (e)
		{
			e.stopPropagation();
			e.preventDefault();
		});
		$(document).on('dragover', function (e)
		{
		  e.stopPropagation();
		  e.preventDefault();
		  obj.css('border', '2px dotted #0B85A1');
		});
		$(document).on('drop', function (e)
		{
			e.stopPropagation();
			e.preventDefault();
		});

		function handleFileUpload(files,obj)
		{
		   for (var i = 0; i < files.length; i++)
		   {
				var fd = new FormData();
				alert(files[i].name);
				fd.append('file', files[i]);

				var status = new createStatusbar(obj); //Using this we can set progress.
				status.setFileNameSize(files[i].name,files[i].size);
				sendFileToServer(fd,status);

		   }
		}

		function test(){
			alert('s-img');
		}



    });
	function selectimg(){
		//alert('test999');
		var dtest = $('.elfinder-cwd-icon.elfinder-cwd-icon-image.ui-corner-all').attr('style');
		var dtest1 = $('.elfinder-path').text();
		var dtest2 = $('.elfinder-info-tb tr td').text();
		var dtest3 = $('.elfinder-cwd-filename').text();
		var dtest4 = $('.ui-corner-all.elfinder-navbar-dir.elfinder-tree-dir.ui-droppable.ui-state-active.ui-draggable').text();
		var dtest5 = $('.file-name').text();
		   	//alert(dtest1+"/"+dtest5);

		var imgattr = dtest1+"/"+dtest5;

		$('#dragandrophandler').html("<img src=temp_box/"+imgattr+">");
		$('#img-select').html("<b>ชุดข้อสอบ</b> : &nbsp;&nbsp;&nbsp;"+dtest5);
			//$('#img-select').attr('value',dtest5);
		$('#img-select1').attr('value',imgattr);
		$('#img-name').attr('value', dtest5);

		$.confirm({
				'title'		: 'Delete Confirmation',
				'message'	: 'You are about to delete this item. <br />It cannot be restored at a later time! Continue?<?php echo 'test' ?>',
				'buttons'	: {
					'Crop'	: {
						'class'	: 'blue',
						'action': function(){
						}
					},
					'Pass'	: {
						'class'	: 'gray',
						'action': function(){}
					},
					'Cancle' : {
						'class' : 'gray',
						'action': function(){
						}
					}
				}
			});
	}
</script>
</head>

<?php
	mysql_connect("localhost","idealnext_next","@next*27") or die(mysql_error());
	mysql_select_db("idealnext_next");
?>

<body>
	<div class="container">
        <div class="row">
            <div class="span12 well">
                	<div class="span10">
                    	<h4><?php echo $_SESSION['user'] ?></h4>
                    </div>
                    <div class="span1">
                    	<a href="include/logout.php"><button class="btn btn-danger" type="button" value="Logout">Logout</button></a>
                    </div>

			</div>
            <div class="span12 well">
					<div class="alert alert-danger">กรุณาเลือก >>> ผู้รับผิดชอบ >>> เลือกชุดข้อสอบ >>> ใส่รายละเอียด</div>
                    <form id="form1" name="form" method="GET" action="index_manage1.php" accept-charset="UTF-8" >

                    	<div class="span12" style="margin-left:16px">
                        <b style="font-size:18px;">ผู้รับผิดชอบ :</b>
                        	<select name="staff">
                                <option value="">--- Please Select Item ---</option>
                                    <?
									$strSQL = "SELECT * FROM jos_users WHERE st = 'Active' ORDER BY branch ASC";
                                    mysql_query("SET NAMES UTF8");
                                    $objQuery = mysql_query($strSQL);
                                    while($objResuut = mysql_fetch_array($objQuery))
                                    {
                                    ?>
                                    <option value="<?=$objResuut["id"];?>"><?=$objResuut["nick_name"]." - ".$objResuut["branch"];?></option>
                                    <?
                                    }
                                    ?>
                            </select>
                        </div>
                        <br><br>
                        <div class="span3" style="margin-left:16px">
                        	<!--<span id="img-select">ชุดข้อสอบ : ยังไม่ได้เลือกไฟล์</span>-->
                            <!--<input id="img-select" type="text" name="select" value="ไฟล์ที่เลือก : ยังไม่ได้เลือกไฟล์">-->
                            <input id="img-select1" type="hidden" name="select1" value="">
                            <input id="img-name" type="hidden" name="imgname" value="">
                        </div>
                        <br><br>
                        <div id="elfinder"></div>
                        <br>
                        <input type="button" id="select-image1" value="เลือกชุดข้อสอบ" class="btn btn-success" style="float:right;" onClick="selectimg();" >
                        <br><br>
                        <span id="img-select" style="float:left; margin: 10px 10px 0 0; "><b style="font-size:18px;">ชุดข้อสอบ : &nbsp;&nbsp;<span style="font-weight:normal; width: 200px;"></span></b>ยังไม่ได้เลือกไฟล์</span>&nbsp;&nbsp;

                        <br><br><br>

                        <div class="span2" style="width:100px; margin: 10px 0 0 0;">
                        	<b style="font-size:16px;">รายละเอียด :</b>
                        </div>
                        <div class="span2" style="margin-left:10px; width:130px;">
        					รหัสวิชา:   <input type="text" name="subject" maxlength="2" size="2" style="width:50px;" placeholder="">
                        </div>

                        <div class="span2" style="margin-left:0; width: 120px;">
        					ระดับ:   <input type="text" name="level" maxlength="1" size="3" style="width:50px;" placeholder="">
                        </div>

                        <div class="span2" style="margin-left:0; width: 120px;">
        					ชนิด:   <input type="text" name="type" maxlength="2" size="3" style="width:50px;" placeholder="">
                        </div>

                        <div class="span2" style="margin-left:0; width: 120px;">
        					ปีที่:   <input type="text" name="year" maxlength="2" size="3" style="width:50px;" placeholder="">
                        </div>

                        <div class="span2" style="margin-left:0; width: 120px;">
        					ครั้ง:   <input type="text" name="part" maxlength="1" size="3" style="width:50px;" placeholder="">
                        </div>

                        <div class="span2" style="margin-left:0; width:140px;">
        					จำนวนข้อ:   <input type="text" name="total" maxlength="3" size="3" style="width:50px;" placeholder="">
                        </div>

                        <br>

                        <!--<div class="span4" style="margin-left:40px; width:120px;">
                            <button type="submit" class="btn btn-success btn-lg">
                            	บันทึกรายการ
                            </button>
                        </div>-->
                        <br><br>
                        <div class="span12">
                        	<button type="submit" class="btn btn-success btn-lg" style="margin-left:45%;">
                            	บันทึกรายการ
                            </button>
                        </div>
                    </form>
                    <br><br>
                   <br>
                   <?php
						connect();
						$strSQL = "SELECT * FROM temp_pic WHERE status = '0' ";
						$objQuery = mysql_query($strSQL) or die ("Error Query[".$strSQL."]");
					?>
                   <table id="typetable" class="table table-striped tablesorter" style="width:100%;">
                            <thead>
                            <tr>
                                <th width="25%">วันที่</th>
                                <th width="15%">ข้อสอบ</th>
                                <th width="20%">ไฟล์ข้อสอบ</th>
                                <th width="21%">ผู้รับผิดชอบ</th>
                                <th width="19%">สถานะ</th>
                           	  </tr>
                            </thead>
                            <tbody>
                            <?php
								while($objResult = mysql_fetch_array($objQuery))
								{
									if($objResult['status'] == "0"){
										$status = "รอ";
									} else {
										$status = "เสร็จ";
									}
									$day = substr($objResult['date'],8,2);
									$month = substr($objResult['date'],5,2);
									$year = substr($objResult['date'],0,4);
							?>
                            	<tr>
                                	<td align="center"><?=$day."-".$month."-".$year?></td>
                                	<td align="center"><?=$objResult['id'] ?></td>
                                	<td align="center"><?=$objResult['image'] ?></td>
                                	<td align="center"><?=$objResult['user_id'] ?></td>
                                    <td align="center"><?=$status ?></td>
                               	</tr>
                            <?php
								}
							?>
                            </tbody>
						</table>
                        <?php
							mysql_close($objConnect);
						?>
                </div>
        </div>
    </div>
</body>
</html>