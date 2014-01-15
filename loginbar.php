<?php
	session_start();
	$form="<form><label>Name: </label><input type='text' name='usrnm' id='username'>"
						."<label>Password: </label><input type='password' name='passwd' id='pswd'>"
						."<input type='button' name='login_butt' onclick='trylogin();' value='Login!' id='login_button'>"
						."</form>";
	$con=mysqli_connect("localhost","root","pass","newsreader");
	$_SESSION['usrnm']=$_POST['usrnm'];
	$_SESSION['passwd']=$_POST['passwd'];
	$sql="SELECT * FROM users WHERE username='".$_SESSION['usrnm']."' AND password='".$_SESSION['passwd']."'";
	$result=mysqli_query($con, $sql);
	if(mysql_fetch_array($result) !== false){
		$_SESSION['useronline']=$_POST['usrnm'];
		$response="Welcome ".$_SESSION['useronline']."<button onclick='logout();'>Logout</button>";	
	}
	else {
		$response="Incorrect credentials!".$form;
	}
	echo $response;
?>