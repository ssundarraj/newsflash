function linker(obj){
	console.log(obj)
	var lnk=obj.id;
	var x=document.getElementsByName('articleid');
	x[0].value=obj.id;
	x=document.getElementsByName('articlesource');
	x[0].value=obj.parentNode.parentNode.parentNode.parentNode.id;
	//console.log(x[0].value)
	x=document.getElementById('redirect_form');
	x.submit();
}

function recolinker(obj){
	console.log(obj)
	var lnk=obj.id;
	var x=document.getElementsByName('articleid');
	x[0].value=obj.id;
	x=document.getElementsByName('articlesource');
	x[0].value='thehindu';
	//console.log(x[0].value)
	x=document.getElementById('redirect_form');
	x.submit();
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
	get_reco();
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
	get_reco();
}

function get_thehindu(){
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("content_thehindu").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST", "getthehindu.php", true);
	xmlhttp.send();
}

function get_reco(){
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("reco").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST", "recommendations.php", true);
	xmlhttp.send();
}

function get_bbc(){
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("content_bbc").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST", "getbbc.php", true);
	xmlhttp.send();
}

function click_effect() {
	var a=document.getElementsByClassName('articlecell');
	for(var i=0; i<a.length; i++){
		a[i].onmouseover=function(){this.style.backgroundColor='#FFFF66';};
		a[i].onmouseout=function(){this.style.backgroundColor='';};
	}
}
get_reco();
window.onload = function(){
	var a=document.getElementsByClassName('articlecell');
	for(var i=0; i<a.length; i++){
		//a[i].onclick=function () {linker(this);};
		a[i].onmouseover=function(){this.style.backgroundColor='#FFFF66';};
		a[i].onmouseout=function(){this.style.backgroundColor='';};
	}
	setTimeout(function f(){setInterval(function f(){get_thehindu();get_bbc();}, 30000);}, 30000);
	get_reco();
}

window.onhaschange = function(){
	click_effect();
	get_reco();
}