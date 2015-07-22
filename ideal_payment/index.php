<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>ideal private</title>
<link rel="stylesheet" href="css/payment.css">
<script src="js/jquery-1.10.2.min.js"></script>
<script>
	$(document).ready(function(e) {
        //alert('test');
		$('.windows8').hide();
		var output = $('.resulttable');
		$('#bp').click(function(e) {
			$('.windows8').show();
			var table = $('.resulttable tr td').remove();
			var course = $('#bp').attr('alt');
			showcourse(course);
			
        });
		
		$('#ep').click(function(e) {
			$('.windows8').show();
			var table = $('.resulttable tr td').remove();
			var course = $('#ep').attr('alt');
			showcourse(course);
           
        });
		
		$('#ap').click(function(e) {
			$('.windows8').show();
			var table = $('.resulttable tr td').remove();
			var course = $('#ap').attr('alt');
			showcourse(course);
           
        });
		
		$('#eg').click(function(e) {
			$('.windows8').show();
			var table = $('.resulttable tr td').remove();
			var course = $('#eg').attr('alt');
			showcourse(course);
           
        });
		
		$('#qp').click(function(e) {
			$('.windows8').show();
			var table = $('.resulttable tr td').remove();
			var course = $('#qp').attr('alt');
			showcourse(course);
           
        });
		
		$('#be').click(function(){
			$('.windows8').show();
			var table = $('.resulttable tr td').remove();
			var course = $('#be').attr('alt');
			showcourse(course);
		});
		
		$('#ee').click(function(){
			$('.windows8').show();
			var table = $('.resulttable tr td').remove();
			var course = $('#ee').attr('alt');
			showcourse(course);
		});
		
		$('#ae').click(function(){
			$('.windows8').show();
			var table = $('.resulttable tr td').remove();
			var course = $('#ae').attr('alt');
			showcourse(course);
		});
		
		$('#bb').click(function(){
			$('.windows8').show();
			var table = $('.resulttable tr td').remove();
			var course = $('#bb').attr('alt');
			showcourse(course);
		});
		
		$('#eb').click(function(){
			$('.windows8').show();
			var table = $('.resulttable tr td').remove();
			var course = $('#eb').attr('alt');
			showcourse(course);
		});
		
		$('#ad').click(function(){
			$('.windows8').show();
			var table = $('.resulttable tr td').remove();
			var course = $('#ad').attr('alt');
			showcourse(course);
		});
		
		
		$('.btnSubmit').click(function(e) {
			var name = $('#name').val();
			var sname = $('#sname').val();
			var tel = $('#tel').val();
			var code = $('#code-result').val();
			var data = {name:name, sname:sname, tel:tel};
			var strmsg = "กรุณากรอก ";
			if (data.name == '' || data.sname == '' || data.tel == ''){
				if(data.name == "" ){
					strmsg += "ชื่อ ";
				}
				if(data.sname == ""){
					strmsg += "นามสกุล ";
				}
				if(data.tel == ""){
					strmsg += "เบอร์โทรศัพท์ ";
				}
				alert(strmsg);
				exit();	
			} else if(  tel.length < 9 || tel.length > 10 ){
				alert("เบอร์โทรศัพท์ไม่ถูกต้องกรุณาตรวจสอบอีกครั้ง");
				exit();	
			}else if (code == undefined || code == "undefined"){
				alert("กรุณาเลือกคอร์ดที่ต้องการชำระเงิน");
				exit();
			} else {
				//document.location = "test.php?name="+data.name+" ";
				document.location = "pdf/index.php?name="+name+"&sname="+sname+"&tel="+tel+"&code="+code+" ";
			}
			
			
			
			/*$.ajax({
				url: "test.php",
				data: data,
				type: 'POST',
				dataType:"json",
				success: function(data){
						alert(data.name+''+data.sname+''+data.tel);
				}
			});*/
        });
		
		
		
    });
	

