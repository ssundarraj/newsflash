<?php
	session_start();
	unset($_SESSION['useronline']);
	unset($_SESSION['usrnm']);
	unset($_SESSION['passwd']);
	$form="<form><label>Name: </label><input type='text' name='usrnm' id='username'>"
						."<label>Password: </label><input type='password' name='passwd' id='pswd'>"
						."<input type='button' name='login_butt' onclick='trylogin();' value='Login!' id='login_button'>"
						."</form>";
	echo $form;
?>