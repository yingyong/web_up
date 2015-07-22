<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<script type="text/javascript" src="../Package/jquery-1.10.2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {

				$('#txtUser').css('text-transform','uppercase');
				$('#detail').hide();
				$('#lblResult').hide();
				
				$('#btnLogin').click(function() {
					if ($('#txtPassword').val()=='ideal') {
						$('#detail').show();
					} else {
						$('#detail').hide();
					}
				});

				$('#txtPassword').keypress(function(e) {
				    if(e.which == 13) {
				        $('#btnLogin').trigger('click');
				    }
				});

				$('#txtUser').css('text-transform','uppercase');

				$('#btnReset').click(function() {
					window.location = 'test.php';
				});

				$('#btnSearch').click(function() {
					window.location = 'sms-report.php';
				});

				$('#btnSend').click(function() {
					if(!$('#txtUser').val()) {
						$('#lblResult').text('กรุณาใส่ Username');
						$('#lblResult').show();
					} else {
						if(!$('#txtMobile').val()) {
							var mobile='no';
						} else {
							var mobile=$('#txtMobile').val();
						}
						var username = $('#txtUser').val();
						sendResult = sendSMS(username,mobile);

						//console.log(sendResult);
						if (sendResult=='nousername') {
							$('#lblResult').text('Username ไม่ถูกต้อง');
							$('#lblResult').show();
						} else {
							$('#lblResult').text(sendResult);
							$('#lblResult').show();
							$('#btnSend').hide();
							$('#btnLogin').hide();

							logResult = keepLog(username,mobile);
							console.log(logResult);
						}
					}
				});				
			});
			function sendSMS(username,mobile) {
				var result;
                $.ajax({
                    url:"fortest.php",
                    type:"POST",
                    async: false,
                    data:{"type":'sendSMS','username':username,'mobile':mobile},
                    dataType: "json",
                    success:function(data){
                        result = data;
                    }
                });
                return result;
			}
			function keepLog(username,mobile) {
				var result;
                $.ajax({
                    url:"fortest.php",
                    type:"POST",
                    async: false,
                    data:{"type":'keepLog','username':username,'mobile':mobile},
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
			<tr style='height: 100px'>
				<td style='width: 30%'></td>
				<td style='width: 40%'></td>
				<td style='width: 30%'></td>
			</tr>
			<tr>
				<td></td>
				<td style='text-align: center'>
					<label style='font-size: 30px'>Password : </label>
					<input type='password' id='txtPassword' style='font-size: 30px'/>
					<br><br>
					<input type='button' value='LOGIN' id='btnLogin'/>
					<input type='button' value='RESET' id='btnReset'/>
					<br><br><br><br>
					<div id='detail'>
						<table style='width: 100%'>
							<tr style='height: 50px'>
								<td style='text-align: left'>
									<label>Username : </label>
									<input type='textbox' id='txtUser' />
								</td>
								<td style='text-align: right'>
									<label>Mobile : </label>
									<input type='textbox' id='txtMobile' />
								</td>
							</tr>
							<tr>
								<td>
									
								</td>
								<td style='text-align: right'>
									<input type='button' value='SEARCH' id='btnSearch'/>
									<input type='button' value='SEND' id='btnSend'/>
								</td>
							</tr>
						</table>
						<br><br>
						<label id='lblResult' style='font-size: 20px;color: red'> test </label>
					</div>
				</td>
				<td></td>
			</tr>
			<tr style='height: 100px'>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</body>
</html>
