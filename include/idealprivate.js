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

function checkBrower()
{
	var browser;
	if($.browser.mozilla)
		browser = "Firefox";
	else if($.browser.msie)
		browser = "Internet Explorer";
	else if($.browser.opera)
		browser = "Opera";
	else if($.browser.safari)
		browser = "Safari";
	else
		browser = "Unknown";
		
		
	if (browser = "Internet Explorer")
	{
		alert ("ขออภัย internet browser ที่ใช้ไม่รองรับการทำงาน กรุณาอัพเกรด เวอร์ชั่น หรือ ใช้ browser อื่น");
		window.location.reload();
		//window.locatino = 'idealprivate.html';
		exit();
	}
}

function reqLogin(obj){
	//alert('Test');
	
	var user=$("#modlgn_username").val();
	var pass=$("#modlgn_passwd").val();
	//alert(user);
	var key = enc(Math.floor((Math.random()*10000)+1).toString()); 
	var url1 = "http://www.idealphysics.com/demo/idealup/include/login.php";
	var url = 'include/check_login1.php';
		if(location.pathname != ""){
		var urlpath = location.pathname;
		urlpath = urlpath.replace("/../public_html","");  // ตอนขึ้น sv จริงเอาออกก่อนนะ
		var str = urlpath.split("/");
		for(var i=2; i<str.length ; i++){
			url= "../"+url;
		}
//	   alert(url);
	}

	//window.location = 'http://www.ideal-x.net/register/register.php?user='+user+'&pass='+pass+'&url=http://www.idealup.com/private/idealprivate.html';
	//console.log(user+'<!-- <br> -->'+pass);
	$.ajax({
		type: "POST",
		data: {"user":user,"pass":pass,"key":key},
		//url: "include/login.php",
		url: url,
		success: function(data){
			//console.log(data);
			if (data == 1){
				//window.location = 'http://www.ideal-x.net/register/index.php?user='+user+'&key='+key;
				//window.location = 'http://www.ideal-x.net/register/register.php?user='+user+'&key='+key;
				
				window.location = 'http://www.ideal-x.net/register/register.php?user='+user+'&pass='+pass+'&url=../private/idealprivate.html';
				
				//window.location = 'http://www.ideal-x.net/register/register.php';
				
				//window.location = 'http://203.151.20.22/register/index.php?user='+user+'&key='+key;
				//window.location = 'http://www.google.co.th';
				//window.location = "http://localhost:81/ideal_physics/register/index.php?user="+user+"&key="+key;
			}else{
				alert(data);
			}
		}
	});
	return false;
}

function reqLogin_bk(obj){
	var username=$("#modlgn_username").val();
	var password=$("#modlgn_passwd").val();
	var url = 'include/check_login1.php';
	var url1 = "http://www.idealphysics.com/demo/idealup/include/login.php";
	var keyword = enc(Math.floor((Math.random()*10000)+1).toString());
	if(location.pathname != ""){
		var urlpath = location.pathname;
		urlpath = urlpath.replace("/../public_html","");  // ตอนขึ้น sv จริงเอาออกก่อนนะ
		var str = urlpath.split("/");
		for(var i=2; i<str.length ; i++){
			url= "../"+url;
		}
//	   alert(url);
	}
	$.ajax({
		type: "POST",
		data: {"user":username,"pass":password,"key":keyword},
		url: url,
		success: function(data){
			if (data == 1){
				window.location = 'http://login2.idealprivate.com/register/index.php?user='+username+'&url='+url1+'&key='+keyword+'&ref='+window.location;
			}else{
				alert(data);
			}
		}
	});
	return false;
}

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