function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]/;
  if( !regex.test(key) ) {
	alert("กรุณาระบุเบอร์โทรศัพท์เป็นตัวเลข !");
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

	function showcourse(value) {
//		alert (value);
		var output = $('.resulttable');
		var output1 = $('#resultul');
		
		var course = $('.price').attr('value');
		//var data = {name:course};
		var data = {name:value};
		$.ajax({
			data: data,
			url: 'server1.php',
			type: "POST",
			dataType:"json",
			success: function(data){
				//alert(data.name);
				output.append('<tr class="table-'+value+'"><td align="center">รหัส</td><td align="center">คอร์ส</td><td align="center">ราคา</td></tr>');
				$.each(data, function(i,item){
					setTimeout(function(){
						output.append("<tr><td class='td-bp' align='center'><a onclick='showdetail("+item.course+");' value="+value+">"+item.course+"</a></td><td align='left'><a onclick='showdetail("+item.course+");' value="+value+">"+item.name+"</a></td><td align='center'><a onclick='showdetail("+item.course+");' value="+value+">"+item.price+"</a></td></tr>");
					},1500);
					
					$('.windows8').fadeOut(3000);
					
					//output1.append('<li>'+item.name+'</li>');
				});
				
				
			}
		});
	}
	
	function showdetail(value){
		$('.windows8').show();
		var output = $('#foot-table');
		//var output = $('.resulttable');
		//var course = $('#price').text();
		//var course = $('.price').attr('value');
		var course = value;
		var data = {name:course};
		//var data = {name:'test'};
		$.ajax({
			url: "server.php",
			data: data,
			type: "POST",
			dataType:"json",
			success: function(data){
				//alert(data.name);
				//output.html("<tr><th width='80'>รหัส</th><th>คอร์ส</th><th>ราคา</th></tr><tr><td align='center'>"+data.course+"</td><td align='left'>"+data.name+"<br>"+data.detail+"</td><td align='center' width='80'>"+data.price+"</td></tr>");
				
				setTimeout(function(){
					output.html("<tr><th width='80'>รหัส</th><th>คอร์ส</th><th>ราคา</th></tr><tr><td align='center'><input id='code-result' type='text' value="+data.course+"></td><td align='left'>"+data.name+"<br>"+data.detail+"</td><td align='center' width='80'>"+data.price+"</td></tr>");
				},1500);
				$('.windows8').fadeOut(3000);
				
			}
		});
		
		//output.html('<tr><th>รหัส</th><th>คอร์ส</th><th>ราคา</th></tr><tr><td align="center">test</td><td align="center">test</td><td align="center">test</td></tr>');
	};
	
	function test1(){
		alert('test');
	};
</script>
</head>

<body>
	
		<div class="windows8">
                    <div class="wBall" id="wBall_1">
                    	<div class="wInnerBall"></div>
                    </div>
                    <div class="wBall" id="wBall_2">
                    	<div class="wInnerBall"></div>
                    </div>
                    <div class="wBall" id="wBall_3">
                    	<div class="wInnerBall"></div>
                    </div>
                    <div class="wBall" id="wBall_4">
                    	<div class="wInnerBall"></div>
                    </div>
                    <div class="wBall" id="wBall_5">
                    	<div class="wInnerBall"></div>
                    </div>
    	</div>
    

	<form class="" method="post">
    
	<header id="head1">
    	<img src="images/HeadPayment.jpg">
        <div class="headform">
        <table class="headtable" width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="15%"><h4>ข้อมูลส่วนตัว</h4></td>
            <td width="20%">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right"><label>ชื่อ:&nbsp;&nbsp;</label></td>
            <td><input type="text" id="name" size="15" maxlength="20" placeholder=""></td>
            <td align="right"><label>นามสกุล:&nbsp;&nbsp;</label></td>
            <td><input type="text" id="sname" size="15" maxlength="20" placeholder=""></td>
          </tr>
          <tr>
            <td align="right"><label>เบอร์โทรศัพท์:&nbsp;&nbsp;</label></td>
            <td><input type="text" id="tel" size="15" maxlength="10" placeholder="" onkeypress ="validate(event)" ></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        
        </div>
        <img src="images/line.png">
    </header>
    
    <section id="main">
    	<div class="mainbox">
        	<h4>เลือกคอร์สเรียน</h4>
        	<table class="headtable" width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="100"><h4>PHYSICS</h4></td>
                <td width="70" align="center"><img class="img-con" id="bp" alt="bp" src="images/bp.png"></td>
                <td width="70" align="center"><img class="img-con" id="ep" alt="ep" src="images/ep.png"></td>
                <td width="70" align="center"><img class="img-con" id="ap" alt="ap" src="images/ap.png"></td>
                <td width="70" align="center"><img class="img-con" id="eg" alt="eg" src="images/eg.png"></td>
                <td width="70" align="center"><img class="img-con" id="qp" alt="qp" src="images/qp.png"></td>
              </tr>
             <!-- <tr>
                <td width="100"><h4>ENGLISH</h4></td>
                <td width="70" align="center"><img class="img-con" id="be" alt="be" src="images/be.png"></td>
                <td width="70" align="center"><img class="img-con" id="ee" alt="ee" src="images/ee.png"></td>
                <td width="70" align="center"><img class="img-con" id="ae" alt="ae" src="images/ae.png"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>-->
              <tr>
                <td width="100"><h4>BIOLOGY</h4></td>
                <td width="70" align="center"><img class="img-con" id="bb" alt="bb" src="images/bb.png"></td>
                <td width="70" align="center"><img class="img-con" id="eb" alt="eb" src="images/eb.png"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="100"><h4>เพิ่มวัน</h4></td>
                <td width="70" align="center"><img class="img-con" id="ad" alt="ad" src="images/add.png"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
        
        	
            <br>
            
        </div>
        
        <div class="mainbox-r">
        	<table class="resulttable" width="100%" border="0" cellspacing="0" cellpadding="0">
              	
            </table>
            
            <ul id="resultul">
            
            </ul>
            
        </div>
    	
        <br><br>
        <table id="foot-table" width="90%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
            	<th width="80">รหัส</th>
                <th>คอร์ส</th>
                <th width="80">ราคา</th>
            </tr>  
        </table>
        <br>
        <input class="btnSubmit" type="button" value="">
    	
    </section>
    
    <footer id="foot1">
    	
    </footer>
    </form>


</body>
</html>