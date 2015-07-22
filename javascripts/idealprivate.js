// JavaScript Document
//Include JQuery

function enc(str) {
    var encoded = "";
    for (i=0; i<str.length;i++) {
        var a = str.charCodeAt(i);
        var b = a ^ 123;    // bitwise XOR with any number, e.g. 123
        encoded = encoded+String.fromCharCode(b);
    }
    return encoded;
}

function handleLogin(){
	
	
			//alert('into php');
			var url="include/check_login1.php"; // ไฟล์ที่ต้องการรับค้า
			var key = enc(Math.floor((Math.random()*10000)+1).toString()); 
			var dataSet={ user: $("input#username").val(), pass: $("input#password").val(), key: key }; // กำหนดชื่อและค่าที่ต้องการส่ง
			$.ajax({
				type:'POST',
				data: dataSet,
				url:url,
				dataType:"json",
				success: function(data){
					console.log(data);
					if (data == 1){
						alert('success');
						//window.location = 'http://www.idealprivate.com/';
						//window.location = 'http://www.idealprivate.com/register/index.php:user='+data.username+'&key=';
						//window.location = 'http://www.idealprivate.com/register/index.php?user='+user+'&key='+key+'&ref='+window.location;
						//window.location = 'http://www.idealprivate.com/register/index.php?user='+user+'&key='+key+'&ref='+window.location;
					} else{
						alert('error');
					}
				}
			});
			/*$.post(url,dataSet,function(data){
				console.log(data);
				alert (data.user);
				alert("แจ้งเเมื่อทำการส่งข้อมูลเรียบร้อยแล้ว");
			 });*/

}



function reqLogin99(obj){
	alert('Test');
	var user=$("#modlgn_username").val();
	var pass=$("#modlgn_passwd").val();
	var key = enc(Math.floor((Math.random()*10000)+1).toString()); 
	$.ajax({
		type: "POST",
		//data: {"user":user,"pass":pass,"key":key},
		data: {"username":user,"password":pass},
		url: "http://localhost/idealup2/include/check_login.php",
		success: function(data){
			console.log(data);
			if (data == 1){
				if (user.toUpperCase() == "THITIMA.VIR"){
					//window.location = 'http://202.44.53.67/ideal_physics/register/index.php?user='+user+'&key='+key+'&ref='+window.location;
					window.location = 'http://www.idealprivate.com/register/index.php?user='+user+'&key='+key+'&ref='+window.location;
				}else{
					window.location = 'http://www.idealprivate.com/register/index.php?user='+user+'&key='+key+'&ref='+window.location;
				}
				//window.location = 'http://www.ideal-x.net/register/index.php?user='+user+'&key='+key+'&ref='+window.location;
				//window.location = "http://localhost:81/ideal_physics/register/index.php?user="+user+"&key="+key;
			}else{
				alert(data);
			}
		}
	});
	return false;
}

/*function reqLogin(obj){
	var user=$("#modlgn_username").val();
	var pass=$("#modlgn_passwd").val();
	var key = enc(Math.floor((Math.random()*10000)+1).toString()); 
	$.ajax({
		type: "POST",
		data: {"user":user,"pass":pass,"key":key},
		url: "../include/login.php",
		success: function(data){
			if (data == 1){
				if (user.toUpperCase() == "THITIMA.VIR"){
					//window.location = 'http://202.44.53.67/ideal_physics/register/index.php?user='+user+'&key='+key+'&ref='+window.location;
					window.location = 'http://www.idealprivate.com/register/index.php?user='+user+'&key='+key+'&ref='+window.location;
				}else{
					window.location = 'http://www.idealprivate.com/register/index.php?user='+user+'&key='+key+'&ref='+window.location;
				}
				//window.location = 'http://www.ideal-x.net/register/index.php?user='+user+'&key='+key+'&ref='+window.location;
				//window.location = "http://localhost:81/ideal_physics/register/index.php?user="+user+"&key="+key;
			}else{
				alert(data);
			}
		}
	});
	return false;
}*/

function branchList(params){
	$.ajax({
		type: "POST",
		data: {"test":"test"},
		url: "src/branchList.php",
		success: function(data){
			$("#branch_list").html(data);
			$("input:checkbox[name='chkBranch[]']").each(function(index){
				$(this).attr("checked",false);
			});
		}
	});
}

function branchChoose(id){
	$("input:checkbox[name='chkBranch[]']").each(function(index){																  
		if ((id != $(this).attr("id")) && ($(this).attr("checked"))){
			$(this).attr("checked",false);
			$(this).animate({"left": "-=50px"}, "slow");
		}
	});
	if (!$("#"+id).attr("checked")){
		//$("#"+id).css("display","block");		
		$.ajax({
			type: "POST",
			data: {"id":id},
			url: "src/registerList.php",
			success: function(data){
				$("#register_list").html(data);
			}		
		});
	}
}