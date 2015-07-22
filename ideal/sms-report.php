<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="testStyle.css" />
		<script type="text/javascript" src="../Package/jquery-1.10.2.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../Package/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.min.css" />
		<script type="text/javascript" src="../Package/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {

				$('#txtDate1').datepicker({
			    	showOn: 'button',
			    	buttonImage: 'calendar.png',
			    	buttonImageOnly: true,
			    	dateFormat: 'dd/mm/yy'
			    });

			    $('#txtDate2').datepicker({
			    	showOn: 'button',
			    	buttonImage: 'calendar.png',
			    	buttonImageOnly: true,
			    	dateFormat: 'dd/mm/yy'
			    });

			    $('#btnBack').click(function() {
			    	window.location = 'test.php';
			    });

			    /*bind log limit 100 order by date*/
			    if ($(".evenSheetrow").length) {
                    $(".evenSheetrow").remove();
                }
                if ($(".oddSheetrow").length) {
                    $(".oddSheetrow").remove();
                }

			    var dtLog = getLog('');

			    if (!dtLog) {
			    	return 0;
			    } else {
			    	for (i=1;i<=dtLog.length;i++) {
				    	var table = $('#gvSearch');

				    	if (i%2==0) {
	                        var tr = $('<tr class="evenSheetrow">');
	                    } else {
	                        var tr = $('<tr class="oddSheetrow">');
	                    }

	                    var td_f0 = $("<td>"+dtLog[i-1]['datetime'].substring(6,8)+
		                    	'/'+dtLog[i-1]['datetime'].substring(4,6)+'/'+
		                    	dtLog[i-1]['datetime'].substring(0,4)+' '+
		                    	dtLog[i-1]['datetime'].substring(8,10)+':'+
		                    	dtLog[i-1]['datetime'].substring(10,12)+':'+
		                    	dtLog[i-1]['datetime'].substring(12,14)+"</td>");
	                    var td_f1 = $("<td>"+dtLog[i-1]['mobile']+"</td>");
	                    var td_f2 = $("<td>"+dtLog[i-1]['username']+"</td>");

	                    tr.append(td_f0);
	                    tr.append(td_f1);
	                    tr.append(td_f2);
	                    table.append(tr);
				    }
			    }			    

			    $('#btnSearch').click(function() {
			    	if ($(".evenSheetrow").length) {
	                    $(".evenSheetrow").remove();
	                }
	                if ($(".oddSheetrow").length) {
	                    $(".oddSheetrow").remove();
	                }

			    	var filter = "";
			    	
			    	if ($('#txtDate1').val()) {
			    		var date1 = $('#txtDate1').val();
			    		var date1 = date1.substring(6)+''+date1.substring(3,5)+''+date1.substring(0,2);
			    		filter += " and SUBSTR(datetime,1,8) >= '"+date1+"'";
			    	}

			    	if ($('#txtDate2').val()) {
			    		var date2 = $('#txtDate2').val();
			    		var date2 = date2.substring(6)+''+date2.substring(3,5)+''+date2.substring(0,2);
			    		filter += " and SUBSTR(datetime,1,8) <= '"+date2+"'";
			    	}

			    	var dtLog = getLog(filter);

			    	if (!dtLog) {
			    		return 0;
			    	} else {
			    		for (i=1;i<=dtLog.length;i++) {
					    	var table = $('#gvSearch');

					    	if (i%2==0) {
		                        var tr = $('<tr class="evenSheetrow">');
		                    } else {
		                        var tr = $('<tr class="oddSheetrow">');
		                    }

		                    var td_f0 = $("<td>"+dtLog[i-1]['datetime'].substring(6,8)+
		                    	'/'+dtLog[i-1]['datetime'].substring(4,6)+'/'+
		                    	dtLog[i-1]['datetime'].substring(0,4)+' '+
		                    	dtLog[i-1]['datetime'].substring(8,10)+':'+
		                    	dtLog[i-1]['datetime'].substring(10,12)+':'+
		                    	dtLog[i-1]['datetime'].substring(12,14)+"</td>");
		                    var td_f1 = $("<td>"+dtLog[i-1]['mobile']+"</td>");
		                    var td_f2 = $("<td>"+dtLog[i-1]['username']+"</td>");

		                    tr.append(td_f0);
		                    tr.append(td_f1);
		                    tr.append(td_f2);
		                    table.append(tr);
					    }
			    	}

			    });

			});
			function getLog(filter) {
                var result;
                $.ajax({
                    url:"fortestsearch.php",
                    type:"POST",
                    async: false,
                    data:{"type":'getlog','filter':filter},
                    dataType: "json",
                    success:function(data){
                        result = data;
                    }
                });
                return result;
            }
		</script>
	</head>
	<body>
		<table style='width: 100%'>
			<tr style='height: 1px'>
				<td style='width: 30%'></td>
				<td style='width: 40%'></td>
				<td style='width: 30%'></td>
			</tr>
			<tr>
				<td></td>
				<td style='text-align: center'>
					<p style='font-size: 30px'>เลือกวันที่</p>
					<p>
						<input type='text' id='txtDate1' /> - 
						<input type='text' id='txtDate2' />
					</p>
					<p>
						<input type='button' value='BACK' id='btnBack' />
						<input type='button' value='SEARCH' id='btnSearch' />
					</p>
					<table style='width:100%;height: 350px'>
						<tr>
							<td>
								<div id='scrolldiv'>
									<table id='gvSearch'>
										<tr id='trSearch'>
											<td style='width: 30%'>
												วัน,เวลาที่ส่ง
											</td>
											<td style='width: 30%'>
												หมายเลขโทรศัพท์
											</td>
											<td style='width: 40%'>
												Username ของนักเรียน
											</td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
					</table>
				</td>
				<td></td>
			</tr>
			<tr style='height: 1px'>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</body>
</html>