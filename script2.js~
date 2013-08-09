function commenting(){
	uname=document.getElementById("name_input").value;	
	email=document.getElementById("email_input").value;	
	comm=document.getElementById("comment_input").value;
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		}
	}
	document.getElementById("name_input").value='';	
	document.getElementById("email_input").value='';	
	document.getElementById("comment_input").value='';	
	xmlhttp.open("POST", "addcomment.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send('uname='+uname+'&email='+email+'&comment_input='+comm);
}

function get_comments(){
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("prev_comments").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST", "getcomments.php", true);
	xmlhttp.send();
}

function trylogin(){
	var username=document.getElementById("username").value;
	var password=document.getElementById("pswd").value;
	console.log(username.length);
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("loginbar").innerHTML=xmlhttp.responseText;
		}
	}
	document.getElementById("username").value='';	
	document.getElementById("pswd").value='';
	xmlhttp.open("POST", "loginbar.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send('usrnm='+username+'&passwd='+password);
}

function logout(){
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("loginbar").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST", "logout.php", true);
	xmlhttp.send();
}

function get_moods(){
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("moods_value").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST", "getmoods.php", true);
	xmlhttp.send();
}

function add_moods(obj) {
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		//	document.getElementById("moods_table").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST", "addmood.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send('mood_click='+obj.id);
}
get_moods();
get_comments();
window.onload = function(){
	var b=document.getElementById('comment_button');
	b.onclick=function (){commenting();get_comments();b.onclick=function (){commenting();get_comments();};};
	setInterval(function () {get_moods();get_comments();}, 30000);
	
}
